<?php
/**
 * <span style="color:#25b15e;font-weight:bold;">ArmX 响应式博客主题魔改版</span><br>简约而不简单，支持全站 Pjax，支持全文朗读，丰富的自定义模块；<br>魔改自 NatLiu's Armx<br><span style="font-size:80%">BUG 反馈：<a href="https://vircloud.net/default/change-theme.html#comments" target="_blank">魔改版问题反馈</a></span>；
 * 
 * @package <a href="https://vircloud.net/default/change-theme.html" target="_blank" style="text-decoration:none;color:#444;" title="更新历史">ArmX Mod for Typecho</a>
 * @author 欧文斯
 * @version 6.0.3
 * @link https://vircloud.net
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('header.php');
 ?>
<div class="main" id="main" role="main">
<?php if ($this->have()): ?>
    <h3 class="box-label"><span class="label-left"></span><span class="box-name">最新</span></h3>
	<?php while($this->next()): ?>
        <article class="post">
            <div class="card post-box clearfix">
                <div class="post-thumbnail"><?php the_post_cat($this);?><a href="<?php $this->permalink(); ?>">
<?php if($this->options->lazyimg == '1'): ?>
<img src="<?php echo __LAZYIMG__; ?>" data-src="<?php the_index_thumbnail($this);?>" alt="" class="lazyloading b-lazy">
<?php else: ?>
<img src="<?php the_index_thumbnail($this);?>">
<?php endif;?>
</a></div>
                <div class="post-body">
					<h2 class="post-title"><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h2>
<?php $this->sticky(); ?> <?php new_or_update($this);?>
					<div class="post-content">
             <?php if(isset($this->fields->desc)){ 
               echo $this->fields->desc;
             }else{
               echo mb_substr(strip_tags($this->content), 0, 80, 'utf-8');
             } ?>
                                        ......</div>
					<div class="post-meta">
<a class="meta-item" href="<?php $this->author->permalink(); ?>"  title="" rel="author"><i class="fa fa-user-o text-muted"></i><?php $this->author(); ?></a>
<span class="meta-item" title="" id="meta-date"><i class="fa fa-clock-o text-muted"></i><a href="<?php $this->options->rootUrl();?>/<?php $this->date('Y/m'); ?>/" title=""><?php echo $this->dateWord; ?></a></span>
<span class="meta-item" title="" id="meta-view"><i class="fa fa-eye text-muted"></i>阅读(<a href="<?php $this->permalink() ?>"><?php get_post_view($this) ?></a>)</span>
<span class="meta-item" title="" id="meta-comment"><i class="fa fa-comments-o text-muted"></i>评论(<a href="<?php $this->permalink() ?>#comments"><?php $this->commentsNum('0', '1', '%d'); ?></a>)</span>
<?php if(isset($this->options->plugins['activated']['Like']) && $this->options->isdonate == '1'): ?><span class="meta-item" title="" id="meta-like"><i class="fa fa-heart-o text-muted"></i>喜欢(<?php Like_Plugin::indexLike(); ?>)</span><?php endif;?>
                                        </div>
				</div>
			</div>
        </article>
	<?php endwhile; ?>
<?php else: empty_message('暂无内容'); ?>
<?php endif; ?>
   <?php $this->pageNav('上一页', '下一页', 2); ?>
</div><!-- end #main-->

<?php $this->need('sidebar.php'); ?>
<div class="template-index"></div>
<?php $this->need('footer.php'); ?>
