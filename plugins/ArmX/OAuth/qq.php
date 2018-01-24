<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * QQ登陆Api
 */
class ArmX_OAuth_qq extends ArmX_OAuth {

    /**
     * 获取requestCode的api接口
     * @var string
     */
    protected $AuthorizeURL = 'https://graph.qq.com/oauth2.0/authorize';

    /**
     * 获取Access Token的api接口
     * @var type String
     */
    protected $AccessTokenURL = 'https://graph.qq.com/oauth2.0/token';

    /**
     * API根路径
     * @var string
     */
    protected $ApiBase = 'https://graph.qq.com/';

    protected $channel = 'qq';

    /**
     * 请求Authorize访问地址
     */
    public function getAuthorizeURL($referer = '') {
        setcookie('A_S', $referer, $this->timestamp + 600, '/');
        $this->initConfig();
        //Oauth 标准参数
        $params = array(
            'response_type' => $this->config['response_type'],
            'client_id'     => $this->config['app_key'],
            'redirect_uri'  => $this->config['callback'],
            'state'         => empty($referer)?'1' : $referer,
            'scope'         => $this->config['scope']
        );
        return $this->AuthorizeURL . '?' . http_build_query($params);
    }

    /**
     * 接口调用方法
     * @author NatLiu
     * @date   2018-01-24T08:37:33+0800
     * @param  [type]                   $api    [description]
     * @param  string                   $param  [description]
     * @param  string                   $method [description]
     * @return [type]                           [description]
     */
    public function call($api, $param = '', $method = 'GET') {
        /* 腾讯QQ调用公共参数 */
        $params = array(
            'oauth_consumer_key' => $this->config['app_key'],
            'access_token'       => $this->token['access_token'],
            'openid'             => $this->openid(),
            'format'             => 'json'
        );
        $http = Typecho_Http_Client::get();
        $http->setMethod($method);
        if ($method == "POST") {
            $http->setData($this->param($params, $param));
        }else{
            $http->setQuery($this->param($params, $param));
        }
        $data = $http->setHeader('referer', 'https://www.armjs.com/')->send($this->url($api));
        return json_decode($data, true);
    }

    /**
     * 解析access_token方法请求后的返回值
     * @param string $result 获取access_token的方法的返回值
     */
    protected function parseToken($result) {
        if (is_array($result)) {
            $data = $result;
        }else{
            parse_str($result, $data);
        }
        if ($data['access_token']) {
            if ($data['expires_in']) {
                Typecho_Cookie::set('__typecho_oauth_token_'.$this->channel, $data['access_token'], $this->timestamp + $data['expires_in'] - 600);
            }
            $this->token    = $data;
            $data['openid'] = $this->openid();
            return $data;
        } else {
            return $this->setError("获取腾讯QQ ACCESS_TOKEN 出错：{$result}");
        }
    }

    /**
     * 获取当前授权应用的openid
     * @return string
     */
    public function openid() {
        $data = $this->token;
        if (isset($data['openid'])) {
            return $data['openid'];
        } elseif ($data['access_token']) {
            $http = Typecho_Http_Client::get();
            $data = $http->setQuery( array( 'access_token' => $data['access_token'] ) )->send($this->url('oauth2.0/me'));
            $data = json_decode(trim(substr($data, 9), " );\n"), true);
            if (isset($data['openid'])) {
                return $data['openid'];
            } else {
                return $this->setError("获取用户openid出错：{$data['error_description']}");
            }
        } else {
            return $this->setError('没有获取到openid！');
        }
    }

    /**
     * 获取授权用户的用户信息
     */
    public function userinfo() {
        $rsp = $this->call('user/get_user_info');
        if (!$rsp || $rsp['ret'] != 0) {
            return $this->setError($rsp['msg']);
        } else {
            $userinfo = array(
                'openid'  => $this->openid(),
                'channel' => $this->channel,
                'nick'    => $rsp['nickname'],
                'gender'  => $rsp['gender'] == "男" ? 'm' : 'f',
                'avatar'  => $rsp['figureurl_qq_2'] ? $rsp['figureurl_qq_2'] : $rsp['figureurl_qq_1']
            );
            return $userinfo;
        }
    }

}
