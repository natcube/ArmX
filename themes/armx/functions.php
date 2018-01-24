<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/**
 * 主题设置
 * @author NatLiu
 * @date   2018-01-24T14:10:44+0800
 * @param  [type]                   $form [description]
 * @return [type]                         [description]
 */
function themeConfig($form) {
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点 LOGO 地址'), _t('在这里填入一个图片 URL 地址, 用于网站头部 LOGO, 尺寸112x55  （注：也可修改主题img/bg.png文件修改logo）'));
    $form->addInput($logoUrl);

    $switchEnable = new Typecho_Widget_Helper_Form_Element_Checkbox('switchEnable', 
    array(
        'ShowMusicPlayer' => _t('显示音乐播放器'),
        'ShowResponsiveImage' => _t('文章内容响应式图片'),
        'ShowLoginRegister' => _t('显示登录注册模块'),
        'enablePjax' => _t('启用全站Pjax')
    ),
    array('ShowMusicPlayer','ShowResponsiveImage','ShowLoginRegister'), _t('主题功能开关'));
    
    $form->addInput($switchEnable->multiMode());
}

/**
 * 文章缩略
 * @author NatLiu
 * @date   2018-01-24T14:00:22+0800
 * @param  [type]                   $post    [description]
 * @param  string                   $default [description]
 * @return [type]                            [description]
 */
function the_post_thumbnail($post, $default = '')
{
    echo get_post_thumbnail($post, $default);
}

/**
 * 获取文章缩略图
 * @author NatLiu
 * @date   2018-01-24T14:00:30+0800
 * @param  [type]                   $post    [description]
 * @param  string                   $default [description]
 * @return [type]                            [description]
 */
function get_post_thumbnail($post, $default = '')
{
    $thumb = get_thumbnail_src($post->cid);
    $default = empty($default) ? '/usr/themes/armx/img/thumb.jpg' : $default;
    if(empty($thumb) && preg_match('/src=["\']([^"\']+)["\']/', $post->content, $matches)){
        $thumb = $matches[1];
    }
    return empty($thumb) ? $default : $thumb;
}

/**
 * 留空
 * @author NatLiu
 * @date   2018-01-24T14:00:43+0800
 * @param  string                   $message   [description]
 * @param  string                   $className [description]
 * @return [type]                              [description]
 */
function empty_message( $message = '', $className = '' )
{
    $class = 'empty-placeholder';
    if(!empty($className)){
        $class .= ' '.$className;
    }
    echo '<div class="'.$class.'"><div class="placeholder-bg"></div><div class="placeholder-content">'.$message.'</div></div>';
}


/**
 * 评论输出
 * @author NatLiu
 * @date   2018-01-24T14:00:59+0800
 * @param  [type]                   $that                 [description]
 * @param  [type]                   $singleCommentOptions [description]
 * @return [type]                                         [description]
 */
function threadedComments($that, $singleCommentOptions)
{
    $commentClass = '';
        if ($that->authorId) {
            if ($that->authorId == $that->ownerId) {
                $commentClass .= ' comment-by-author';
            } else {
                $commentClass .= ' comment-by-user';
            }
        }
?>
<li itemscope itemtype="http://schema.org/UserComments" id="<?php $that->theId(); ?>" class="comment-item<?php
    if ($that->levels > 0) {
        echo ' comment-child';
        $that->levelsAlt(' comment-level-odd', ' comment-level-even');
    } else {
        echo ' comment-parent';
    }
    $that->alt(' comment-odd', ' comment-even');
    echo $commentClass;
?>">
    <div class="comment-author" itemprop="creator" itemscope itemtype="http://schema.org/Person">
       <?php $that->gravatar($singleCommentOptions->avatarSize, $singleCommentOptions->defaultAvatar); ?>
    </div>
<div class="comment-body">
    <div class="comment-meta">
        <strong class="author-name"><?php echo $that->author;?></strong>
        <p><a class="comment-date" href="<?php $that->permalink(); ?>"><time itemprop="commentTime" datetime="<?php $that->date('Y-m-d H:i:s'); ?>"><?php $singleCommentOptions->beforeDate();
        $that->dateWord();
        $singleCommentOptions->afterDate(); ?></time></a>
        <?php if ('waiting' == $that->status) { ?>
        <em class="comment-awaiting-moderation"><?php $singleCommentOptions->commentStatus(); ?></em>
        <?php } ?>
        </p>
    </div>
    <div class="comment-content" itemprop="commentText">
    <?php $that->content(); ?>
    </div>
    <div class="comment-reply" id="comment-reply-<?php echo $that->coid;?>">
        <a data-commentid="<?php echo $that->coid;?>" data-respondid="<?php echo $that->parameter->respondId;?>" onclick="return TypechoComment.reply('<?php echo
                    $that->theId; ?>', '<?php echo $that->coid;?>');">回复</a>
    </div>
</div>
<div class="clearfix" id="comment-clear-<?php echo $that->coid;?>"></div>
    <?php if ($that->children) { ?>
    <div class="comment-children" itemprop="discusses">
        <?php $that->threadedComments(); ?>
    </div>
    <?php } ?>
</li>
<?php
}

