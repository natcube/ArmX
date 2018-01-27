<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html class="no-js">
<head>
    <script type="text/javascript">(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php $this->archiveTitle(array(/*
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')*/
        ), '', ' _ '); ?><?php $this->options->title(); ?></title>
    <link rel="dns-prefetch" href="//cdn.bootcss.com/">
    <?php $this->header('generator=&template=&pingback=&xmlrpc=&wlw=&rss1=&commentReply=&antiSpam='); ?>
    <link rel="shortcut icon" href="<?php $this->options->siteUrl(); ?>favicon.ico">
    <link rel="stylesheet" href="/usr/themes/armx/style.css">
    <!--[if lt IE 10]>
    <script src="/usr/themes/armx/js/compatible.min.js"></script>
    <![endif]-->
    <!--[if lt IE 9]>
    <script src="https://apps.bdimg.com/libs/html5shiv/r29/html5.min.js"></script>
    <script src="https://apps.bdimg.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div id="page">
<header id="header" class="header">
    <div class="container header-container clearfix">
        <a id="logo" class="header-logo" href="<?php $this->options->siteUrl(); ?>"<?php if(!empty($this->options->logoUrl)):?> style="background:url(<?php echo $this->options->logoUrl;?>) no-repeat 0 50%;"<?php endif;?>>
            <h1><?php $this->options->title(); ?></h1>
        </a>
        <a class="menu-switch" id="menu-switch"></a>
        <ul class="nav" id="nav">
        <li><a<?php if($this->is('index')){ ?> class="current"<?php } ?> href="<?php $this->options->siteUrl(); ?>"><?php _e('首页'); ?></a></li>
        <?php $categories = $this->widget('Widget_Metas_Category_List')->to($category); while($category->next()): ?>
        <?php if($category->parent=='0'):?>
        <li><a<?php if($this->is('category', $category->slug) || ($category->slug === $this->category && $this->is('single'))):?> class="current"<?php endif;?> href="<?php $category->permalink();?>"><?php $category->name();?></a></li>
        <?php endif; endwhile;?>
        </ul>

        <div class="toolbar">
            <div class="search-bar">
                <div class="search-input" id="search-input"><form method="post" action="" id="search"><input autocomplete="off" name="s" type="text" required="required" placeholder="请输入关键词" id="s" value="<?php echo $this->request->filter('url', 'search')->keywords; ?>" /></form></div>
                <a href="javascript:;" class="search-btn" id="search-btn"></a>
            </div>
            <a href="javascript:;" class="user-notice"><span></span></a>
            <?php if(!empty($this->options->switchEnable) && in_array('ShowLoginRegister', $this->options->switchEnable)){the_user($this->user, $this->options, $this->request); } ?>
        </div>
    </div>
</header><!-- end #header -->
<div id="body" class="body">
    <div class="container">
        <div class="row">
