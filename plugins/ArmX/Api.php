<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
* API
*/
class ArmX_Api extends Typecho_Widget
{
	private $version = '1.0';
	protected $allowModules = array();

	protected $protectedModules = array('user');

	protected $allowActions = array(
			'music' => array('search', 'song', 'album', 'playlist', 'artist', 'lyric', 'media', 'pic', 'url', 'top'),
			'user' => array('login', 'logout', 'register', 'oauthLogin', 'oauthLogout', 'bindOAuth'),
			'oauth' => array()
		);

	protected $oauthConfig = array();

	/**
     * 全局选项
     *
     * @access protected
     * @var Widget_Options
     */
    protected $options;

    /**
     * 用户对象
     *
     * @access protected
     * @var Widget_User
     */
    protected $user;

    /**
     * 安全模块
     *
     * @var Widget_Security
     */
    protected $security;

    /**
     * 数据库对象
     *
     * @access protected
     * @var Typecho_Db
     */
    protected $db;

    /**
     * 构造函数,初始化组件
     *
     * @access public
     * @param mixed $request request对象
     * @param mixed $response response对象
     * @param mixed $params 参数列表
     */
    public function __construct($request, $response, $params = NULL)
    {

        parent::__construct($request, $response, $params);

        /** 初始化数据库 */
        $this->db = Typecho_Db::get();

        /** 初始化常用组件 */
        $this->options = $this->widget('Widget_Options');
        $this->user = $this->widget('Widget_User');
        $this->security = $this->widget('Widget_Security');
        $this->allowModules = ArmX_Plugin::getConfig('api');
        $this->oauthUsers = $this->widget('ArmX_OAuth_Users');
    }

    /**
     * 执行组件
     * @author NatLiu
     * @date   2018-01-10T11:08:06+0800
     * @return [type]                   [description]
     */
    public function execute()
    {
    	$this->parseAuthConfig();
    	//访问控制
    	$invalid = $this->invalid();
        if ($invalid) {
        	$this->responseData( $this->error($invalid) );
        }
    }
    /**
     * 解析第三方登录接口设置
     */
    private function parseAuthConfig(){
    	$plugin = $this->options->plugin(ArmX_Plugin::NAME);

		$config = array(
			'qq' => array(
					'name' => 'QQ号',
		            'scope'      => 'get_user_info'
				),
			'weibo' => array(
					'name' => '新浪微博',
		            'scope'      => null
				),
			'osc' => array(
					'name' => '开源中国',
		            'scope'      => 'user'
				),
			'github' => array(
					'name' => 'GitHub',
		            'scope'      => 'user'
				),
			'alipay' => array(
					'name' => '支付宝',
		            'scope'      => 'auth_user,auth_base'
				)
		);
		foreach ($config as $key => $value) {
			$appkey = 'oauth_'.$key.'_app_key';
			$secret = 'oauth_'.$key.'_app_secret';
			$callback = 'oauth_'.$key.'_callback';
			if (empty($plugin->{$appkey}) || empty($plugin->{$secret}) || empty($plugin->{$callback}) ){
				continue;
			}
			$this->allowActions['oauth'][] = $key;
			$this->oauthConfig[$key] = array(
					'app_key' => $plugin->{$appkey},
					'app_secret' => $plugin->{$secret},
					'callback' => array(
		            	'default' => $plugin->{$callback},
		            	'mobile' => $plugin->{$callback},
		            ),
		            'scope' => $value['scope'],
		            'name' => $value['name']
				);
		}
    }

    /**
     * 音乐模块
     * @return [type] [description]
     */
	protected function music($action, $request)
	{
		$api = new ArmX_Music($request->platform);
		
		$music = [];
		if ($action === "media") {
		    if ($request->get('third_api') && $request->platform ==="netease") {
		    	$music = $api->format(true)->detail($request->url_id);
		    }else{
				$music['pic'] = $api->format(true)->pic($request->pic_id);
				$music['src'] =  $api->format(true)->url($request->url_id);
			}
		}else if($action==="search"){
			$music = $api->format(true)->search($request->keyword);
		}else{
			$music = $api->format(true)->{$action}($request->id);
		}
		return $music;
	}

	/**
	 * 用户模块
	 */
	protected function user($action, $request)
	{
		return $this->widget('ArmX_User')->{$action}($request);
	}

