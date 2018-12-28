<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php
    $options = Typecho_Widget::widget('Widget_Options');
    define("THEME_URL", rtrim(preg_replace('/^'.preg_quote($options->siteUrl, '/').'/', $options->rootUrl.'/', $options->themeUrl, 1),'/'));
?>
<!DOCTYPE HTML>
<html class="no-js" lang="zh-cmn-Hans">
<head>
<meta charset="<?php $this->options->charset(); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<meta name="renderer" content="webkit">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="applicable-device" content="pc,mobile">
<meta name="MobileOptimized" content="width">
<meta name="HandheldFriendly" content="true">
<meta content="always" name="referrer">
<meta name="format-detection" content="telephone=no">
<?php if($this->options->ChromeThemeColor): ?>
<meta name="theme-color" content="<?php $this->options->ChromeThemeColor() ?>" />
<?php endif; ?>
<title><?php $this->archiveTitle(array('category'  =>  _t('分类 %s 下的文章'),'search' =>  _t('包含关键字 %s 的文章'), 'tag' =>  _t('标签 %s 下的文章'),'author' =>  _t('%s 发布的文章')), '', ' - '); ?><?php $this->options->title(); ?><?php if($this->_currentPage>1) echo ' - 第 '.$this->_currentPage.' 页'; ?><?php if($this->options->headerdesc){ echo ' - '.$this->options->headerdesc; }?></title>
<meta http-equiv="x-dns-prefetch-control" content="on" />
<link rel="dns-prefetch" href="//apps.bdimg.com" />
<link rel="dns-prefetch" href="//cdn.staticfile.org" />
<link rel="dns-prefetch" href="//tc-gz-1252597704.cosgz.myqcloud.com" />
<?php $this->header('generator=&template=&xmlrpc=&wlw=&rss1=&commentReply=&antiSpam='); ?>
<link rel="shortcut icon" href="<?php if($this->options->faviconimg){echo fullurl($this->options->faviconimg,0); }else{ echo $this->options->rootUrl().'/favicon.ico';} ?>">
<link rel="Bookmark" href="<?php if($this->options->faviconimg){echo fullurl($this->options->faviconimg,0); }else{ echo $this->options->rootUrl().'/favicon.ico';} ?>">
<link rel="stylesheet" href="<?= THEME_URL ?>/css/style.css">
<link rel="stylesheet" href="<?= THEME_URL ?>/css/font/fonts.css">
<link href="<?= THEME_URL ?>/css/font-awesome.css" rel="stylesheet" media="none" onload="if(media!='all')media='all'" />
<link rel="stylesheet" href="<?= THEME_URL ?>/css/jquery.fancybox.min.css" />
<link rel="alternate"  href="<?php if (!($this->is('index'))) : ?><?php $this->options->rootUrl(); ?>/<?php echo substr($_SERVER['REQUEST_URI'],1,strlen($_SERVER['REQUEST_URI']));?><?php else: ?><?php $this->options->rootUrl(); ?>/<?php endif; ?>" hreflang="zh-Hans" />
<link rel="canonical"  href="<?php if (!($this->is('index'))) : ?><?php $this->options->siteUrl(); ?><?php echo substr($_SERVER['REQUEST_URI'],1,strlen($_SERVER['REQUEST_URI']));?><?php else: ?><?php $this->options->siteUrl(); ?><?php endif; ?>" />
<?php if($this->options->appleimg): ?>
<link rel="apple-touch-icon" href="<?php echo fullurl($this->options->appleimg,0);?>">
<?php if($this->options->applemode): ?>
<link rel="apple-touch-icon" sizes="57x57" href="<?php echo fullurl(getFN($this->options->appleimg,3).getFN($this->options->appleimg,1).'-57x57.'.getFN($this->options->appleimg,2),0);?>">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo fullurl(getFN($this->options->appleimg,3).getFN($this->options->appleimg,1).'-72x72.'.getFN($this->options->appleimg,2),0);?>">
<link rel="apple-touch-icon" sizes="76x76" href="<?php echo fullurl(getFN($this->options->appleimg,3).getFN($this->options->appleimg,1).'-76x76.'.getFN($this->options->appleimg,2),0);?>">
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo fullurl(getFN($this->options->appleimg,3).getFN($this->options->appleimg,1).'-114x114.'.getFN($this->options->appleimg,2),0);?>">
<link rel="apple-touch-icon" sizes="120x120" href="<?php echo fullurl(getFN($this->options->appleimg,3).getFN($this->options->appleimg,1).'-120x120.'.getFN($this->options->appleimg,2),0);?>">
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo fullurl(getFN($this->options->appleimg,3).getFN($this->options->appleimg,1).'-144x144.'.getFN($this->options->appleimg,2),0);?>">
<link rel="apple-touch-icon" sizes="152x152" href="<?php echo fullurl(getFN($this->options->appleimg,3).getFN($this->options->appleimg,1).'-152x152.'.getFN($this->options->appleimg,2),0);?>">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo fullurl(getFN($this->options->appleimg,3).getFN($this->options->appleimg,1).'-180x180.'.getFN($this->options->appleimg,2),0);?>">
<?php endif;?>
<?php endif;?>
<!--[if lt IE 10]>
<script src="<?= THEME_URL ?>/js/compatible.min.js"></script>
<![endif]-->
<!--[if lt IE 9]>
<script src="//apps.bdimg.com/libs/html5shiv/r29/html5.min.js"></script>
<script src="//apps.bdimg.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<?php if (!empty( Helper::options()->seoenable )):?>
<?php if (in_array('enableSearch',Helper::options()->seoenable) && ($this->is('index')||$this->is('page'))):?>
<script type="application/ld+json">
{
"@context":"http://schema.org",
"@type":"WebSite",
"@id":"#website",
"url":"<?php echo $options->siteUrl; ?>",
"name":"<?php $this->options->title(); ?>",
"alternateName":"<?php $this->options->title(); ?> - <?php echo $this->options->headerdesc; ?>",
"potentialAction": {
	"@type": "SearchAction",
	"target": "<?php echo $options->rootUrl;?>/search/{search_term_string}",
	"query-input": "required name=search_term_string"
}
}
</script>
<?php endif;?>
<?php if (in_array('enableGlobalS',Helper::options()->seoenable)):?>
<meta property="og:locale" content="zh_CN" />
<meta property="og:type" content="article" />
<meta property="og:title" content="<?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?><?php if ($this->is('index')) : ?> <?php $this->options->titleintro() ?><?php endif; ?>" />
<meta property="og:url" content="<?php if (!($this->is('index'))) : ?><?php $this->options->siteUrl(); ?><?php echo substr($_SERVER['REQUEST_URI'],1,strlen($_SERVER['REQUEST_URI']));?><?php else: ?><?php $this->options->siteUrl(); ?><?php endif; ?>" />
<meta property="og:site_name" content="<?php $this->options->title(); ?>" />
<meta property="article:publisher" content="<?php echo $this->options->username; ?>" />
<?php endif;?>
<?php if (in_array('enableShare',Helper::options()->seoenable)):?>
<meta itemprop="name" content="<?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?><?php if ($this->is('index')) : ?> - <?php echo $this->options->headerdesc; ?><?php endif; ?>" />
<meta itemprop="image" content="<?php echo fullurl($this->options->appleimg,0);?>" />
<?php endif;?>
<?php endif;?>
<?php if(!empty($this->options->analysis)){
       if($this->options->analysistype){
        echo '<script async src="//www.googletagmanager.com/gtag/js?id='.$this->options->analysis.'"></script><script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag(\'js\', new Date());gtag(\'config\', \''.$this->options->analysis.'\');</script>';
      }else{
        echo $this->options->analysis;
      }}