/**
 * 获取第三方登录态
 * @author NatLiu
 * @date   2018-01-24T14:01:06+0800
 * @return [type]                   [description]
 */
function getAuth()
{
    if (empty(Typecho_Cookie::get('__typecho_oauth_openid'))) {
        return false;
    }
    return array(
            'openid' => Typecho_Cookie::get('__typecho_oauth_openid'),
            'nickname' => Typecho_Cookie::get('__typecho_oauth_nickname'),
            'avatar' => Typecho_Cookie::get('__typecho_oauth_avatar')
        );
}

/**
 * 显示登录人员
 * @author NatLiu
 * @date   2018-01-24T14:01:19+0800
 * @param  [type]                   $user    [description]
 * @param  [type]                   $options [description]
 * @param  [type]                   $request [description]
 * @return [type]                            [description]
 */
function the_user($user, $options, $request)
{
    $avatar = Typecho_Common::gravatarUrl($user->mail, 36, 'X', 'mm', $request->isSecure());
    $auth = getAuth();
    $profile = $options->profileUrl;
    if ($auth) {
        $avatar = preg_replace('/^http(s)?:\/\//', 'https://', $auth['avatar']);
    }
?>
    <div class="user-tools" id="user-tools">
        <img src="<?php echo $avatar;?>" />
    <div class="user-menu" id="user-menu">
        <?php if($auth):?>
        <a class="user-item" data-action="dialog.register_bind" href="javascript:;">绑定账号</a>
        <a class="user-item" data-action="oauth.logout">退出登录</a>
        <?php elseif( $user->hasLogin() ):?>
        <a class="user-item" data-no-instant target="_blank" href="<?php echo $profile;?>">个人中心</a>
        <a class="user-item" data-action="logout">退出登录</a>
        <?php else:?>
        <a class="user-item" data-action="dialog.login">登录</a>
        <?php if($options->allowRegister):?>
        <a class="user-item" data-action="dialog.register">注册</a>
        <?php endif;?>
        <?php endif;?>
    </div>
    </div>
<?php
}

/**
 * 获取文章分类
 * @author NatLiu
 * @date   2018-01-24T14:01:28+0800
 * @param  [type]                   $post [description]
 * @return [type]                         [description]
 */
function the_post_cat($post){
    $category = $post->categories[0];
    ?>
    <a class="post-cat" href="<?php echo $category['permalink'];?>"><span><?php echo $category['name'];?></span></a>

<?php
}

/**
 * 搜索关键词高亮
 * @author NatLiu
 * @date   2018-01-24T14:01:58+0800
 * @param  string                   $keyword [description]
 * @param  string                   $text    [description]
 * @return [type]                            [description]
 */
function highlightSearch($keyword = '', $text = '')
{
    if ($keyword==='') {
        return $text;
    }
    $text = preg_replace_callback('/'.preg_quote($keyword).'/i', function ($matches)
    {
       return "<strong class=\"search-keyword\">$matches[0]</strong>";
    }, $text);
    return $text;
}