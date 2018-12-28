<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php 

// 获取音频地址
if ($this->request->isAjax() && $this->request->is('do=getSpeech')) {
    $this->response->throwJson([
        'data' => text2speech($this)
    ]);
}

$this->need('header.php'); 

?>

<div id="main" class="main">
    <article class="article">
    <div class="article-box card">
        <h1 class="article-title" ><?php $this->title() ?> 
           <?php if($this->user->hasLogin()):?>
             <a class="superscript" href="<?php Helper::options()->adminUrl()?>write-post.php?cid=<?=$this->cid ?>" target="_blank"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
           <?php endif?>
        </h1>
        <div class="article-meta">
            <span class="meta-item" title="本文作者"><i class="fa fa-user-o text-muted"></i><a class="meta-author" href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author(); ?></a></span>
            <span class="meta-item" title="发表日期"><i class="fa fa-clock-o text-muted"></i><?php $this->date('Y/m/d'); ?></span>
            <span class="meta-item" title="文章分类"><i class="fa fa-folder-open-o text-muted"></i><?php $this->category('，'); ?></span>
            <span class="meta-item" title="评论次数"><i class="fa fa-comments-o text-muted"></i>评论(<a href="#comments"><?php $this->commentsNum('0', '1', '%d'); ?></a>)</span>
            <span class="meta-item" title="浏览次数"><i class="fa fa-eye text-muted"></i>浏览(<?php get_post_view($this) ?>)</span>
<?php if(isset($this->options->plugins['activated']['Like'])): ?>
            <span class="meta-item" title="点赞次数"><i class="fa fa-thumbs-up text-muted"></i>点赞(<a href="#shang-like"><?php Like_Plugin::theLike($link = false); ?></a>)</span>
<? endif; ?>
<?php if (!empty( Helper::options()->switch ) && in_array('CountPost',Helper::options()->switch)) :?>
            <span class="meta-item" title="文章字数"><i class="fa fa-keyboard-o text-muted"></i>字数(<?php echo art_count($this->cid); ?>)</span>
<? endif; ?>
        </div>
        <?php if ($this->options->text2speech && isset($_SERVER['HTTP_USER_AGENT'])):?>
        <?php if (!strpos(getBR($_SERVER['HTTP_USER_AGENT'],0),'Internet Explorer') && !strpos(getBR($_SERVER['HTTP_USER_AGENT'],0),'Firefox')): ?>
           <?php if(strtolower($this->fields->read) !=('n'||'no') && readable($this)): ?>
            <div id="post-text2speech" class="post__text2speech" title="用声音感受世界">
                <i class="icon"></i>
                <?php if(!$this->password || $this->password == Typecho_Cookie::get('protectPassword') || $this->authorId == $this->user->uid):?>
                  <span id="post-text2speech-text" class="text">小助手读文章</span>
                <?php else:?>
                  <span id="post-text2speech-text" class="text"><a href="#article-content" id="needpwd">请先验证密码</a></span>
                <?php endif; ?> 
                <span id="post-text2speech-time" class="time">00:00 / 00:00</span>
                <span id="post-text2speech-progress" class="progress"></span>
            </div>
           <?php endif; ?>
        <?php endif; ?>
        <?php endif; ?>
        <div class="article-content" id="article-content">
<?php if (!empty( Helper::options()->switch ) && in_array('Commentfirst',Helper::options()->switch)){
		$db = Typecho_Db::get();
		$sql = $db->select()->from('table.comments')
			->where('cid = ?',$this->cid)
			->where('mail = ?', $this->remember('mail',true))
			->limit(1);
		$result = $db->fetchAll($sql);
		if($this->user->hasLogin() || $result) {
			echo parseContent($this,1);
		} else {
			echo parseContent($this,0);
		}
} else {
		echo parseContent($this,1);
}
?>
		<hr>
        </div>

<?php if($this->options->isdonate == '1'): ?>
<div class="shang-like" id="shang-like">
    <div id="social">
       <div class="social-main" id="social-main">
           <span class="like">
              <?php $all = Typecho_Plugin::export();?>
              <?php if(array_key_exists('Like', $all['activated'])): ?>
                 <?php Like_Plugin::theLike(); ?>
              <?php else:?>
                 <span style="color:red;font-size:10px;"><a href="https://vircloud.net/default/change-theme.html#article-header-56" target="_blank">插件禁用</a></span>
              <?php endif; ?>
           </span>
           <span class="social-notice">您的赞赏是对我最大的鼓励！</span>
        </div>
<?php if(!empty($this->options->donate_img)): ?>
        <div class="fancybox-slide--current social-main" id="social-shang" style="display: none;">
          <span class="like">
            <a data-fancybox data-animation-duration="700" data-src="#animatedModal" href="javascript:;" class="post-like" id="index-shang">赏</a>
          </span>
            <span class="social-notice">您的赞赏是对我最大的鼓励！</span>
        </div>
<?php endif; ?>
    </div>
</div>
<?php endif; ?>

    </div>