?>
<?php if($this->options->googleadscript && !empty($this->options->showad) && in_array('ShowGoogleAD', $this->options->showad)){echo $this->options->googleadscript;} ?>
<?php if (!empty( Helper::options()->switchEnable ) && in_array('enableGray',Helper::options()->switchEnable)) :?>
<style>html{overflow-y:scroll;filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=1);-webkit-filter: grayscale(100%);}</style>
<?php endif;?>
<?php if(isiOS()):?>
<style>body{cursor:pointer;}</style>
<?php endif;?>
<?php if($this->options->colortype) :?>
<style>.nav li a.current,a:hover,.dropdown:hover li a, .search-btn:hover i,.recent a:hover, .recent a:hover>.recent-title>.likepost, .indexlink a:hover, .indexlink a:hover>.indexsitename>.likepost, .recent a:hover>.recent-title>.likepost-c,.post-title a:hover,.post-meta a:hover,.article-meta a:hover, .meta-item a:hover,.article-content a:hover,.post-like:hover,.be:hover,.tag-list a:hover,.page-navigator li.next a:hover, .page-navigator li.prev a:hover, .post-near .post-near-label:hover, .btn:hover,.response-form .submit,.article-index-list li a.active,.article-index-list li a:hover,#sum-category:hover,.article-content a:hover:before, .article-content a:hover:after,.article-title a,.form-loginfo a,.linkspage a:hover .sitename,.article-content a:hover:before, .article-content a:hover:after,.darkindexback .be:hover, .darkindexback .tag-list a:hover, .darkindexback .warning a:hover,.darkindexback .article-content a:hover,.darkindexback .article-content a:hover:after, .darkindexback .article-content a:hover:before, #tabali:hover{color:#<?php echo $this->options->colortype; ?>!important}.nav li a.current,#scroll li a:hover,.page-navigator li.next a:hover, .page-navigator li.prev a:hover, .post-near .post-near-label:hover, .btn:hover,.response-form .submit:hover,.tag-list a:hover,.nav li a:hover,.widget-tags-list a:hover,.like:hover,.article-index-slide,.links ul li:hover,.page-navigator li a:hover,.tl-wrap:hover:before,.darkindexback .like:hover,.darkpage .page-navigator .next a, .darkpage .page-navigator .prev a, .darkpage #scroll li a:hover,.darkpage .page-navigator a:hover,.darkindexback #social-shang .like:hover{border-color:#<?php echo $this->options->colortype; ?>!important}.box-label .label-left,#scroll li a:hover,.like:hover, .like:hover a,.submit:hover,.widget-tags-list a:hover,.page-navigator li.next a:hover, .page-navigator li.prev a:hover, .post-near .post-near-label:hover, .btn:hover,.comment-reply a, .cancel-comment-reply a,.page-navigator li a:hover,#nprogress .bar,.darkpage #comments .prev a, .darkpage #comments .next a,.darkpage .page-navigator .next a, .darkpage .page-navigator .prev a, .darkpage #scroll li a:hover,.darkindexback .like:hover,.darkpage .page-navigator a:hover,.darkpage .post-near a:hover,.darkindexback #social-shang .like:hover{background-color:#<?php echo $this->options->colortype; ?>!important}.dropdown:hover li a:after,#nprogress .spinner-icon{border-top-color:#<?php echo $this->options->colortype; ?>!important}.wz-tabs .wz-title li.active a,.darkindexback .article-content a:hover{border-bottom-color:#<?php echo $this->options->colortype; ?>!important}#nprogress .spinner-icon{border-left-color:#<?php echo $this->options->colortype; ?>!important;}.widget-tags-list a:hover,#scroll li a:hover,.comment-reply a:hover,.submit:hover,.page-navigator li.next a:hover, .page-navigator li.prev a:hover, .post-near .post-near-label:hover,.btn:hover,.page-navigator li a:hover,.darkindexback .like:hover>a{color:#fff!important;}.page-navigator li.current a{background: #bfbfbf!important;}.footer a:hover{color: #cecece!important;}</style>
<?php endif;?> 
</head>
<body ontouchstart="">
<div id="disablejs">本站使用了 Pjax 等基于 JavaScript 的开发技术，但您的浏览器已禁用 JavaScript，请开启 JavaScript 以保证网站正常显示！</div>
<script>document.getElementById("disablejs").style.display='none';</script>
<div id="page">
<script>document.getElementById("page").style.display='block';</script>
<header id="header" class="header">
    <div class="container header-container clearfix">
        <a id="logo" class="header-logo" title="<?php $this->options->title(); ?><?php if($this->options->headerdesc){ echo ' - '.$this->options->headerdesc; }?>" href="<?php $this->options->rootUrl(); ?>">
