<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

    <div class="main single-main" id="main" role="main">
    <?php $author = new Typecho_Config($this->getPageRow());?>
    <div class="archive-head">
        <div class="author-box">
            <div class="author-avatar"><img class="avatar-img" src="<?php echo Typecho_Common::gravatarUrl($author->mail, 100, 'X', 'mm', $this->request->isSecure());?>" /></div>
            <p class="author-name"><?php echo $author->screenName;?></p>
        </div>
    </div>
    <?php if ($this->have()): ?>
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
	<?php $this->need('footer.php'); ?>
