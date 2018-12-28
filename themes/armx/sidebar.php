<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div class="sidebar" id="sidebar" role="sidebar">

<?php if(!empty($this->options->isme) && in_array('ShowMe', $this->options->isme)): ?>
  <?php if ($this->is('index')) : ?>
    <?php if(!empty($this->options->mobilemode) && in_array('Showisaboutme', $this->options->mobilemode)){echo '<div id="disableaboutme"></div>';} ?>
    <section class="widget" id="tabs-aboutme">
        <h3 class="box-label"><span class="label-left"></span><span class="box-name">关于博主</span></h3>
        <div class="widget-box about-card">
         <div class="widget-list clearfix about-card-list" id="about-card-list">
           <div class="widget-background b-lazy" 
<?php if($this->options->lazyimg == '1'): ?>
data-src="<?php echo fullurl($this->options->ismeaboutimg,0); ?>"
<?php else: ?>
style="background-image: url('<?php echo fullurl($this->options->ismeaboutimg,0); ?>');"
<?php endif;?>
></div>
           <div class="card widget-avatar"><a href="<?php $this->options->rootUrl();?>/about.html">
<?php if($this->options->lazyimg == '1'): ?>
   <?php echo '<img src="'.__LAZYIMG3__.'" data-src="'.fullurl($this->options->ismeimg,0).'"'; ?>
<?php else: ?>
   <?php echo '<img src="'.fullurl($this->options->ismeimg,0).'"'; ?>
<?php endif;?>
 class="b-lazy" alt="<?php echo $this->options->username; ?>" title="<?php echo $this->options->username; ?>，最近在线：<?php get_last_login(1); ?>，最后更新：<?php get_last_update(); ?>"/></a></div>
           <div class="card widget-blogname"></div>
           <div class="card widget-contact">
<?php if(!empty($this->options->ismeqq)){
  echo '<a href="'.fullurl($this->options->ismeqq,0).'" target="_blank"><i class="fa fa-qq"></i></a>';}?>         
<?php if(!empty($this->options->ismewechat)):?>
<a data-fancybox="" data-animation-duration="700" data-src="#animatedModal3" href="javascript:;" class="weixin" id="groupwx"><i class="fa fa-weixin"></i></a>
<?php endif; ?>
             
<?php if(!empty($this->options->ismetel)){
  echo '<a href="'.fullurl($this->options->ismetel,0).'" target="_blank"><i class="fa fa-telegram"></i></a>';}?>
<?php if(!empty($this->options->ismegithub)){
  echo '<a href="'.fullurl($this->options->ismegithub,0).'" target="_blank"><i class="fa fa-github"></i></a>';}?>
<?php if(!empty($this->options->ismeaemail)){
  echo '<a href="mailto:'.fullurl($this->options->ismeaemail,0).'" target="_blank"><i class="fa fa-envelope"></i></a>';}?>
<a href="<?php $this->options->feedUrl(); ?>" target="_blank"><i class="fa fa-rss-square"></i></a>
           </div>
           <div class="card widget-desc"><?php if($this->options->ismeabout){echo $this->options->ismeabout;}else{echo $this->options->description();} ?></div>
           <div class="card widget-sum stats-list">
            <ul class="clearfix">
             <li class="first"><a href="<?php $this->options->rootUrl();?>/cross.html"><strong><?php echo Typecho_Widget::widget('Widget_Stat')->publishedPostsNum; ?></strong><span>文章</span></a></li>
             <li id="sum-category"><strong><?php echo Typecho_Widget::widget('Widget_Stat')->categoriesNum; ?></strong><span>分类</span>
             <div class="dropdown-category"><?php $this->widget('Widget_Metas_Category_List')->parse('<a href="{permalink}"><span>{name}</span></a>'); ?></div><s class="dropdown-category-top"><i class="dropdown-category-top-b"></i></s>           
             </li>
             <li><a href="<?php $this->options->rootUrl();?>/guestbook.html"><strong><?php echo Typecho_Widget::widget('Widget_Stat')->publishedCommentsNum; ?></strong><span>留言</span></a></li>
             <li><strong><?php echo get_sum_tags();?></strong><span>标签</span></li>
            </ul>
           </div>

         </div>
        </div>
    </section>  
  <?php endif; ?>
<?php endif; ?>

<?php if($this->options->isabout == '1'): ?>
    <?php if ($this->is('single')): $this->related(6)->to($relatedPosts);?>
        <?php if($relatedPosts->have()): ?>
          <?php if(!empty($this->options->mobilemode) && in_array('Showisabout', $this->options->mobilemode)){echo '<div id="disableabout"></div>';} ?>
            <section class="widget" id="tabs-related">
                <h3 class="box-label"><span class="label-left"></span><span class="box-name">相关文章</span></h3>
                <div class="card widget-box">
                <ul class="widget-list">
                <?php $i = 0; while($relatedPosts->next()): ?>
                    <li class="recent recent-<?php echo $i;?> redash"><a href="<?php $relatedPosts->permalink();?>" title="<?php $relatedPosts->title();?>"><span class="recent-title"><i class="fa fa-fire likepost"></i><?php $relatedPosts->title();?></span></a></li>
                <?php $i++; endwhile; ?>
                </ul>
                </div>
            </section>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>

