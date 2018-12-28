<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

    <div class="main single-main" id="main" role="main">
    <div class="archive-head">
        <div class="author-box">
            <div class="author-avatar"><img class="avatar-img" src="<?php echo $this->options->archimg;?>" /></div>
            <p class="author-name"><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章'),
            'date'    =>  _t('%s 发布的文章')
        ), '', ''); ?></p>
        </div>
    </div>

    <?php if ($this->have()): ?>
    	<?php while($this->next()): ?>
        <article class="post">
            <div class="card post-box clearfix">
                <div class="post-thumbnail"><?php the_post_cat($this);?><a href="<?php $this->permalink() ?>">
<?php if($this->options->lazyimg == '1'): ?>
<img src="<?php echo __LAZYIMG__; ?>" data-src="<?php the_index_thumbnail($this);?>" alt="" class="lazyloading b-lazy">
<?php else: ?>
<img src="<?php the_index_thumbnail($this);?>">
<?php endif;?>
                  </a></div>
                <div class="post-body">
                    <h2 class="post-title"><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h2>

                    <div class="post-content">
             <?php if(isset($this->fields->desc)){ 
               echo $this->fields->desc;
             }else{
               echo mb_substr(strip_tags($this->content), 0, 80, 'utf-8');
             } ?>
                    ......</div>

					<div class="post-meta">
<a class="meta-item" href="<?php $this->author->permalink(); ?>"  title="" rel="author"><i class="fa fa-user-o text-muted"></i><?php $this->author(); ?></a>
<span class="meta-item" title=""><i class="fa fa-clock-o text-muted"></i><a href="<?php $this->options->rootUrl();?>/<?php $this->date('Y/m'); ?>/" title=""><?php echo $this->dateWord; ?></a></span>
<span class="meta-item" title=""><i class="fa fa-eye text-muted"></i>阅读(<a href="<?php $this->permalink() ?>"><?php get_post_view($this) ?></a>)</span>
<span class="meta-item" title=""><i class="fa fa-comments-o text-muted"></i>评论(<a href="<?php $this->permalink() ?>#comments"><?php $this->commentsNum('0', '1', '%d'); ?></a>)</span>
<?php if(isset($this->options->plugins['activated']['Like']) && $this->options->isdonate == '1'): ?><span class="meta-item" title=""><i class="fa fa-heart-o text-muted"></i>喜欢(<?php Like_Plugin::indexLike(); ?>)</span><?php endif;?>
                                        </div>
                </div>
            </div>
        </article>
    	<?php endwhile; ?>
        <?php else: empty_message('暂无内容'); ?>
        <?php endif; ?>
        <?php $this->pageNav('上一页', '下一页'); ?>
    </div><!-- end #main -->
<div class="template-archive"></div>
	<?php $this->need('footer.php'); ?>