	/**
	 * 第三方登录模块
	 * @author NatLiu
	 * @date   2018-01-16T10:29:38+0800
	 * @param  [type]                   $action  [description]
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	protected function oauth($action, $request)
	{
		$config = $this->oauthConfig[$action];
		if (!$config ) {
			return $this->error('暂不支持['.$action.']OAuth接口');
		}
        $OAuth  = ArmX_OAuth::getInstance($config, $action);
        if ($request->get('do') == "connect") {
        	return $this->response->redirect($OAuth->getAuthorizeURL( urlencode($request->getReferer()) ));
        }
        $token = $OAuth->getAccessToken(true);
        if ($token) {
        	$userinfo = $OAuth->userinfo();
        }else{
        	$error = $OAuth->error();
        }
        if (!$userinfo) {
        	$error = $OAuth->error();
        }else{
        	if (!empty($userinfo['error'])) {
        		$error = '授权失败或取消';
        	}else{
        		$user = new Typecho_Config($userinfo);
        		$login = $this->user('oauthLogin', $user );
        	}
        }

        if (empty($login) || $login['error'] == 1) {
        	$error = !empty($login['msg']) ? $login['msg'] : $error;
        }else{
        	$success = true;
        }
        $this->response->setContentType('text/html');

        $result = '<script type="text/javascript">(function(){';
        $result .= 'var referer="' . urldecode($request->state) . '";try { if(window.parent && window.parent!=window && window.parent.oauth){';
        if( $success ){
        	$result .= 'window.parent.oauthSuccess();';
        }else{
        	$result .= 'window.parent.oauthError("' . htmlspecialchars($error) . '");';
        }
        $result .= '}else if(window.opener && window.opener.oauth){';
        if( $success ){
        	$result .= 'window.opener.oauthSuccess();';
        }else{
        	$result .= 'window.opener.oauthError("' . htmlspecialchars($error) . '");';
        }		
        $result .= 'window.close();}else if(referer && referer!==window.top.location.href){ window.top.location.href = referer;}';
        $result .= '} catch(e) { if(referer && referer!==window.top.location.href) {window.top.location.href = referer;} }  })();</script>';
        echo $result;
        exit;

	}

	/**
	 * API入口
	 * @return [type] [description]
	 */
	public function action()
	{
		$result = $this->{$this->request->module}($this->request->action, $this->request);
		if (!$result) {
			$result = $this->error();
		}elseif ($result === true) {
			$result = $this->success();
		}
		$this->responseData( $result );
	}

	/**
	 * api模块信息
	 */
	public function module()
	{
		$this->responseData(['version'=>$this->version, 'module'=> $this->request->module, 'actions'=> $this->allowActions[$this->request->module]]);
	}

	/**
	 * api信息
	 */
	public function index()
	{
		$this->responseData(['version'=>$this->version, 'modules'=> ArmX_Plugin::getConfig('api')]);
	}

	/**
	 * 验证接口访问合法性
	 * @author NatLiu
	 * @date   2018-01-10T09:43:57+0800
	 * @return [type]                   [description]
	 */
	private function invalid()
	{
		if ($this->request->get('module') && (empty($this->allowModules) || !in_array( $this->request->module, $this->allowModules)) ) {
			return $this->request->module . ' Module接口不存在或已禁用';
		}
		if (!empty($this->protectedModules) && in_array($this->request->module, $this->protectedModules) && $this->request->get('_') != $this->security->getToken($this->request->getReferer())  ) {
			return '鉴权失败';
		}
		$allowActions = $this->allowActions[$this->request->module];
		if ($this->request->get('action') && (empty($allowActions) || !in_array($this->request->action, $allowActions) )) {
			return $this->request->action . ' Action接口不存在或已禁用';
		}
		return false;
	}

	/**
	 * 魔术方法，容错
	 * @param  [type] $name [description]
	 * @param  [type] $args [description]
	 * @return [type]       [description]
	 */
	public function __call($name, $args)
	{
		$this->responseData($this->error($name.($args[0] ? '/'. $args[0] : ''). '接口暂不支持'));
	}

	/**
	 * 响应回执
	 * @author NatLiu
	 * @date   2018-01-23T10:24:28+0800
	 * @return [type]                   [description]
	 */
	protected function responseData($data)
	{
		if(is_string($data)){
			$data = Json::decode($data);
		}
		if (isset($_GET['callback'])) {
			$jsonp = empty($_GET['callback']) ? 'jsonp' : $_GET['callback'];
			$this->response->setContentType();
			echo $jsonp . '(' .Json::encode($data) . ')';
			exit;
		}
		$this->response->throwJson($data);
	}

	/**
	 * 失败返回
	 * @author NatLiu
	 * @date   2018-01-09T09:36:27+0800
	 * @param  string                   $error [description]
	 * @return [type]                          [description]
	 */
	protected function error($error = '操作失败')
	{
		return ['error'=> 1, 'msg'=> $error];
	}

	/**
	 * 成功返回
	 * @author NatLiu
	 * @date   2018-01-09T09:36:27+0800
	 * @param  string                   $success description]
	 * @return [type]                          [description]
	 */
	protected function success( $success =  '操作成功')
	{
		return ['error' => 0, 'msg'=> $success];
	}
}