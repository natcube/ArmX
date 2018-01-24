<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * QQ登陆Api
 */
class ArmX_OAuth_alipay extends ArmX_OAuth {

    private $fileCharset = "utf-8";
    // 表单提交字符集编码
    public $postCharset = "gbk";
    //签名类型
    public $signType = "RSA2";

    /**
     * 获取code的api接口
     * @var string
     */
    protected $AuthorizeURL = 'https://openauth.alipay.com/oauth2/publicAppAuthorize.htm';

    /**
     * 获取Access Token的api接口
     * @var type String
     */
    protected $AccessTokenURL = 'https://openapi.alipay.com/gateway.do';

    /**
     * API根路径
     * @var string
     */
    protected $ApiBase = 'https://openapi.alipay.com/gateway.do';

    protected $channel = 'alipay';

    /**
     * 请求Authorize访问地址
     */
    public function getAuthorizeURL($referer = '') {
        setcookie('A_S', $referer, $this->timestamp + 600, '/');
        $this->initConfig();
        //Oauth 标准参数
        $params = array(
            'app_id'     => $this->config['app_key'],
            'redirect_uri'  => $this->config['callback'],
            'state'         => $referer,
            'scope'         => $this->config['scope']
        );
        return $this->AuthorizeURL . '?' . http_build_query($params);
    }

    /**
     * 默认的AccessToken请求参数
     * @return type
     */
    protected function _params() {

        return $this->query(array(
            'grant_type' => $this->config['grant_type'],
            'code'       => $_GET['auth_code'],
            'method'     => 'alipay.system.oauth.token',
        ));
    }

    /**
     * 公共参数
     */
    protected function query($params = array()){
        $query = array(
            'app_id'      => $this->config['app_key'],
            'format'     => 'JSON',
            'charset'    => $this->postCharset,
            'version'    => '1.0',
            'sign_type'  => $this->signType,
            'timestamp'  => date('Y-m-d H:i:s', $this->timestamp)
        );
        $params = array_merge($params, $query);
        $params['sign'] = $this->generateSign($params, $this->signType);
        return $params;
    }

    /**
     * 统一接口调用
     * @author NatLiu
     * @date   2018-01-24T08:35:03+0800
     * @param  [type]                   $api    [description]
     * @param  array                    $param  [description]
     * @param  string                   $method [description]
     * @return [type]                           [description]
     */
    public function call($api, $param = array(), $method = 'POST') {
        $params = $this->query(array(
            'auth_token'       => $this->token['access_token'],
            'method'           => $api,
        ));
        $http = Typecho_Http_Client::get();
        if ($method !== "GET") {
            $http->setData($this->param($params, $param));
        }else{
            $http->setQuery($this->param($params, $param));
        }
        $resp = $http->send($this->url());
        $data = iconv($this->postCharset, $this->fileCharset . "//IGNORE", $resp);
        return json_decode($data, true);
    }

    /**
     * 解析access_token
     * @author NatLiu
     * @date   2018-01-24T08:35:32+0800
     * @param  [type]                   $result [description]
     * @return [type]                           [description]
     */
    protected function parseToken($result) {

        if (is_array($result)) {
            $data = $result;
        }else{
            $result = iconv($this->postCharset, $this->fileCharset . "//IGNORE", $result);
            $data = json_decode($result, 1);
        }
        if($data['alipay_system_oauth_token_response']){
            $data = $data['alipay_system_oauth_token_response'];
        }
        if ($data) {
            if ($data['access_token']) {
                if ($data['expires_in']) {
                    Typecho_Cookie::set('__typecho_oauth_token_'.$this->channel, $data['access_token'], $this->timestamp + $data['expires_in'] - 600);
                }
                $this->token    = $data;
                $data['openid'] = $this->openid();
                return $data;
            }else{
                $result = $data['code'] . $data['msg'] . $data['sub_msg'];
            }
        }
        return $this->setError("获取支付宝 ACCESS_TOKEN 出错：{$result}");
    }

