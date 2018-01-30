<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/**
 * 扩展增强
 * 
 * @package ArmX
 * @author NatLiu
 * @version 1.0.0
 * @link http://codeup.me
 */
class ArmX_Plugin implements Typecho_Plugin_Interface
{
    const NAME = 'ArmX';
    const THUMB_FIELD = '_thumbnail_id';
    const THUMB_FIELD_TYPE = 'str';
    const IMGPREFIX = 'img';

    protected static $IMGEXTS = array('jpg', 'jpeg', 'gif', 'png', 'tiff', 'bmp');
    protected static $APIS = array(
                'user' => '用户, 支持 <code>login,logout,register,oauthLogin,oauthLogout,bindOAuth</code>',
                'music' => '音乐, 支持 <code>search,song,album,playlist,artist,lyric,media,pic,url,top</code>',
                'oauth' => '第三方登录, 支持 <code>qq,weibo,osc,github,alipay</code>'
            );

    private static $_readOnlyFields = array();

    /**
     * 环境对象
     * @var null
     */
    private static $_instance = NULL;

    /**
     * 插件内部参数
     * @var null
     */
    private static $_config = NULL;

    /**
     * 全局配置
     * @var null
     */
    private static $_options = NULL;

    /**
     * 内部参数默认值
     * @var array
     */
    private static $_defaultConfig = array(
                'enable' => array(
                                'thumbnailCrop',
                                'uploadTypechoRoot'
                            ),
                'https' => '0',
                'uploadServerHost' => 'local'
            );

    /**
     * 全局参数默认值
     * @var array
     */
    private static $_defaultOptions = array(
                'thumbnailSizeWidth' => 200,
                'thumbnailSizeHeight' => 150,
                'mediumSizeWidth' => 640,
                'mediumSizeHeight' => 9999,
                'largeSizeWidth' => 1200,
                'largeSizeHeight' => 9999,
                'uploadDir' => NULL,
                'uploadServerRoot' => NULL,
                'uploadServerUrl' => NULL,
                'cdnUrl' => NULL,
                'gravatarPrefix' => null
            );

    /**
     * 获取环境对象
     * @author NatLiu
     * @date   2017-12-20T10:32:49+0800
     * @param  [type]                   $key [description]
     * @return [type]                        [description]
     */
    public static function get($key = NULL)
    {
        if (NULL === self::$_instance) {
            $obj = new Typecho_Config();
            $obj->request = Typecho_Request::getInstance();
            $obj->response = Typecho_Response::getInstance();
            $obj->options = Typecho_Widget::widget('Widget_Options');
            $obj->db = Typecho_Db::get();
            $obj->user = Typecho_Widget::widget('Widget_User');
            $obj->edit = Typecho_Widget::widget('Widget_Plugins_Edit');
            self::$_instance = $obj;
        }
        if( !empty($key) && is_string($key) ){
            return isset(self::$_instance->{$key}) ? self::$_instance->{$key} : NULL;
        }
        return self::$_instance;
    }

    /**
     * 获取插件内部参数
     * @author NatLiu
     * @date   2017-12-20T10:22:12+0800
     * @param  [type]                   $key [description]
     * @return [type]                        [description]
     */
    public static function getConfig($key = NULL)
    {
        if (NULL === self::$_config) {
            $config = self::$_defaultConfig;
            if ($key===true) {
                $_options = self::get('options')->{self::NAME.'_Plugin'};
            }else{
                $_options = self::get('options')->plugin(self::NAME);
            }
            if (!empty($_options) && false !== ($options = unserialize($_options)) ) {
                $config = array_merge($config, $options);
            }
            self::$_config = new Typecho_Config($config);
        }
        if( !empty($key) && is_string($key) ){
            return isset(self::$_config->{$key}) ? self::$_config->{$key} : NULL;
        }
        return self::$_config;
    }

    /**
     * 获取插件全局选项
     * @author NatLiu
     * @date   2017-12-20T10:33:13+0800
     * @param  [type]                   $key [description]
     * @return [type]                        [description]
     */
    public static function getOptions($key = NULL)
    {
        if (NULL === self::$_options) {
            $_options = self::$_defaultOptions;
            $options = self::get('options');
            foreach ($_options as $name => $value) {
                if ($options->__isSet($name)) {
                    $_options[$name] = $options->{$name};
                }
            }
            self::$_options = new Typecho_Config($_options);
        }

        if( !empty($key) && is_string($key) ){
            return isset(self::$_options->{$key}) ? self::$_options->{$key} : NULL;
        }
        return self::$_options;
    }

    /**
     * 保存内部参数
     * @author NatLiu
     * @date   2017-12-20T12:37:06+0800
     * @param  array                    $config [description]
     * @return [type]                           [description]
     */
    public static function saveConfig($config = array())
    {
        self::get('edit')->configPlugin(self::NAME, $config);
    }

    /**
     * 保存全局选项
     * @author NatLiu
     * @date   2017-12-20T12:40:07+0800
     * @param  array                    $options [description]
     * @return [type]                            [description]
     */
    public static function saveOptions($options = array())
    {
        foreach ($options as $name => $value) {
            self::saveOption($name, $value);
        }
    }