<?php if($this->options->istags == '1' && !$this->is('page','saying') && !$this->is('page','leaderboards') && !$this->is('page','cross') && !$this->is('page','link') && !$this->is('page','guestbook') && !$this->is('page','about') && !$this->is('post')): ?>
<?php $this->widget('Widget_Metas_Tag_Cloud', 'sort=count&ignoreZeroCount=1&desc=1&limit=30')->to($tags); ?>
<?php if($tags->have()): ?>
<?php if(!empty($this->options->mobilemode) && in_array('Showistags', $this->options->mobilemode)){echo '<div id="disabletags"></div>';} ?>
    <section class="widget" id="tabs-label">
        <h3 class="box-label"><span class="label-left"></span><span class="box-name">热门标签</span></h3>
        <div class="card widget-box <?php if($this->options->showtagtype){ echo "cardp";} ?>">
        <div class="widget-list widget-tags-list clearfix">
        <?php if($this->options->showtagtype):?>
          <div class="myCanvasContainer">
           <canvas id="myCanvas" width="244" height="244">
              <p>标签云</p>
              <?php while($tags->next()): ?>
               <a href="<?php $tags->permalink(); ?>" class="tag"><?php $tags->name(); ?></a>
              <?php endwhile; ?>
           </canvas>
           <p class="canvasdisable">屏幕分辨过低，无法显示</p>
          </div>
        <?php else:?>
          <div class="simpletaglist">           
          <?php while($tags->next()): ?>
            <a href="<?php $tags->permalink(); ?>" rel="tag" class="size-<?php $tags->split(5, 10, 20, 30); ?>" title="<?php $tags->count(); ?> 篇文章"><?php $tags->name(); ?></a>
          <?php endwhile; ?>
          </div>          
        <?php endif;?>
         
        <div style="clear:both; height:0; overflow:hidden; width:100%;"></div>
        </div>
        </div>
    </section>
<?php endif; ?>
<?php endif; ?>

<?php if(!empty($this->options->showad) && in_array('ShowAD', $this->options->showad)): ?>
<?php if(!empty($this->options->mobilemode) && in_array('Showads', $this->options->mobilemode)){echo '<div id="disableads"></div>';} ?>
    <section class="widget" id="tabs-recom">
        <h3 class="box-label"><span class="label-left"></span><span class="box-name">主机推荐</span></h3>
        <div class="card widget-box">
        <div class="widget-list clearfix">
       <ul class="list-group">
        <li class="list-group-item"> <a href="<?php echo fullurl($this->options->showad1link,0);?>" target="_blank" title="<?php echo $this->options->ad1alt ;?>">
<?php if($this->options->lazyimg == '1'): ?>
<img src="<?php echo __LAZYIMG3__; ?>" data-src="<?php echo fullurl($this->options->showad1,0);?>" class="recommend-1 lazyloading b-lazy" alt="<?php echo $this->options->ad1alt ;?>">
<?php else: ?>
<img src="<?php echo fullurl($this->options->showad1,0);?>" class="recommend-1" alt="<?php echo $this->options->ad1alt ;?>">
<?php endif; ?>
</a></li><hr>
        <li class="list-group-item"> <a href="<?php echo fullurl($this->options->showad2link,0);?>" target="_blank"  title="<?php echo $this->options->ad2alt ;?>">
<?php if($this->options->lazyimg == '1'): ?>
<img src="<?php echo __LAZYIMG3__; ?>" data-src="<?php echo fullurl($this->options->showad2,0);?>" class="recommend-2 lazyloading b-lazy" alt="<?php echo $this->options->ad2alt ;?>">
<?php else: ?>
<img src="<?php echo fullurl($this->options->showad2,0);?>" class="recommend-2" alt="<?php echo $this->options->ad2alt ;?>">
<?php endif; ?>
</a></li>
       </ul>
        </div>
        </div>
    </section>
<?php endif; ?>  

