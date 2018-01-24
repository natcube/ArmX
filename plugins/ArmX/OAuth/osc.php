<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * osc登陆Api
 */
class ArmX_OAuth_osc extends ArmX_OAuth {

    /**
     * 获取code的api接口
     * @var string
     */
    protected $AuthorizeURL = 'https://www.oschina.net/action/oauth2/authorize';

    /**
     * 获取Access Token的api接口
     * @var type String
     */
    protected $AccessTokenURL = 'http://www.oschina.net/action/openapi/token';

    /**
     * API根路径
     * @var string
     */
    protected $ApiBase = 'http://www.oschina.net/action/openapi/';

    protected $channel = 'osc';
    /**
     * 请求Authorize访问地址
     */
    public function getAuthorizeURL($referer = '') {
        setcookie('A_S', $referer, $this->timestamp + 600, '/');
        $this->initConfig();
        //Oauth 标准参数
        $params = array(
            'client_id'     => $this->config['app_key'],
            'redirect_uri'  => $this->config['callback'],
            'state'         => $referer,
            'response_type' => 'code'
        );
        return $this->AuthorizeURL . '?' . http_build_query($params);
    }

    /**
     * 默认的AccessToken请求参数
     * @return type
     */
    protected function _params() {

        return array(
        		'client_id'			=>	$this->config['app_key'],
				'client_secret'		=>	$this->config['app_secret'],
				'code'				=>	$_GET['code'],
				'redirect_uri'		=>	$this->config['callback'],
				'state'				=>	$_GET['state'],
                'grant_type'    => 'authorization_code',
                'dataType' => 'json'
        	);
    }


    /**
     * 接口调用方法
     * @author NatLiu
     * @date   2018-01-24T08:37:05+0800
     * @param  [type]                   $api    [description]
     * @param  array                    $param  [description]
     * @param  string                   $method [description]
     * @return [type]                           [description]
     */
    public function call($api, $param = array(), $method = 'GET') {
        $params = array(
            'access_token'       => $this->token['access_token'],
            'dataType' => 'json'
        );
        $http = Typecho_Http_Client::get();
        $http->setQuery($this->param($params, $param));
        $data = $http->send($this->url($api));

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
            $data = json_decode($result, 1);
        }
        if ($data) {
            if ($data['access_token']) {
                if ($data['expires_in']) {
                    Typecho_Cookie::set('__typecho_oauth_token_'.$this->channel, $data['access_token'], $this->timestamp + $data['expires_in'] - 600);
                }
                $this->token  = $data;
                return $data;
            }else{
                $result = $data['error'];
            }
        }
        return $this->setError("获取开源中国 ACCESS_TOKEN 出错：{$result}");
    }

    /**
     * 获取当前授权应用的openid
     * @return string
     */
    public function openid() {
        $data = $this->token;
        if (isset($data['uid'])) {
            return $data['uid'];
        } else {
            return $this->setError('没有获取到openid！');
        }
    }

    /**
     * 获取授权用户的用户信息
     */
    public function userinfo() {
        $rsp = $this->call('user');

        $error = '获取用户信息出错';
        if (empty($rsp)) {
            return $this->setError($error);
        }

        if (!empty($rsp['error'])) {
            return $this->setError($error . '：' .$rsp['error']);
        } else {

            $userinfo = array(
                'openid'  => $rsp['id'],
                'channel' => $this->channel,
                'nick'    => $rsp['name'],
                'gender'  => $rsp['gender']=='male' ? 'm':'f',
                'avatar'  => $rsp['avatar'],
            );
            return $userinfo;
        }
    }

}