    /**
     * 保存单个配置项
     * @author NatLiu
     * @date   2017-12-20T12:40:33+0800
     * @param  string                   $name  [description]
     * @param  string                   $value [description]
     * @return [type]                          [description]
     */
    public static function saveOption($name = '', $value = '')
    {
        $db = self::get('db');
        $select = $db->select()->from('table.options')
            ->where('name = ?', $name);
        $rows = $db->fetchRow($select);

        if ($value === NULL) {
            if (!empty($rows)) {
                $db->query($db->delete('table.options')->where('name = ? AND user = ?', $name, 0));
            }
        } else {
            if (!empty($rows)) {
                $db->query($db->update('table.options')->rows(array('value'=>$value))->where('name = ?', $name));
            } else {
                $db->query($db->insert('table.options')->rows(array(
                    'value'=> $value,
                    'name' => $name,
                    'user' => 0
                )));
            }
        }
    }
    
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     * 
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate()
    {
        
        Typecho_Plugin::factory('admin/common.php')->begin = array(self::NAME.'_Plugin', 'adminBegin');
        Typecho_Plugin::factory('admin/menu.php')->navBar = array(self::NAME.'_Plugin', 'adminMenu');
        Typecho_Plugin::factory('admin/footer.php')->end = array(self::NAME.'_Plugin', 'adminEnd');
        Typecho_Plugin::factory('admin/header.php')->header = array(self::NAME.'_Plugin', 'adminHeader');
        Typecho_Plugin::factory('admin/write-post.php')->content = array(self::NAME.'_Plugin', 'writePostContent');
        Typecho_Plugin::factory('admin/write-post.php')->option = array(self::NAME.'_Plugin', 'writePostOption');
        Typecho_Plugin::factory('admin/write-post.php')->bottom = array(self::NAME.'_Plugin', 'writePostBottom');

        Typecho_Plugin::factory('admin/write-page.php')->content = array(self::NAME.'_Plugin', 'writePostContent');
        Typecho_Plugin::factory('admin/write-page.php')->option = array(self::NAME.'_Plugin', 'writePostOption');
        Typecho_Plugin::factory('admin/write-page.php')->bottom = array(self::NAME.'_Plugin', 'writePostBottom');

        Typecho_Plugin::factory('index.php')->begin = array(self::NAME.'_Plugin', 'indexBegin');
        Typecho_Plugin::factory('Widget_Archive')->beforeRender = array(self::NAME.'_Plugin', 'beforeRender');
        Typecho_Plugin::factory('Widget_Upload')->uploadHandle = array(self::NAME.'_Plugin', 'uploadHandle');
        Typecho_Plugin::factory('Widget_Upload')->modifyHandle = array(self::NAME.'_Plugin', 'modifyHandle');
        Typecho_Plugin::factory('Widget_Upload')->deleteHandle = array(self::NAME.'_Plugin', 'deleteHandle');
        Typecho_Plugin::factory('Widget_Upload')->attachmentHandle = array(self::NAME.'_Plugin', 'attachmentHandle');
        Typecho_Plugin::factory('Widget_Upload')->upload = array(self::NAME.'_Plugin', 'upload');

        Typecho_Plugin::factory('Widget_Abstract_Contents')->isFieldReadOnly = array(self::NAME.'_Plugin', 'isFieldReadOnly');
        Typecho_Plugin::factory('Widget_Abstract_Contents')->contentEx = array(self::NAME.'_Plugin', 'contentEx');

        Typecho_Plugin::factory('Widget_Contents_Post_Edit')->getDefaultFieldItems = array(self::NAME.'_Plugin', 'getDefaultFieldItems');

        // 注册面板
        Helper::addPanel(0, 'ArmX/edit-thumbnail.php', '设置缩略图', '缩略图设置', 'contributor', true);

        // 设置默认参数
        self::saveConfig(unserialize(self::getConfig(true)->__toString()));
        // 初始化配置项
        self::saveOptions(unserialize(self::getOptions(true)->__toString()));
    }