    /**
     * 获取当前授权应用的openid
     * @return string
     */
    public function openid() {
        $data = $this->token;
        if (isset($data['user_id'])) {
            return $data['user_id'];
        } else {
            return $this->setError('没有获取到openid！');
        }
    }

    /**
     * 获取授权用户的用户信息
     */
    public function userinfo() {
        $data = $this->call('alipay.user.info.share');
        $error = '获取用户信息出错';
        if (empty($data)) {
            return $this->setError($error);
        }
        $rsp = $data['alipay_user_info_share_response'];
        if (empty($rsp['user_id'])) {
            return $this->setError($error . '：' .$rsp['msg'] . $rsp['sub_msg']);
        } else {

            $userinfo = array(
                'openid'  => $rsp['user_id'],
                'channel' => $this->channel,
                'nick'    => $rsp['nick_name'],
                'gender'  => $rsp['gender'] == "F" ? 'f' : 'm',
                'avatar'  => $rsp['avatar'],
            );
            return $userinfo;
        }
    }

    /**
     * 通用签名
     * @author NatLiu
     * @date   2018-01-19T08:42:39+0800
     * @param  [type]                   $params   [description]
     * @param  string                   $signType [description]
     * @return [type]                             [description]
     */
    public function generateSign($params, $signType = "RSA2") {
        return $this->sign($this->getSignContent($params), $signType);
    }

    /**
     * 获取待签名字符串
     * @author NatLiu
     * @date   2018-01-19T08:41:29+0800
     * @param  [type]                   $params [description]
     * @return [type]                           [description]
     */
    protected function getSignContent($params) {
        ksort($params);

        $stringToBeSigned = "";
        $i = 0;
        foreach ($params as $k => $v) {
            if (false === $this->checkEmpty($v) && "@" != substr($v, 0, 1)) {

                // 转换成目标字符集
                $v = $this->characet($v, $this->postCharset);

                if ($i == 0) {
                    $stringToBeSigned .= "$k" . "=" . "$v";
                } else {
                    $stringToBeSigned .= "&" . "$k" . "=" . "$v";
                }
                $i++;
            }
        }

        unset ($k, $v);
        return $stringToBeSigned;
    }

    /**
     * 校验$value是否非空
     *  if not set ,return true;
     *    if is null , return true;
     **/
    protected function checkEmpty($value) {
        if (!isset($value))
            return true;
        if ($value === null)
            return true;
        if (trim($value) === "")
            return true;

        return false;
    }

    /**
     * 转换字符集编码
     * @param $data
     * @param $targetCharset
     * @return string
     */
    protected function characet($data, $targetCharset) {
        
        if (!empty($data)) {
            $fileType = $this->fileCharset;
            if (strcasecmp($fileType, $targetCharset) != 0) {
                $data = mb_convert_encoding($data, $targetCharset, $fileType);
                //$data = iconv($fileType, $targetCharset.'//IGNORE', $data);
            }
        }


        return $data;
    }

    /**
     * 签名方法
     * @author NatLiu
     * @date   2018-01-19T08:33:42+0800
     * @param  [type]                   $data     [description]
     * @param  string                   $signType [description]
     * @return [type]                             [description]
     */
    protected function sign($data, $signType = "RSA2") {

        $res = "-----BEGIN RSA PRIVATE KEY-----\n" .
                wordwrap($this->config['app_secret'], 64, "\n", true) .
                "\n-----END RSA PRIVATE KEY-----";

        ($res) or die('您使用的私钥格式错误，请检查RSA私钥配置'); 

        if ("RSA2" == $signType) {
            openssl_sign($data, $sign, $res, OPENSSL_ALGO_SHA256);
        } else {
            openssl_sign($data, $sign, $res);
        }
        $sign = base64_encode($sign);
        return $sign;
    }

}