<?php if(!empty($this->options->logoUrl)):?> 
  <img alt="header-logo" src="<?php echo fullurl($this->options->logoUrl,0);?>" srcset="
<?php 
  echo fullurl(getFN($this->options->logoUrl,3).getFN($this->options->logoUrl,1).'@2x.'.getFN($this->options->logoUrl,2),0);
?> 2x"/>
<?php else:?>
  <p class="header-title"><?php $this->options->title(); ?></p>
<?php endif;?>
        </a>
        <a class="menu-switch" id="menu-switch"><i class="fa fa-ellipsis-v headermenu"></i></a>
       <ul class="nav" id="nav">
        <li><a<?php if($this->is('index')){ ?> class="current"<?php } ?> href="<?php $this->options->rootUrl(); ?>"><?php _e('首页'); ?></a></li>
        <?php echo formaturl($this->options->headersite,$this->options->rootUrl); ?>     
        <li class="nav-search"><a href="<?php $this->options->rootUrl(); ?>/search.html">搜索</a></li>
       </ul>

        <div class="toolbar">

        <div class="dropdown" id="dropdown">
          <li><a class="dropbtn">发现</a></li>
          <div class="dropdown-content">
               <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
               <?php while($pages->next()): ?>
                  <a href="<?php $pages->permalink(); ?>"><?php $pages->title(); ?></a>
               <?php endwhile; ?>
            <?php echo formaturl($this->options->headerdropsite,$this->options->rootUrl); ?> 
         </div>
       </div>
            <div class="search-bar" id="search-bar">
              <div class="search-input" id="search-input"><form method="post" action="" id="search"><input autocomplete="off" name="s" type="text" required="required" placeholder="" id="s" value="<?php echo $this->request->filter('url', 'search')->keywords; ?>" /></form></div>
                <a href="<?php $this->options->rootUrl(); ?>/search.html" class="search-btn"><i class="fa fa-search"></i></a>
            </div>
            <?php if(!empty($this->options->switchEnable) && in_array('ShowLoginRegister', $this->options->switchEnable)){the_user($this->user, $this->options, $this->request); } ?>
            <?php if($this->options->nightmode):?><span class="night-mode" id="night-mode" title="夜间模式" onclick="tmode()"><i class="fa fa-lightbulb-o"></i></span><?php endif;?>
      </div>
    </div>
</header>
<!-- end #header -->
<div id="body" class="body">
    <div class="container">
        <div class="row">