    /**
     * 保存配置
     * @author NatLiu
     * @date   2017-12-15T16:36:00+0800
     * @param  [type]                   $settings [description]
     * @param  [type]                   $isInit   [description]
     * @return [type]                             [description]
     */
    public static function configHandle($settings, $isInit){

        // 如是初始化
        if ($isInit) {
            return;
        }
        // 保存内置参数
        self::saveConfig($settings);

        // 保存全局参数
        $options = self::get('request')->from(array_keys(self::$_defaultOptions));
        if (!empty($options['cdnUrl'])) { // 如果设置了 CDN，静态资源站URL使用此值
            $options['uploadServerUrl'] = $options['cdnUrl'];
        }
        // 注册API路由
        $routingTable = self::get('options')->routingTable;
        if (isset($routingTable[0])) {
            unset($routingTable[0]);
        }
        unset($routingTable['api']);
        unset($routingTable['api_module']);
        unset($routingTable['api_action']);
        if (!empty($settings['api'])) {
            $routingTable = array_merge(array(
                'api_action'=>array('url'=>'/api/[module:alpha]/[action:alpha]', 'widget'=>'ArmX_Api', 'action' => 'action'),
                'api_module'=>array('url'=>'/api/[module:alpha]', 'widget'=>'ArmX_Api', 'action' => 'module'),
                'api'=> array('url'=>'/api', 'widget'=>'ArmX_Api', 'action' => 'index')
            ), $routingTable);


            if (in_array('oauth', $settings['api'])) {
                $sql = <<<SQL
CREATE TABLE IF NOT EXISTS `typecho_oauths` (
  `uid` int(10) unsigned DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `openid` varchar(255) NOT NULL,
  `channel` varchar(32) NOT NULL,
  `unionid` varchar(255) DEFAULT NULL,
  `created` int(10) unsigned default '0',
  `activated` int(10) unsigned default '0',
  `status` int(1) unsigned default '0',
  PRIMARY KEY  (`openid`,`channel`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=UTF8
SQL;
                self::get('db')->query(trim($sql), Typecho_Db::WRITE);
            }
        }

        Helper::options()->routingTable = $routingTable;
        $options['routingTable'] = serialize($routingTable);
        self::saveOptions($options);

        if (!self::get('options')->_configNoticed) {
            /** 提示信息 */
            $msg = self::get('request')->optionMsg ? self::get('request')->optionMsg : '插件设置已经保存';
            self::get('options')->widget('Widget_Notice')->set(_t($msg), 'success');
        }
        $url = 'options-plugin.php?config=' . self::NAME;
        if (!empty(self::get('request')->optionStep)) {
            $url .= '#'. self::get('request')->optionStep;
        }
        self::get('options')->response->redirect(Typecho_Common::url($url, self::get('options')->adminUrl));
    }

    /**
     * 设置选中项
     * @author NatLiu
     * @date   2017-12-21T09:07:10+0800
     * @param  [type]                   $name [description]
     * @param  [type]                   $arr  [description]
     * @return [type]                         [description]
     */
    public static function checkAttr($checked = false, $attr = 'checked')
    {
        return $checked ? ' '.$attr.'="'.$attr.'"' :'';
    }

    /**
     * 判断附件是否为图片
     * @author NatLiu
     * @date   2017-12-25T10:18:55+0800
     * @param  [type]                   $ext [description]
     * @return boolean                       [description]
     */
    public static function isImage($ext)
    {
        return in_array($ext, self::$IMGEXTS);
    }

    /**
     * 创建静态资源站URL
     * @author NatLiu
     * @date   2017-12-21T15:31:38+0800
     * @param  string                   $url   [description]
     * @param  boolean                  $https [description]
     * @return [type]                          [description]
     */
    public static function buildServerUrl($_url = '', $https = false)
    {
        if(empty($_url))
            return '';
        if ($https==0 && 0 === stripos($_url, 'http')) {
            return $_url;
        }
        $url = preg_replace('/^http(s)?:\/\//', '', Typecho_Common::safeUrl($_url));
        $http = 'http://';
        if ($https=='1') {
            $http = 'https://';
        } elseif($https=='2') {
            $http = self::get('request')->isSecure() ? 'https://' : 'http://';
        }
        return $http.$url;
    }

    /**
     * 创建HTML
     * @param  boolean $html    [description]
     * @param  string  $tagName [description]
     * @param  [type]  $attrs   [description]
     * @return [type]           [description]
     */
    public static function layout($html = false, $tagName = 'div', $attrs = NULL)
    {
        $item = new Typecho_Widget_Helper_Layout($tagName, $attrs);
        return $item->html($html);
    }

    /**
     * 调用类方法
     * @param  [type] $className [description]
     * @param  [type] $method    [description]
     * @return [type]            [description]
     */
    private static function call($className, $method = '')
    {
        $className = explode('::', $className);
        return array(self::NAME . '_' . $className[0], $className[1] ? $className[1] : $method);
    }
    
    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     * 
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate(){
        // 备份插件内置参数
        $config = self::getConfig();
        self::saveOption(self::NAME.'_Plugin', $config);
        //注销面板
        Helper::removePanel(0, 'ArmX/edit-thumbnail.php');
    }
    
    /**
     * 获取插件配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form)
    {
        $config = self::getConfig();
        $options = self::getOptions();
        $siteUrl = self::get('options')->siteUrl;

        $cdnUrl = self::buildServerUrl($options->cdnUrl, $config->https);
        $serverUrl = self::buildServerUrl($options->uploadServerUrl, $config->https);

        $errorCdnUrl = in_array('cdn', $config->enable) && empty($options->cdnUrl);
        // 功能选项
        $enableOptions = array(
            'multiSizesImage'    =>  _t('多尺寸图片, 支持缩略图，中等图，大图，及原图4种尺寸保存'),
            'thumbnail'    =>  _t('文档缩略图，支持编辑文档时设置缩略图'),
            'uploadServer'    =>  _t('静态资源站，开启后须设置静态资源站根目录及访问URL，实现动静分离部署'),
            'cdn'    =>  _t('CDN加速, 设置加速域名URL %s', ' <input type="text" class="w-50 text-s mono'.($errorCdnUrl ? ' invalid':'').'" name="cdnUrl" value="' . htmlspecialchars($cdnUrl) . '" />'),
        );
        $enable = new Typecho_Widget_Helper_Form_Element_Checkbox('enable', $enableOptions, $config->enable, _t('功能选项'), _t('开启静态资源站并配合使用CDN加速，加速效果更好'));

        if ($errorCdnUrl) {
            $enable->message(_t('请设置CDN加速域名'));
        }

        if(!empty($cdnUrl) && defined('__TYPECHO_UPLOAD_URL__') && $cdnUrl != __TYPECHO_UPLOAD_URL__){
            $enable->message(_t('警告：请删除常量 %s 定义，或修改为 %s', '<code>__TYPECHO_UPLOAD_URL__</code>', '<code>'.$cdnUrl.'</code>'));
        }

        /** HTTPS */
        $https = new Typecho_Widget_Helper_Form_Element_Radio('https', array('0' => _t('关闭'), '1' => _t('强制HTTPS'), '2' => _t('跟随协议HTTP/HTTPS')), $config->https, _t('静态资源HTTP/HTTPS'),
        _t('过滤静态资源访问是否启用HTTPS'));

        $multiSizesImageDiv = new Typecho_Widget_Helper_Layout('div', array('class'=>'typecho-option typecho-option-group', 'id' => 'multiSizesImage-option-group'));
        $multiSizesImageHTML = '<label class="typecho-label">设置图片尺寸（值为0时不剪裁）</label>
<div class="typecho-option-inline">
    <h4>缩略图</h4>
    <label for="thumbnailSizeWidth">缩放宽度 <input style="width:66px;" value="' . $options->thumbnailSizeWidth . '" type="number" min="0" name="thumbnailSizeWidth" id="thumbnailSizeWidth" /></label>
    <label for="thumbnailSizeHeight">缩放高度 <input style="width:66px;" value="' . $options->thumbnailSizeHeight . '" type="number" min="0" name="thumbnailSizeHeight" id="thumbnailSizeHeight" /></label>
    <label for="enable-thumbnailCrop"><input type="checkbox" name="enable[]"' . self::checkAttr(in_array('thumbnailCrop', $config->enable)) . ' value="thumbnailCrop" id="enable-thumbnailCrop" /> 严格剪裁缩略图为这个尺寸，不以原图比例缩放</label>
</div>
<div class="typecho-option-inline">
    <h4>中等图</h4>
    <label for="mediumSizeWidth">最大宽度 <input style="width:66px;" value="' . $options->mediumSizeWidth . '" type="number" min="0" name="mediumSizeWidth" id="mediumSizeWidth" /></label>
    <label for="mediumSizeHeight">最大高度 <input style="width:66px;" value="' . $options->mediumSizeHeight . '" type="number" min="0" name="mediumSizeHeight" id="mediumSizeHeight" /></label>
</div>
<div class="typecho-option-inline">
    <h4>大图</h4>
    <label for="largeSizeWidth">最大宽度 <input style="width:66px;" value="' . $options->largeSizeWidth . '" type="number" min="0" name="largeSizeWidth" id="largeSizeWidth" /></label>
    <label for="largeSizeHeight">最大高度 <input style="width:66px;" value="' . $options->largeSizeHeight . '" type="number" min="0" name="largeSizeHeight" id="largeSizeHeight" /></label>
</div>
';
        $multiSizesImageDiv->html($multiSizesImageHTML);
        if (!in_array('multiSizesImage', $config->enable)) {
            $multiSizesImageDiv->setAttribute('class',  $multiSizesImageDiv->getAttribute('class') . ' hidden');
        }

        $uploadServerDiv = new Typecho_Widget_Helper_Layout('div', array('class'=>'typecho-option-group', 'id' => 'uploadServer-option-group'));
        $errorUploadServerRoot = in_array('uploadServer', $config->enable) && $config->uploadServerHost=='local' && empty($options->uploadServerRoot) ? '请设置本地静态资源站根目录' : false;
        if (!empty($options->uploadServerRoot) && defined('__TYPECHO_UPLOAD_ROOT_DIR__') && $options->uploadServerRoot!= __TYPECHO_UPLOAD_ROOT_DIR__) {
            $errorUploadServerRoot = _t('警告：请删除常量 %s 定义，或修改为 %s', '<code>__TYPECHO_UPLOAD_ROOT_DIR__</code>', '<code>'.$options->uploadServerRoot.'</code>');
        }

        $errorUploadServerUrl = in_array('uploadServer', $config->enable) && empty($options->uploadServerUrl) ? '请设置静态资源站URL':false;
        if (!empty($options->uploadServerUrl) && defined('__TYPECHO_UPLOAD_URL__') && self::buildServerUrl($options->uploadServerUrl, $config->https)!= __TYPECHO_UPLOAD_URL__) {
            if (!empty($cdnUrl)) {
                $errorUploadServerUrl = _t('警告：已开启CDN加速，此值固定为CDN加速域名URL %s', '<code>'.$cdnUrl.'</code>');
            }else{
                $errorUploadServerUrl = _t('警告：请删除常量 %s 定义，或修改为 %s', '<code>__TYPECHO_UPLOAD_URL__</code>', '<code>'.$serverUrl.'</code>');
            }
        }
        $uploadServerHost = new Typecho_Widget_Helper_Form_Element_Radio('uploadServerHost', array('local'=>'本地服务器'), $config->uploadServerHost, _t('设置静态资源站'), _t('<label for="uploadTypechoRoot"><input type="checkbox" name="enable[]"' . self::checkAttr(in_array('uploadTypechoRoot', $config->enable)) . ' value="uploadTypechoRoot" id="enable-uploadTypechoRoot" /> 保留源站文件（建议勾选备份）</label>'));

        $uploadServerHTML = '<div class="typecho-option">
<label class="typecho-label">静态资源站根目录（本地服务器）</label>
<input type="text" class="text'. ($errorUploadServerRoot ? ' invalid' : '') .'" value="' . $options->uploadServerRoot . '" name="uploadServerRoot" />
<p class="description">本地静态资源站的根目录，如<code>' . __TYPECHO_ROOT_DIR__ . '</code></p>
'. ($errorUploadServerRoot ? '<p class="message error">'.$errorUploadServerRoot.'</p>' : '') .'
</div>
<div class="typecho-option">
<label class="typecho-label">静态资源站URL</label>
<input type="text" class="text'. ($errorUploadServerUrl ? ' invalid' : '') .'" value="' . (!empty($cdnUrl) && in_array('cdn', $config->enable) ? $cdnUrl . '" readonly="readonly"' : $serverUrl) . '" name="uploadServerUrl" />
'.(!empty($cdnUrl && in_array('cdn', $config->enable)) ? '<p class="message notice">提示：开启CDN加速后，此值固定为CDN加速域名</p>' : '<p class="description">本地/远程服务器静态资源站的URL，如<code>' . self::get('options')->rootUrl . '</code></p>').'
'. ($errorUploadServerUrl ? '<p class="message error">'.$errorUploadServerUrl.'</p>' : '') .'
</div>';
        $uploadServerDiv->html($uploadServerHTML);
        if (!in_array('uploadServer', $config->enable)) {
            $uploadServerDiv->setAttribute('class',  $uploadServerDiv->getAttribute('class') . ' hidden');
            $uploadServerHost->setAttribute('class',  $uploadServerHost->getAttribute('class') . ' hidden');
        }

        $uploadDirDiv = new Typecho_Widget_Helper_Layout('div', array('class'=>'typecho-option', 'id' => 'uploadDir-option'));
        $errorUploadDir = false;
        if (!empty($options->uploadDir) && defined('__TYPECHO_UPLOAD_DIR__') && $options->uploadDir!= __TYPECHO_UPLOAD_DIR__) {
            $errorUploadDir = _t('警告：请删除常量 %s 定义，或修改为 %s', '<code>__TYPECHO_UPLOAD_DIR__</code>', '<code>'.$options->uploadDir.'</code>');
        }
        $uploadDirHTML = '<label class="typecho-label">上传目录</label>
<input type="text" class="text" value="' . $options->uploadDir . '" name="uploadDir" />
<p class="description">修改上传目录，默认目录为<code>/usr/uploads</code></p>
'.($errorUploadDir ? '<p class="message error">'.$errorUploadDir.'</p>':'').'
';
        $uploadDirDiv->html($uploadDirHTML);
        $errorGravatarDir = false;
        $gravatarPrefixDiv = new Typecho_Widget_Helper_Layout('div', array('class'=>'typecho-option', 'id' => 'gravatarPrefix-option'));
        if (!empty($options->gravatarPrefix) && defined('__TYPECHO_GRAVATAR_PREFIX__') && $options->gravatarPrefix!= __TYPECHO_GRAVATAR_PREFIX__) {
            $errorGravatarDir = _t('警告：请删除常量 %s 定义，或修改为 %s', '<code>__TYPECHO_GRAVATAR_PREFIX__</code>', '<code>'.$options->gravatarPrefix.'</code>');
        }
        $gravatarPrefixHTML = '<label class="typecho-label">Gravatar头像地址前缀</label>
<input type="text" class="text" value="' . $options->gravatarPrefix . '" name="gravatarPrefix" />
<p class="description">Gravatar头像地址前缀，默认为<code>gravatar官方</code></p>
'.($errorGravatarDir ? '<p class="message error">'.$errorGravatarDir.'</p>':'').'
';
        $gravatarPrefixDiv->html($gravatarPrefixHTML);

        $api = new Typecho_Widget_Helper_Form_Element_Checkbox('api', self::$APIS, $config->api, _t('启用API'));
        $api->multiMode();

        if (!empty($config->api) && !in_array('oauth', $config->api)) {
            $oauth_title = self::layout('', 'span');
            $oauth_qq_key = new Typecho_Widget_Helper_Form_Element_Hidden('oauth_qq_app_key', null, $config->oauth_qq_app_key);
            $oauth_qq_secret = new Typecho_Widget_Helper_Form_Element_Hidden('oauth_qq_app_secret', null, $config->oauth_qq_app_secret);
            $oauth_qq_callback = new Typecho_Widget_Helper_Form_Element_Hidden('oauth_qq_callback', null, $config->oauth_qq_callback);
            $oauth_weibo_key = new Typecho_Widget_Helper_Form_Element_Hidden('oauth_weibo_app_key', null, $config->oauth_weibo_app_key);
            $oauth_weibo_secret = new Typecho_Widget_Helper_Form_Element_Hidden('oauth_weibo_app_secret', null, $config->oauth_weibo_app_secret);
            $oauth_weibo_callback = new Typecho_Widget_Helper_Form_Element_Hidden('oauth_weibo_callback', null, $config->oauth_weibo_callback);
            $oauth_osc_key = new Typecho_Widget_Helper_Form_Element_Hidden('oauth_osc_app_key', null, $config->oauth_osc_app_key);
            $oauth_osc_secret = new Typecho_Widget_Helper_Form_Element_Hidden('oauth_osc_app_secret', null, $config->oauth_osc_app_secret);
            $oauth_osc_callback = new Typecho_Widget_Helper_Form_Element_Hidden('oauth_osc_callback', null, $config->oauth_osc_callback);
            $oauth_github_key = new Typecho_Widget_Helper_Form_Element_Hidden('oauth_github_app_key', null, $config->oauth_github_app_key);
            $oauth_github_secret = new Typecho_Widget_Helper_Form_Element_Hidden('oauth_github_app_secret', null, $config->oauth_github_app_secret);
            $oauth_github_callback = new Typecho_Widget_Helper_Form_Element_Hidden('oauth_github_callback', null, $config->oauth_github_callback);
            $oauth_alipay_key = new Typecho_Widget_Helper_Form_Element_Hidden('oauth_alipay_app_key', null, $config->oauth_alipay_app_key);
            $oauth_alipay_secret = new Typecho_Widget_Helper_Form_Element_Hidden('oauth_alipay_app_secret', null, $config->oauth_alipay_app_secret);
            $oauth_alipay_callback = new Typecho_Widget_Helper_Form_Element_Hidden('oauth_alipay_callback', null, $config->oauth_alipay_callback);
        }else{

            $oauth_title = self::layout('设置第三方登录参数（留空则不开启）', 'h3');
            $oauth_qq_key = new Typecho_Widget_Helper_Form_Element_Text('oauth_qq_app_key', null, '', _t('QQ登录(APP ID)'));
            $oauth_qq_secret = new Typecho_Widget_Helper_Form_Element_Text('oauth_qq_app_secret', null, '', _t('QQ登录(APP Key)'), '去https://connect.qq.com创建应用，并设置回调地址为https://你的域名/api/oauth/qq' );
            $oauth_qq_callback = new Typecho_Widget_Helper_Form_Element_Text('oauth_qq_callback', null,Typecho_Common::url('api/oauth/qq', $siteUrl), _t('QQ登录(回调地址)'), '默认填写'.Typecho_Common::url('api/oauth/qq', $siteUrl));

            $oauth_weibo_key = new Typecho_Widget_Helper_Form_Element_Text('oauth_weibo_app_key', null, '', _t('新浪微博(App Key)'));
            $oauth_weibo_secret = new Typecho_Widget_Helper_Form_Element_Text('oauth_weibo_app_secret', null, '', _t('新浪微博(App Secret)'), '去http://open.weibo.com创建应用，并设置来源链接为https://你的域名' );
            $oauth_weibo_callback = new Typecho_Widget_Helper_Form_Element_Text('oauth_weibo_callback', null, Typecho_Common::url('api/oauth/weibo', $siteUrl), _t('新浪微博登录(回调地址)'), '默认填写'.Typecho_Common::url('api/oauth/weibo', $siteUrl));

            $oauth_osc_key = new Typecho_Widget_Helper_Form_Element_Text('oauth_osc_app_key', null, '', _t('开源中国(APP ID)'));
            $oauth_osc_secret = new Typecho_Widget_Helper_Form_Element_Text('oauth_osc_app_secret', null, '', _t('开源中国(APP Key)'), '去http://www.oschina.net创建应用，并设置回调地址为https://你的域名/api/oauth/osc' );
            $oauth_osc_callback = new Typecho_Widget_Helper_Form_Element_Text('oauth_osc_callback', null,Typecho_Common::url('api/oauth/osc', $siteUrl), _t('开源中国(回调地址)'), '默认填写'.Typecho_Common::url('api/oauth/osc', $siteUrl));

            $oauth_github_key = new Typecho_Widget_Helper_Form_Element_Text('oauth_github_app_key', null, '', _t('GitHub(Client ID)'));
            $oauth_github_secret = new Typecho_Widget_Helper_Form_Element_Text('oauth_github_app_secret', null, '', _t('GitHub(Client Secret)'), '去https://github.com创建应用，并设置回调地址为https://你的域名/api/oauth/github' );
            $oauth_github_callback = new Typecho_Widget_Helper_Form_Element_Text('oauth_github_callback', null, Typecho_Common::url('api/oauth/github', $siteUrl), _t('GitHub(回调地址)'), '默认填写'.Typecho_Common::url('api/oauth/github', $siteUrl));

            $oauth_alipay_key = new Typecho_Widget_Helper_Form_Element_Text('oauth_alipay_app_key', null, '', _t('支付宝(APP ID)'));
            $oauth_alipay_secret = new Typecho_Widget_Helper_Form_Element_Textarea('oauth_alipay_app_secret', null, '', _t('支付宝(APP Secret)'), '去https://open.alipay.com创建应用，并设置回调地址为https://你的域名/api/oauth/alipay' );
            $oauth_alipay_callback = new Typecho_Widget_Helper_Form_Element_Text('oauth_alipay_callback', null, Typecho_Common::url('api/oauth/alipay', $siteUrl), _t('支付宝(回调地址)'), '默认填写'.Typecho_Common::url('api/oauth/alipay', $siteUrl));
        }

        // 文件服务器上传接口
        $form->addItem(self::layout('配置静态文件系统', 'h3'));
        $form->addInput($enable->multiMode());
        $form->addItem($uploadDirDiv);
        $form->addItem($gravatarPrefixDiv);
        $form->addItem($multiSizesImageDiv);
        $form->addInput($uploadServerHost);
        $form->addItem($uploadServerDiv);
        $form->addInput($https);
        $form->addItem(self::layout('配置API接口', 'h3'));
        $form->addInput($api);
        $form->addItem($oauth_title);
        $form->addInput($oauth_qq_key);
        $form->addInput($oauth_qq_secret);
        $form->addInput($oauth_qq_callback);
        $form->addInput($oauth_weibo_key);
        $form->addInput($oauth_weibo_secret);
        $form->addInput($oauth_weibo_callback);
        $form->addInput($oauth_osc_key);
        $form->addInput($oauth_osc_secret);
        $form->addInput($oauth_osc_callback);
        $form->addInput($oauth_github_key);
        $form->addInput($oauth_github_secret);
        $form->addInput($oauth_github_callback);
        $form->addInput($oauth_alipay_key);
        $form->addInput($oauth_alipay_secret);
        $form->addInput($oauth_alipay_callback);
        $form->addItem(new Typecho_Widget_Helper_Layout('input', array('type'=>'hidden','name'=>'optionStep')));
        $form->addItem(new Typecho_Widget_Helper_Layout('input', array('type'=>'hidden','name'=>'optionMsg')));
    }
    
    /**
     * 个人用户的配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form){}

    /**
     * 插件初始化
     * @author NatLiu
     * @date   2017-12-15T09:37:01+0800
     * @return void
     */
    private static function __initPlugin($entrance = null){
        // 载入函数库
        require_once 'functions.php';
        $config = self::getConfig();
        $options = self::getOptions();
        Typecho_Response::getInstance()->setHeader('X-Powered-By', 'codeup.me');
        // 上传目录
        if (!empty($options->uploadDir) && !defined('__TYPECHO_UPLOAD_DIR__')) {
            define('__TYPECHO_UPLOAD_DIR__', $options->uploadDir);
        }

        // 静态资源站目录
        if (in_array('uploadServer', $config->enable)
            && !empty($options->uploadServerRoot) && !defined('__TYPECHO_UPLOAD_ROOT_DIR__')
            && $config->uploadServerHost ==="local") {
            define('__TYPECHO_UPLOAD_ROOT_DIR__', $options->uploadServerRoot);
        }

        // 静态资源站URL
        if (in_array('uploadServer', $config->enable)
            && !empty($options->uploadServerUrl) && !defined('__TYPECHO_UPLOAD_URL__') && !in_array('cdn', $config->enable)) {
            define('__TYPECHO_UPLOAD_URL__', self::buildServerUrl($options->uploadServerUrl, $config->https));
        }

        // CDN
        if (in_array('cdn', $config->enable)
            && !empty($options->cdnUrl) && !defined('__TYPECHO_UPLOAD_URL__')) {
            define('__TYPECHO_UPLOAD_URL__', self::buildServerUrl($options->cdnUrl, $config->https));
        }

        // gravatar
        if (!empty($options->gravatarPrefix) && !defined('__TYPECHO_GRAVATAR_PREFIX__')) {
            define('__TYPECHO_GRAVATAR_PREFIX__', $options->gravatarPrefix);
        }
    }
    
    /**
     * 插件实现方法 | 前台初始化
     * 
     * @access public
     * @return void
     */
    public static function indexBegin()
    {
        // 执行插件初始化方法
        self::__initPlugin('index');
    }

    /**
     * 后台初始化
     * @author NatLiu
     * @date   2017-12-15T09:32:31+0800
     * @return void
     */
    public static function adminBegin()
    {
        // 执行插件初始化方法
        self::__initPlugin('admin');
    }

    /**
     * [adminMenu description]
     * @author NatLiu
     * @date   2017-12-15T17:30:40+0800
     * @return [type]                   [description]
     */
    public static function adminMenu()
    {
        echo '&nbsp;&nbsp;<span class="message success">'.self::NAME.'增强版</span>';
    }

    /**
     * 管理页面页脚
     * @author NatLiu
     * @date   2017-12-15T17:52:05+0800
     * @return [type]                   [description]
     */
    public static function adminEnd()
    {
        echo '<script type="text/javascript" src="'.self::buildServerUrl(Typecho_Common::url(self::NAME.'/js/layer.js', self::get('options')->pluginUrl), 2).'"></script>';
        echo '<script type="text/javascript" src="'.self::buildServerUrl(Typecho_Common::url(self::NAME.'/js/armx_admin.js', self::get('options')->pluginUrl), 2).'"></script>';
    }

    /**
     * 管理页面header
     * @author NatLiu
     * @date   2017-12-20T17:42:38+0800
     * @return [type]                   [description]
     */
    public static function adminHeader($header)
    {
        $header .= '<link rel="stylesheet" href="'.self::buildServerUrl(Typecho_Common::url(self::NAME.'/css/armx_admin.css', self::get('options')->pluginUrl), 2).'" />';
        return $header;
    }

    /**
     * 输出页面之前
     * @author NatLiu
     * @date   2017-12-19T12:28:50+0800
     * @param  [type]                   $obj [description]
     * @return [type]                        [description]
     */
    public static function beforeRender($obj)
    {

    }

    /**
     * 判断是否同步保存本地
     * @return [type] [description]
     */
    private static function localSave()
    {
        $config = self::getConfig();
        return $config->enable && in_array('uploadServer', $config->enable) && defined('__TYPECHO_UPLOAD_ROOT_DIR__') &&  __TYPECHO_UPLOAD_ROOT_DIR__!= __TYPECHO_ROOT_DIR__ && in_array('uploadTypechoRoot', $config->enable);
    }

    /**
     * 获取图片尺寸
     * @return [type] [description]
     */
    private static function multiSizes()
    {
        $config = self::getConfig();
        $options = self::getOptions();
        $request = self::get('request');
        if (!$config->enable || !in_array('multiSizesImage', $config->enable)) {
            return false;
        }

        $sizes = array(
                'thumbnail'=> array(
                        'crop' => in_array('thumbnailCrop', $config->enable),
                        'width' => (int) $options->thumbnailSizeWidth,
                        'height' => (int) $options->thumbnailSizeHeight
                    ),
                'medium' => array(
                        'width' => (int) $options->mediumSizeWidth,
                        'height' => (int) $options->mediumSizeHeight
                    ),
                'large'  => array(
                        'width' => (int) $options->largeSizeWidth,
                        'height' => (int) $options->largeSizeHeight
                    )
            );

        return $sizes;
    }

    /**
     * 获取实际文件绝对访问路径
     * @param  array  &$content [description]
     * @return [type]           [description]
     */
    public static function attachmentHandle(array &$content)
    {
        $options = self::get('options');
        $request = self::get('request');
        if ($content['attachment']->isImage) {
            $sizes = $content['attachment']->sizes;
                foreach ($sizes as $size => $image) {
                    $image['url'] = Typecho_Common::url($image['path'], defined('__TYPECHO_UPLOAD_URL__') ? __TYPECHO_UPLOAD_URL__ : $options->siteUrl);
                    $sizes[$size] = $image;
                }
            $content['attachment']->sizes = $sizes;
            if ($request->imagesize && $sizes[$request->imagesize]) {
                return $sizes[$request->imagesize]['url'];
            }
        }
        return Typecho_Common::url($content['attachment']->path, defined('__TYPECHO_UPLOAD_URL__') ? __TYPECHO_UPLOAD_URL__ : $options->siteUrl);
    }

    /**
     * 上传成功
     * @param  [type] $attachment [description]
     * @return [type]             [description]
     */
    public static function upload($upload)
    {

    }

    /**
     * 上传处理
     * @param  [type] $file [description]
     * @return [type]       [description]
     */
    public static function uploadHandle($file)
    {
        $file = call_user_func(self::call('Upload::uploadHandle'), $file, self::multiSizes(), self::localSave());
        return $file;
    }

    /**
     * 修改文件
     * @param  [type] $content [description]
     * @param  [type] $file    [description]
     * @return [type]          [description]
     */
    public static function modifyHandle($content, $file)
    {
        $file = call_user_func(self::call('Upload::modifyHandle'), $content, $file, self::multiSizes(), self::localSave());
        return $file;
    }

    /**
     * 删除图片
     * @param  [type] $path [description]
     * @return [type]       [description]
     */
    public static function deleteImages($path)
    {
        $ext = substr($path, strripos($path, '.'));
        $image = substr($path, 0, strripos($path, '.'));
        $sizes = self::multiSizes();
        foreach ($sizes as $sizeType => $size) {
            $_path = $image . '-' . $sizeType . $ext;
            @unlink(__TYPECHO_ROOT_DIR__ . '/' . $_path);
            @unlink(__TYPECHO_UPLOAD_ROOT_DIR__ . '/' . $_path);
        }
    }

    /**
     * 删除文件
     * @param  array  $content [description]
     * @return [type]          [description]
     */
    public static function deleteHandle(array $content)
    {
        if (Typecho_Common::isAppEngine()) {
            return false;
        }
        if ($content['attachment']->isImage) {
            self::deleteImages($content['attachment']->path);
            delete_field($content['cid'], self::THUMB_FIELD, self::THUMB_FIELD_TYPE); // 同时删除相关内容的缩略图
        }
        $delRoot = @unlink(__TYPECHO_ROOT_DIR__ . '/' . $content['attachment']->path);
        $delUpload = @unlink(__TYPECHO_UPLOAD_ROOT_DIR__ . '/' . $content['attachment']->path);

        return $delRoot || $delUpload;
    }

    /**
     * 设置只读字段
     * @author NatLiu
     * @date   2017-12-25T16:53:09+0800
     * @param  [type]                   $name [description]
     * @return boolean                        [description]
     */
    public static function isFieldReadOnly($name = null)
    {
        return !empty(self::$_readOnlyFields) && in_array($name, self::$_readOnlyFields);
    }

    /**
     * 设置默认扩展字段
     * @author NatLiu
     * @date   2017-12-26T09:14:13+0800
     * @param  [type]                   $layout [description]
     * @return [type]                           [description]
     */
    public static function getDefaultFieldItems( Typecho_Widget_Helper_Layout $layout)
    {
        $config = self::getConfig();
        $options = self::getOptions();
        if ($config->enable && in_array('thumbnail', $config->enable)) { // 如果启用缩略图，创建缩略图字段
            $thumbnail = new Typecho_Widget_Helper_Form_Element_Hidden(self::THUMB_FIELD, null, null, '');
            $layout->addItem($thumbnail);
        }
    }

    /**
     * 编辑文章内容
     * @author NatLiu
     * @date   2017-12-25T11:22:38+0800
     * @param  [type]                   $post [description]
     * @return [type]                         [description]
     */
    public static function writePostContent($post)
    {
        echo '编辑内容扩展';
    }

    /**
     * 编辑文章选项
     * @author NatLiu
     * @date   2017-12-25T11:24:54+0800
     * @param  [type]                   $post [description]
     * @return [type]                         [description]
     */
    public static function writePostOption($post)
    {
        
        if ($post && $post->fields->{self::THUMB_FIELD}) {
            $thumbnail_id = $post->fields->{self::THUMB_FIELD};
        }
        $cid = !empty($post) ? $post->cid : '';
?><section class="typecho-post-option">
    <label class="typecho-label"><?php _e('缩略图'); ?></label>
    <p id="set-post-thumbnail">
    <?php if($thumbnail_id && $cid): ?>
        <input type="hidden" name="attachment[]" value="<?php echo $thumbnail_id;?>" />
        <?php if ($thumbnail_src = get_thumbnail_src($cid)) :?>
        <img class="set-post-thumbnail" style="max-width:100%;" src="<?php echo $thumbnail_src;?>?_t=<?php echo time();?>" /><br /><i>点击图片修改</i><br />
        <a href="javascript:;" id="cancel-post-thumbnail">取消缩略图</a>
        <?php else:?>
        <span class="message warinning set-post-thumbnail">缩略图已删除，重新设置缩略图</span>
        <?php endif;?>
    <?php else: ?>
       <button class="btn btn-xs set-post-thumbnail" onclick="return false;">设置缩略图</button>
    <?php endif;?>
    </p>
</section>

<?php
    }

    /**
     * 文章编辑页面底部
     * @param  [type] $post [description]
     * @return [type]       [description]
     */
    public static function writePostBottom($post)
    {
        $options = self::get('options');
        $security = Typecho_Widget::widget('Widget_Security');
        $cid = !empty($post) ? $post->cid : '';
?>
<script type="text/javascript">
var layerframe;
$(function($){
    $thumbnail_field = $('#custom-field input[name="fields[<?php echo self::THUMB_FIELD;?>]"]');
    $thumbnail_field.parents('tr').hide();

    $("#set-post-thumbnail").on('click', '.set-post-thumbnail', function(event) {
        event.preventDefault();
        var thumbnail_id = '';
        var $input = $(this).siblings('input');
        if ($input.length) {
            thumbnail_id = '&thumbnail_id='+$input[0].value;
        }
        layerframe = layer.open({
            title:'设置缩略图',
            type:2,
            area:['800px', '480px'],
            content:'<?php echo Typecho_Common::url('extending.php?panel=ArmX/edit-thumbnail.php&imagesize=thumbnail&cid='.$cid, $options->adminUrl) ;?>'+thumbnail_id
        });
    }).on("click", '#cancel-post-thumbnail', function(event){
        event.preventDefault();
        $.ajax({
            url: '<?php echo Typecho_Common::url('extending.php?panel=ArmX/edit-thumbnail.php&action=delete&cid='.$cid, $options->adminUrl) ;?>',
            type:'post',
            dataType:"json",
            data: {
                thumbnail_id: $thumbnail_field.val(),
                cid: '<?php echo $cid;?>',
                action: 'delete'
            },
            success:function(result){
                if (result.error) {
                    layer.alert('取消失败，请重试');
                }else{
                    layer.msg('成功取消缩略图');
                    $("#set-post-thumbnail").html('<button class="btn btn-xs set-post-thumbnail" onclick="return false;">设置缩略图</button>');
                    $thumbnail_field.val('');
                }
            },
            error:function(){
                layer.alert('取消失败，请重试');
            }

        });
    });
});
function updateAttacmentNumber () {
    var btn = $('#tab-files-btn'),
        balloon = $('.balloon', btn),
        count = $('#file-list li .insert').length;

    if (count > 0) {
        if (!balloon.length) {
            btn.html($.trim(btn.html()) + ' ');
            balloon = $('<span class="balloon"></span>').appendTo(btn);
        }

        balloon.html(count);
    } else if (0 == count && balloon.length > 0) {
        balloon.remove();
    }
}

function thumbnailAttachment (cid, url, data) {
    var li = $('<li />').appendTo("#file-list");
    li.data('cid', cid)
        .data('url', url)
        .data('image', 1)
        .html('<input type="hidden" name="attachment[]" value="' + cid + '" />'
            + '<a class="insert" href="###" title="点击插入文件">'+data.title+'</a><div class="info">'
            + ' <a class="file" href="http://codeup.me/admin/media.php?cid=' 
            + cid + '" title="编辑"><i class="i-edit"></i></a>'
            + ' <a class="delete" href="###" title="删除"><i class="i-delete"></i></a></div>')
        .effect('highlight', 1000);
    attachInsertEvent(li);
    attachDeleteEvent(li);
    updateAttacmentNumber();
}

function attachInsertEvent (el) {
    $('.insert', el).click(function () {
        var t = $(this), p = t.parents('li');
        Typecho.insertFileToEditor(t.text(), p.data('url'), p.data('image'));
        return false;
    });
}

function attachDeleteEvent (el) {
    var file = $('a.insert', el).text();
    $('.delete', el).click(function () {
        if (confirm('确认要删除文件 %s 吗?'.replace('%s', file))) {
            var cid = $(this).parents('li').data('cid');
            $.post('<?php $security->index('/action/contents-attachment-edit'); ?>',
                {'do' : 'delete', 'cid' : cid},
                function () {
                    $(el).fadeOut(function () {
                        $(this).remove();
                        updateAttacmentNumber();
                    });
                });
        }

        return false;
    });
}

function setThumbnailSuccess(cid, src, data)
{
    $("#set-post-thumbnail").html('<input type="hidden" name="attachment[]" value="'+cid+'" />'
           + '<img class="set-post-thumbnail" style="max-width:100%;" src="'+src+'" /><br /><i>点击图片修改</i>'+'<br /><a href="javascript:;" id="cancel-post-thumbnail">取消缩略图</a>');

    $thumbnail_field.val(cid);
    var $li = $("#file-list").find('[data-cid="'+cid+'"]');
    if ($li.length) {
        $li.attr('data-url', src);
    }else{
        if (data) {
            src = data.url.replace(/-(thumbnail|medium|large)\.(jpg|jpeg|bmp|gif|png|tiff)/,'.$2');
        }else{
            data = {
                title:'缩略图'
            };
        }
        thumbnailAttachment(cid, src, data);
    }
    layer.close(layerframe);
}
</script>
<?php

    }

    /**
     * 过滤内容图片
     * @author NatLiu
     * @date   2018-01-02T10:40:18+0800
     * @param  [type]                   $post  [description]
     * @param  [type]                   $image [description]
     * @return [type]                          [description]
     */
    public static function contentImageSizes($image, $default = 'medium', $responsive = true)
    {
        $attrs = ['src="' . $image->url . '"', 'data-original="' . $image->url . '"'];
        if (!empty($image->sizes) && $responsive == true) {
           $srcset = [];
           $sizes = [];
           foreach ($image->sizes as $size => $img) {
                $srcset[] = $img['url'] . ' ' . $img['width'] . 'w';
                switch ($size) {
                    case 'medium':
                        $sizes[] = '(min-width: 241px)'. ' '. $img['width'] .'w';
                        break;
                }
           }
           $defaultSize = $image->sizes[$default] ? $image->sizes[$default] : $image->sizes['full'];
           $sizes[] = '' . $defaultSize['width'] . 'px';
           $attrs[] = 'srcset="' . implode(', ', $srcset) . '"';
           $attrs[] = 'sizes="' . implode(', ', $sizes) . '"';
           $attrs[] = 'width="'. $defaultSize['width'] . '" height="'.$defaultSize['height'].'"';
        }
        return implode(' ', $attrs);
    }

    /**
     * 内容过滤
     * @author NatLiu
     * @date   2017-12-29T16:06:53+0800
     * @param  [type]                   $content [description]
     * @param  [type]                   $post    [description]
     * @return [type]                            [description]
     */
    public static function contentEx($content, $post)
    {
        // 处理附件
        $attachments = get_attachments($post->cid);
        $options = Typecho_Widget::widget('Widget_Options');
        $responsive = !empty($options->switchEnable) && in_array('ShowResponsiveImage', $options->switchEnable);
        if ( $attachments->have() ) {
            while ($attachments->next()) {
                // 处理图片输出
                if (self::isImage($attachments->attachment->type)) {
                    $pattern = '/(<[img|IMG][^>]+)src=[\'"][^\'"]*' . preg_quote($attachments->attachment->path, "/") . '["\']([^>]*>)(\s*<br>)?/i';
                    $content = preg_replace_callback($pattern, function($matches) use($attachments, $responsive) {
                        if (preg_match('/class=[\'"]([^\'"]+)[\'"]/i', $matches[0], $className)) {
                            return $matches[1] . 'class="' . $className[1] . ' content-image" ' . self::contentImageSizes($attachments->attachment, 'medium', $responsive) . $matches[2];
                        }else{
                           return $matches[1] . 'class="content-image" ' . self::contentImageSizes($attachments->attachment, 'medium', $responsive) . $matches[2];
                        }
                    }, $content);
                }
            }
        }
        return $content;
    }

}