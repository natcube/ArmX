<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

    <div class="main" id="main" role="main">
    <?php if ($this->have()): ?>
        <h3 class="box-label"><span class="label-left"></span><span class="box-name"><?php $this->archiveTitle(array(
            'search'    =>  _t('%s'),
            'tag'       =>  _t('%s'),
            'author'    =>  _t('%s')
        ), '', ''); ?></span></h3>
    	<?php while($this->next()): ?>
        <article class="post">
            <div class="card post-box clearfix">
                <div class="post-thumbnail"><?php the_post_cat($this);?><a href="<?php $this->permalink() ?>"><img src="<?php the_post_thumbnail($this);?>"></a></div>
                <div class="post-body">
                    <h2 class="post-title"><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h2>
                    <div class="post-tag"><?php $this->tags('， ', true, ''); ?></div>
                    <div class="post-content"><?php echo mb_substr(strip_tags($this->content), 0, 55, 'utf-8'); ?>...</div>
                    <div class="post-meta"><a class="meta-item" href="<?php $this->author->permalink(); ?>" rel="author"><img class="avatar" src="<?php echo Typecho_Common::gravatarUrl($this->author->mail, 23, 'X', 'mm', $this->request->isSecure());?>"><?php $this->author(); ?></a><span class="meta-item"><?php echo $this->dateWord; ?></span></div>
                </div>
            </div>
        </article>
    	<?php endwhile; ?>
        <?php else: empty_message('暂无内容'); ?>
        <?php endif; ?>

        <?php $this->pageNav('上一页', '下一页'); ?>
    </div><!-- end #main -->

	<?php $this->need('sidebar.php'); ?>
	<?php $this->need('footer.php'); ?>
