<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/**
 * 新浪微博登陆Api
 */

class ArmX_OAuth_weibo extends ArmX_OAuth {

    /**
     * 获取requestCode的api接口
     * @var string
     */
    protected $AuthorizeURL = 'https://api.weibo.com/oauth2/authorize';

    /**
     * 获取Access Token的api接口
     * @var type String
     */
    protected $AccessTokenURL = 'https://api.weibo.com/oauth2/access_token';

    /**
     * API根路径
     * @var string
     */
    protected $ApiBase = 'https://api.weibo.com/2/';

    /**
     * 获取授权页URL
     * @author NatLiu
     * @date   2018-01-24T08:38:32+0800
     * @param  string                   $referer [description]
     * @return [type]                            [description]
     */
    public function getAuthorizeURL($referer = '') {
        setcookie('A_S', $referer, $this->timestamp + 600, '/');
        $this->initConfig();
        //Oauth 标准参数
        $params = array(
            'client_id'    => $this->config['app_key'],
            'redirect_uri' => $this->config['callback'],
            'state'        => empty($referer)?'1' : $referer,
            'scope'        => $this->config['scope'],
            'display'      => $this->display
        );
        return $this->AuthorizeURL . '?' . http_build_query($params);
    }

    protected function initConfig() {
        parent::initConfig();
        if ($this->display == 'mobile') {
            $this->AuthorizeURL = 'https://open.weibo.cn/oauth2/authorize';
        }
    }

    /**
     * 接口调用方法
     * @author NatLiu
     * @date   2018-01-24T08:38:21+0800
     * @param  [type]                   $api    [description]
     * @param  string                   $param  [description]
     * @param  string                   $method [description]
     * @return [type]                           [description]
     */
    public function call($api, $param = '', $method = 'GET') {
        $params = array(
            'access_token' => $this->token['access_token'],
        );
        $method = $method === 'POST' ? 'setData' :'setQuery';
        $http = Typecho_Http_Client::get();
        $data = $http->{$method}($this->param($params, $param))->send($this->url($api, '.json'));
        return json_decode($data, true);
    }

    protected function parseToken($result) {
        $data = json_decode($result, true);
        if ($data['access_token'] && $data['expires_in'] && $data['remind_in'] && $data['uid']) {
            $data['openid'] = $data['uid'];
            unset($data['uid']);
            return $data;
        } else {
            return $this->setError("获取新浪微博ACCESS_TOKEN出错：{$data['error']}");
        }
    }

    /**
     * 获取当前授权应用的openid
     * @return string
     */
    public function openid() {
        $data = $this->token;
        if (isset($data['openid']))
            return $data['openid'];
        else
            return $this->setError('没有获取到新浪微博用户ID！');
    }

    /**
     * 获取授权用户的用户信息
     */
    public function userinfo() {
        $rsp = $this->call('users/show', 'uid=' . $this->openid());
        if (isset($rsp['error_code'])) {
            $rsp['token'] = $this->token;
            return $rsp;
            return $this->setError('接口访问失败！' . $rsp['error']);
        } else {
            $userinfo = array(
                'openid'  => $this->openid(),
                'channel' => 'weibo',
                'nick'    => $rsp['screen_name'],
                'gender'  => $rsp['gender'],
                'avatar'  => $rsp['avatar_hd']
            );
            return $userinfo;
        }
    }

}
