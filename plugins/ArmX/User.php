<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * 用户接口
 *
 * @category typecho
 * @package Widget
 * @copyright Copyright (c) 2008 Typecho team (http://www.typecho.org)
 * @license GNU General Public License 2.0
 */
class ArmX_User extends ArmX_Api
{

    /**
     * 判断用户名称是否存在
     *
     * @access public
     * @param string $name 用户名称
     * @return boolean
     */
    public function nameExists($name)
    {
        $select = $this->db->select()
        ->from('table.users')
        ->where('name = ?', $name)
        ->limit(1);

        if ($this->request->uid) {
            $select->where('uid <> ?', $this->request->uid);
        }

        $user = $this->db->fetchRow($select);
        return $user ? false : true;
    }

    /**
     * 判断电子邮件是否存在
     *
     * @access public
     * @param string $mail 电子邮件
     * @return boolean
     */
    public function mailExists($mail)
    {
        $select = $this->db->select()
        ->from('table.users')
        ->where('mail = ?', $mail)
        ->limit(1);

        if ($this->request->uid) {
            $select->where('uid <> ?', $this->request->uid);
        }

        $user = $this->db->fetchRow($select);
        return $user ? false : true;
    }

    /**
     * 第三方绑定
     * @author NatLiu
     * @date   2018-01-17T14:57:51+0800
     * @return [type]                   [description]
     */
    public function bindOAuth($openid, $channel = 'qq')
    {
        if (!$this->user->hasLogin()) {
            return $this->error('未登录,绑定失败');
        }
        if($this->db->query($this->db
                ->update('table.oauths')
                ->rows(array('uid' => $this->user->uid))
                ->where('openid = ? AND channel = ?', $openid, $channel  ))
        ){
            return $this->success('绑定成功');
        }else{
            return $this->error('绑定失败,请重试');
        }
    }

    /**
     * 判断第三方登录状态
     * @author NatLiu
     * @date   2018-01-17T15:18:43+0800
     * @return boolean                  [description]
     */
    private function getOAuth(){
        $oauth = Typecho_Cookie::get('__typecho_oauth_openid');
        if(empty($oauth)){
            return false;
        }
        $oauth = explode('_', $oauth);
        if (!$this->oauthUsers->openidExists($oauth[1], $oauth[0]) ) {
            return false;
        }
        return $oauth;
    }

    /**
     * 第三方登录
     * @author NatLiu
     * @date   2018-01-16T14:48:22+0800
     * @param  array                    $user [description]
     * @return [type]                         [description]
     */
    public function oauthLogin($request)
    {
        if ( $oauth = $this->getOAuth() ) {
            return $this->success(_t('您已通过第三方账号登录'));
        }
        if ($request && $request->__isSet('openid') && $request->__isSet('channel') ) {
            if ($this->user->hasLogin()) {
                $this->logout(); // 注销本地账号
            }
            // 如果已存在则更新登录时间
            $row = array('activated'=> $this->options->time, 'nickname'=> $request->nick, 'avatar'=>$request->avatar );

            if($this->oauthUsers->openidExists($request->openid, $request->channel)){ // 如果有登录记录，则更新记录
                if (empty($row['nickname'])) {
                    unset($row['nickname']);
                }
                if (empty($row['avatar'])) {
                    unset($row['avatar']);
                }
                $this->oauthUsers->update($row, $this->db->sql()->where('openid = ? AND channel = ?',$request->openid, $request->channel));
                if ( $uid = $this->oauthUsers->hasAccount($request->openid, $request->channel) ) { // 如果绑定本地账号，则登录本地账号
                    $this->__login($uid);
                    return $this->success(_t('登录成功'));
                }
            }else{
                // 新增授权
                $row['openid'] = $request->openid;
                $row['channel'] = $request->channel;
                $row['unionid'] = $request->unionid;
                $row['created'] = $row['activated'];
                $this->oauthUsers->insert($row);
            }
            Typecho_Cookie::set('__typecho_oauth_openid', $request->channel.'_'.$request->openid);
            Typecho_Cookie::set('__typecho_oauth_avatar', $request->avatar, 0);
            Typecho_Cookie::set('__typecho_oauth_nickname', $request->nick, 0);

            return $this->success(_t('登录成功'));
        }
        return $this->error(_t('登录失败'));
    }

    /**
     * 登出第三方
     * @author NatLiu
     * @date   2018-01-16T14:48:28+0800
     * @param  array                    $user [description]
     * @return [type]                         [description]
     */
    public function oauthLogout()
    {
        Typecho_Cookie::delete('__typecho_oauth_openid');
        Typecho_Cookie::delete('__typecho_oauth_avatar');
        Typecho_Cookie::delete('__typecho_oauth_nickname');
        return $this->success(_t('退出成功'));
    }

    /**
     * 内部登录
     * @author NatLiu
     * @date   2018-01-17T13:14:04+0800
     * @param  [type]                   $uid    [description]
     * @param  integer                  $expire [description]
     * @return [type]                           [description]
     */
    private function __login($uid, $expire = 0){
        $authCode = function_exists('openssl_random_pseudo_bytes') ?
                    bin2hex(openssl_random_pseudo_bytes(16)) : sha1(Typecho_Common::randString(20));
        $user['authCode'] = $authCode;

        Typecho_Cookie::set('__typecho_uid', $uid, $expire);
        Typecho_Cookie::set('__typecho_authCode', Typecho_Common::hash($authCode), $expire);

        //更新最后登录时间以及验证码
        $this->db->query($this->db
        ->update('table.users')
        ->expression('logged', 'activated')
        ->rows(array('authCode' => $authCode))
        ->where('uid = ?', $uid));
    }

    /**
     * 登录函数
     *
     * @access public
     * @return void
     */
    public function login()
    {

        /** 如果已经登录 */
        if ($this->user->hasLogin()) {
            // 注销oauth
            $this->oauthLogout();
            /** 直接返回 */
            return $this->success(_t('您已登录'));
        }
        /** 初始化验证类 */
        $validator = new Typecho_Validate();
        $validator->addRule('name', 'required', _t('请输入用户名'));
        $validator->addRule('password', 'required', _t('请输入密码'));

        /** 截获验证异常 */
        if ($error = $validator->run($this->request->from('name', 'password'))) {
            Typecho_Cookie::set('__typecho_remember_name', $this->request->name);
            return $this->error(implode(',', array_values($error)));
        }

        /** 开始验证用户 **/
        $valid = $this->user->login($this->request->name, $this->request->password,
        false, 1 == $this->request->remember ? $this->options->time + $this->options->timezone + 30*24*3600 : 0);

        /** 比对密码 */
        if (!$valid) {
            /** 防止穷举,休眠2秒 */
            sleep(2);
            Typecho_Cookie::set('__typecho_remember_name', $this->request->name);
            return $this->error(_t('用户名或密码无效'));
        }
        if ($this->request->bindOAuth == '1' && $oauth = $this->getOAuth()) {
            $bindOAuth = $this->bindOAuth($oauth[1], $oauth[0]);
            if (!$bindOAuth || $bindOAuth['error'] == '1' ) {
                $this->logout();
            }
        }
        $this->oauthLogout();
        return $bindOAuth ? $bindOAuth : $this->success(_t('登录成功'));
    }

    /**
     * 注销函数
     */
    public function logout()
    {
        $this->user->logout();
        @session_destroy();
        return $this->success(_t('退出成功'));
    }

    /**
     * 注册函数
     *
     * @access public
     * @return void
     */
    public function register()
    {
        /** 如果已经登录 */
        if ($this->user->hasLogin() || !$this->options->allowRegister) {
            /** 直接返回 */
            return $this->error(_t('您已登录或尚未开放注册'));
        }

        /** 初始化验证类 */
        $validator = new Typecho_Validate();
        $validator->addRule('name', 'required', _t('必须填写用户名称'));
        $validator->addRule('name', 'minLength', _t('用户名至少包含2个字符'), 2);
        $validator->addRule('name', 'maxLength', _t('用户名最多包含32个字符'), 32);
        $validator->addRule('name', 'xssCheck', _t('请不要在用户名中使用特殊字符'));
        $validator->addRule('name', array($this, 'nameExists'), _t('用户名已经存在'));

        /** 如果请求中有password */
        if (array_key_exists('password', $_REQUEST)) {
            $validator->addRule('password', 'required', _t('必须填写密码'));
            $validator->addRule('password', 'minLength', _t('为了保证账户安全, 请输入至少六位的密码'), 6);
            $validator->addRule('password', 'maxLength', _t('为了便于记忆, 密码长度请不要超过十八位'), 18);
            $validator->addRule('confirm', 'confirm', _t('两次输入的密码不一致'), 'password');
            $password = $_REQUEST['password'];
        }else{ // 邮箱注册
            $validator->addRule('mail', 'required', _t('必须填写电子邮箱'));
            $validator->addRule('mail', array($this, 'mailExists'), _t('电子邮箱地址已经存在'));
            $validator->addRule('mail', 'email', _t('电子邮箱格式错误'));
            $validator->addRule('mail', 'maxLength', _t('电子邮箱最多包含200个字符'), 200);
        }

        /** 截获验证异常 */
        if ($error = $validator->run($this->request->from('name', 'password', 'mail', 'confirm'))) {
            Typecho_Cookie::set('__typecho_remember_name', $this->request->name);
            Typecho_Cookie::set('__typecho_remember_mail', $this->request->mail);

            /** 设置提示信息 */
            return $this->error(implode(',', array_values($error)));
        }

        $hasher = new PasswordHash(8, true);
        $generatedPassword = $password ? $password : Typecho_Common::randString(7);

        $dataStruct = array(
            'name'      =>  $this->request->name,
            'mail'      =>  $this->request->mail,
            'screenName'=>  $this->request->name,
            'password'  =>  $hasher->HashPassword($generatedPassword),
            'created'   =>  $this->options->time,
            'group'     =>  'subscriber'
        );
        $insertId = $this->db->query($this->db->insert('table.users')->rows($dataStruct));

        $this->user->login($this->request->name, $generatedPassword);

        if ($this->request->bindOAuth == '1' && $oauth = $this->getOAuth()) {
            $bindOAuth = $this->bindOAuth($oauth[1], $oauth[0]);
        }
        //注销oauth
        $this->oauthLogout();
        Typecho_Cookie::delete('__typecho_first_run');
        Typecho_Cookie::delete('__typecho_remember_name');
        Typecho_Cookie::delete('__typecho_remember_mail');
        $msg = '';
        if ($bindOAuth && $bindOAuth['error'] != '1' ) {
            $msg = _t('绑定成功，且');
        }else{
            $msg = _t('绑定失败，但');
        }
        $msg .= _t('用户 <strong>%s</strong> 已经成功注册', $this->request->name);
        if (!$password) {
            $msg .= _t(', 密码为 <strong>%s</strong>', $generatedPassword);
        }
        
        return $this->success($msg);
    }
}
