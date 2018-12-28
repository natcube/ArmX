<?php   
    /**  
    * 排行榜  
    *  
    * @package custom  
    */  
?>
<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>


<div id="main" class="main"> 
  <h5 class="box-label"><span class="label-left"></span><span class="box-name" id="box-name"><?php $this->title() ?></span></h5>
    <article class="article"  id="article">
    <div class="article-box card">
        <div class="article-content">
<!--热门-->
         <article class="panel panel-top">
          <div id="post-content" class="bordlist">
           <div class="leaderboards">
            <section id="tabs-view" class="links2 clear"> 
             <div class="mc-toggle active">   
              <div class="toggle-title not-select">
               <h5 class="text-md m-t-none"><i class="fa fa-street-view sm" aria-hidden="true"></i>浏览榜</h5>
              </div>
              <div class="toggle-content transition3">
               <ul class="m-b-none"><?php theme_hot_posts($this);?></ul>
              </div>
             </div>
            </section>
           </div>
          </div>
         </article>
<!--点赞-->
         <article class="panel panel-top">
          <div id="post-content" class="bordlist">
           <div class="leaderboards">
            <section id="tabs-zan" class="links2 clear">
             <div class="mc-toggle">   
              <div class="toggle-title not-select">
               <h5 class="text-md m-t-none"><i class="fa fa-thumbs-up sm" aria-hidden="true"></i>点赞榜</h5>
              </div>
              <div class="toggle-content transition3">
               <ul class="m-b-none"><?php Like_Plugin::theMostLiked(6); ?></ul>
              </div>
             </div>
            </section>
           </div>
          </div>
         </article>
<!--评论-->
         <article class="panel panel-top">
          <div id="post-content" class="bordlist">
           <div class="leaderboards">
            <section id="tabs-comment" class="links2 clear">
             <div class="mc-toggle">   
              <div class="toggle-title not-select">
               <h5 class="text-md m-t-none"><i class="fa fa-comment sm" aria-hidden="true"></i>评论榜</h5>
              </div>
              <div class="toggle-content transition3">
               <ul class="m-b-none"><?php theme_mocom_posts($this); ?></ul>
              </div>
             </div>
            </section>
           </div>
          </div>
         </article>
<!--活跃-->
         <article class="panel">
          <div id="post-content" class="bordlist">
           <div class="leaderboards">
            <section id="tabs-active" class="links2 clear">
             <div class="mc-toggle">   
              <div class="toggle-title not-select">
                <h5 class="text-md m-t-none"><i class="fa fa-fire sm" aria-hidden="true"></i>活跃榜</h5>
              </div>
              <div class="toggle-content transition3">
                <ul class="m-b-none"><?php getFriendWall(); ?></ul>
              </div>
             </div>
            </section>
           </div>
          </div>
         </article>
     </div>
    </div>
   </article>
</div>

<?php $this->need('sidebar.php')?>
<div class="template-leaderboards"></div>
<?php $this->need('footer.php'); ?>
