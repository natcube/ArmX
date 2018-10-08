<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div class="sidebar" id="sidebar" role="sidebar">
    <?php if (!$this->is('index') && !$this->is('single')):$this->widget('Widget_Contents_Post_Recent')->to($recent); ?>
         <?php if($recent->have()): ?>
    <section class="widget">
		<h3 class="box-label"><span class="label-left"></span><span class="box-name">推荐阅读</span></h3>
        <div class="card widget-box">
        <ul class="widget-list">
            <?php $i = 0;
            while ($recent->next()):?>
                 <li class="recent recent-<?php echo $i;?>"><a href="<?php $recent->permalink();?>"><span class="recent-avatar"><img src="<?php the_post_thumbnail($recent);?>"></span><span class="recent-title"><?php $recent->title();?></span><span class="recent-meta"><?php echo $recent->dateWord;?></span></a></li>
            <?php $i++; endwhile; ?>
        </ul>
        </div>
    </section>
     <?php endif; ?>
    <?php endif; ?>

    <?php if ($this->is('single')): $this->related(5)->to($relatedPosts);?>
        <?php if($relatedPosts->have()): ?>
            <section class="widget">
                <h3 class="box-label"><span class="label-left"></span><span class="box-name">相关文章</span></h3>
                <div class="card widget-box">
                <ul class="widget-list">
                <?php $i = 0; while($relatedPosts->next()): ?>
                    <li class="recent recent-<?php echo $i;?>"><a href="<?php $relatedPosts->permalink();?>"><span class="recent-avatar" style="background-image:url(<?php the_post_thumbnail($relatedPosts);?>)"></span><span class="recent-title"><?php $relatedPosts->title();?></span><span class="recent-meta"><?php echo $relatedPosts->dateWord;?></span></a></li>
                <?php $i++; endwhile; ?>
                </ul>
                </div>
            </section>
        <?php endif; ?>
    <?php endif; ?>

<?php $this->widget('Widget_Metas_Tag_Cloud', 'sort=mid&ignoreZeroCount=1&desc=0&limit=30')->to($tags); ?>
<?php if($tags->have()): ?>
    <section class="widget">
        <h3 class="box-label"><span class="label-left"></span><span class="box-name">热门标签</span></h3>
        <div class="card widget-box">
        <div class="widget-list tags-list clearfix">
        <?php while($tags->next()): ?>
            <a href="<?php $tags->permalink(); ?>" rel="tag" class="size-<?php $tags->split(5, 10, 20, 30); ?>" title="<?php $tags->count(); ?> 篇文章"><?php $tags->name(); ?></a>
        <?php endwhile; ?>
        <div style="clear:both; height:0; overflow:hidden; width:100%;"></div>
        </div>
        </div>
    </section>
<?php endif; ?>
    <section class="widget">
        <a href="https://codeup.me/armx.html"><img src="https://codeup.me/uploads/2018/01/1574857160.png"></a>
    </section>
    <?php if ($this->is('single')): ?>
        <section class="widget">
            <div id="article-index"></div>
        </section>
    <?php endif; ?>

</div><!-- end #sidebar -->