<?php if(!empty($this->options->showad) && in_array('ShowPost', $this->options->showad)): ?>
<div class="article-extend card postadv">
  <p class="tag-title postad">
   <a href="<?php echo fullurl($this->options->postad,0); ?>" target="_blank" title="<?php echo $this->options->psotalt ;?>">
    <?php if($this->options->lazyimg == '1'): ?>
     <img src="<?php echo __LAZYIMG3__; ?>" data-src="<?php echo fullurl($this->options->postadimg,0); ?>" class="postadimg lazyloading b-lazy" alt="<?php echo $this->options->psotalt ;?>">
    <?php else: ?>
     <img src="<?php echo fullurl($this->options->postadimg,0); ?>" class="postadimg" alt="Offer">
    <?php endif; ?>
   </a>
  </p>
  <p class="tag-title adnotice">
   <a href="mailto:coo@vircloud.net?subject=博客广告合作&body=" title="欢迎在本站推广，合作请点本链接与我联系" class="adcontact">推广</a>
  </p>
</div>
<?php endif;?>
      
        <div class="article-extend card">     
           <p class="tag-title share"><i class="fa fa-share-square-o"></i>&nbsp;分享给好友：
            <span class="extend-share">
             <a title="分享到空间" rel="nofollow" class="be be be-qzone" href="//sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?php $this->permalink() ?>&title=<?php $this->title() ?>&pics=<?php echo fullurl($this->options->appleimg,0); ?>&desc=这篇文章写的不错，推荐看看&summary=<?php $this->excerpt(65, '......'); ?>&site=<?php $this->options->rootUrl(); ?>" target="_blank" onclick="window.open(this.href, 'qzone-share', 'width=745,height=660');return false;"></a>
             <a title="分享到微博" rel="nofollow" class="be be-stsina" href="//service.weibo.com/share/share.php?url=<?php $this->permalink() ?>&pic=<?php echo fullurl($this->options->appleimg,0); ?>&title=<?php $this->title() ?>_<?php $this->options->title(); ?>" target="_blank" onclick="window.open(this.href, 'weibo-share', 'width=650,height=475');return false;"></a>
             <a title="分享到 QQ" rel="nofollow" class="be be-qq" href="//connect.qq.com/widget/shareqq/index.html?url=<?php $this->permalink() ?>&desc=这篇文章写的不错，推荐看看&pics=<?php echo fullurl($this->options->appleimg,0); ?>&title=<?php $this->title() ?>_<?php $this->options->title(); ?>&summary=<?php $this->excerpt(65, '......'); ?>" target="_blank" onclick="window.open(this.href, 'qq-share', 'width=745,height=660');return false;"></a>
             <a data-fancybox="" rel="nofollow" data-animation-duration="700" data-src="#animatedModal2" href="javascript:;" class="weixin" id="sharewx"><i class="be be-weixin"></i></a>
            </span>
          </p>
           <p class="tag-title continue"><i class="fa fa-forward"></i>&nbsp;继续浏览关于 
              <span class="tag-list">
                <?php if(!$this->password || $this->password == Typecho_Cookie::get('protectPassword') || $this->authorId == $this->user->uid):?>
                  <?php $this->tags('', true, ''); ?>
                <?php else:?>
                  <a href="#article-content">请先验证密码</a>
               <?php endif;?> 
             </span>
             的文章</p>
           <p class="tag-title update"><i class="fa fa-clock-o"></i>&nbsp;本文最后更新于：<span class="extend-date"><?php if( $this->modified > $this->created ){echo date('Y/m/d H:i:s', $this->modified);}else{ echo date('Y/m/d H:i:s', $this->created); } ?><span class="mianbaoxie">，可能因经年累月而与现状有所差异</span>。</span></p>
           <p class="tag-title warning"><i class="fa fa-copyright"></i>&nbsp;引用转载请注明：<span class="mianbaoxie"><a href="<?php $this->options->rootUrl(); ?>" class="yinyong"><?php $this->options->title(); ?></a> > <?php $this->category(','); ?> > </span><a href="<?php $this->permalink() ?>" class="yinyong"><?php $this->title() ?></a> </p>
          <div style="display: none;" id="animatedModal2" class="animated-modal">
           <h3 class="wxscan postqr">跨屏阅读</h3>
             <div class="wxscanimg">
              <p class="wxloading">
		<img src="<?php echo __LAZYIMG__; ?>" data-src="<?php postqrcode($this->options->siteUrl.substr($_SERVER['REQUEST_URI'],1,strlen($_SERVER['REQUEST_URI'])));?>" class="lazyloading b-lazy" id="wxscimg">
              </p>
             </div>
           <h3 class="thanks">微信扫一扫</h3>
          </div>
        </div>      
    </article>

    <ul class="post-near">
    <?php $this->thePrev('<li class="post-prev">%s</li>','',['title'=>'上一篇','tagClass'=>'post-near-label']); ?>
    <?php $this->theNext('<li class="post-next">%s</li>','',['title'=>'下一篇','tagClass'=>'post-near-label']); ?>
    </ul>

    <?php $this->need('comments.php'); ?>

<div id="template-post" class="template-post"></div>
<?php if(!empty($this->options->advanced) && in_array('AutoTitle', $this->options->advanced)): ?>
<div id="autotitle"></div>
<?php endif; ?>
</div><!-- end #main-->
<?php $this->need('key.php'); ?>
<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>