<?php if($this->options->isrecommend == '1'): ?>
  <?php if (!$this->is('post') && !$this->is('page','cross') && !$this->is('page','leaderboards')):$this->widget('Widget_Contents_Post_Recent')->to($recent); ?>
    <?php if(!empty($this->options->mobilemode) && in_array('Showisrecommend', $this->options->mobilemode)){echo '<div id="disablerecommend"></div>';} ?>
    <section id="tabs-recomp" class="widget">
    <h3 class="box-label"><span class="label-left"></span><span class="box-name">随机看看</span></h3>
        <div class="card widget-box wz-tabs">
         <ul class="wz-title">
           <li class="active">
             <a href="#wz-tab-0">随机文章</a>
           </li>
           <li class="">
             <a href="#wz-tab-1">热门文章</a>
           </li>
           <li class="">
             <a href="#wz-tab-2">最新评论</a>
           </li>
         </ul>
         <div class="wz-container">
          <div id="wz-tab-0" class="wz-content active">
            <?php theme_random_posts($this);?>
          </div>
          <div id="wz-tab-1" class="wz-content">
            <?php theme_hot_posts(1);?>
          </div>
          <div id="wz-tab-2" class="wz-content">
            <?php $this->widget('Widget_Comments_Recent','pageSize=6&ignoreAuthor=true')->to($comments); ?>
            <?php while($comments->next()): ?>
            <li class="recent recent-0 redash"><a href="<?php $comments->permalink(); ?>" title="<?php $comments->excerpt(50, '...'); ?>"><span class="recent-title"><i class="fa fa-comment-o likepost-c"></i><?php $comments->author(false); ?>：<?php $comments->excerpt(50, '...'); ?></span></a></li>
            <?php endwhile; ?>
          </div>
         </div>
        </div>
    </section>
 <?php endif; ?>
<?php endif; ?>

<?php if(!empty($this->options->showad) && in_array('ShowService', $this->options->showad)): ?>
<?php if ($this->is('page','link')||$this->is('page','leaderboards')||$this->is('page','about')) : ?>
<?php if(!empty($this->options->mobilemode) && in_array('ShowService', $this->options->mobilemode)){echo '<div id="disableservice"></div>';} ?>
    <section class="widget" id="tabs-service">
        <h3 class="box-label"><span class="label-left"></span><span class="box-name">本站服务</span></h3>
        <div class="card widget-box">
        <div class="widget-list clearfix">
       <ul class="list-group">
           
        <li class="list-group-item"> <a href="<?php echo fullurl($this->options->showservice1link,0);?>" title="<?php echo $this->options->service1alt ;?>">
<?php if($this->options->lazyimg == '1'): ?>
<img src="<?php echo __LAZYIMG3__; ?>" data-src="<?php echo fullurl($this->options->showservice1,0);?>" class="service-1 lazyloading b-lazy" alt="<?php echo $this->options->service1alt ;?>">
<?php else: ?>
<img src="<?php echo fullurl($this->options->showservice1,0);?>" class="service-1" alt="<?php echo $this->options->service1alt ;?>">
<?php endif; ?>
</a></li><hr>
        <li class="list-group-item"> <a href="<?php echo fullurl($this->options->showservice2link,0);?>" title="<?php echo $this->options->service2alt ;?>">
<?php if($this->options->lazyimg == '1'): ?>
<img src="<?php echo __LAZYIMG3__; ?>" data-src="<?php echo fullurl($this->options->showservice2,0);?>" class="service-2 lazyloading b-lazy" alt="<?php echo $this->options->service2alt ;?>">
<?php else: ?>
<img src="<?php echo fullurl($this->options->showservice2,0);?>" class="service-2" alt="<?php echo $this->options->service2alt ;?>">
<?php endif; ?>
</a></li>
   
       </ul>
        </div>
        </div>
    </section>
<?php endif; ?>
<?php endif; ?>

<?php if (!empty( Helper::options()->isme ) && in_array('ShowLink',Helper::options()->isme)) :?>
<?php $all = Typecho_Plugin::export();   if(array_key_exists('Links', $all['activated'])) :?>
<?php if ($this->is('index')||$this->is('page','link')): ?>
    <section id="tabs-links" class="widget">
     <h3 class="box-label"><span class="label-left"></span><span class="box-name">友情链接</span></h3>
        <div class="card widget-box">
        <ul class="widget-list">
   <?php
    $mypattern = '<li class="indexlink redash"><a href="';
    if (Helper::options()->wailian){
     $mypattern = $mypattern.Helper::options()->wailian;
    }
    $mypattern = $mypattern.'{url}" target="_blank" data-no-instant="true" rel="nofollow"><span class="indexsitename"><i class="fa fa-superpowers likepost"></i>{name} - {title}</span></a>
    </li>'."\n";
     Links_Plugin::output($mypattern, 0, "index");
    ?>
   <li class="indexlink redash">
    <a href="<?php echo fullurl('https://vircloud.net',0);?>" title="VirCloud's Blog"><span class="indexsitename"><i class="fa fa-superpowers likepost"></i>VirCloud's Blog</span></a>
   </li>
   <li class="indexlink redash">
    <a href="<?php echo fullurl('/link.html',Helper::options()->rootUrl);?>" title="朋友圈"><span class="indexsitename"><i class="fa fa-superpowers likepost"></i>查看更多 >></span></a>
   </li>
        </ul>
        </div>
    </section>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>

    <section class="widget">
    </section>

    <?php if ($this->is('single')): ?>
        <section class="widget">   
            <div id="article-index"></div>
        </section>
    <?php endif; ?>

</div><!-- end #sidebar -->

