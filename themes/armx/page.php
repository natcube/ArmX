<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div id="main" class="main">
    <article class="article">
    <div class="article-box card">
        <h1 class="article-title" ><?php $this->title() ?></h1>
        <div class="article-meta">
            <a class="meta-item meta-author" href="<?php $this->author->permalink(); ?>" rel="author"><img src="<?php echo Typecho_Common::gravatarUrl($this->author->mail, 23, 'X', 'mm', $this->request->isSecure());?>"><?php $this->author(); ?></a><span class="meta-item meta-date"><?php $this->date(); ?></span><span class="meta-item meta-cate"><?php $this->category('，'); ?></span>
        </div>
        <div class="article-content">
            <?php $this->content(); ?>
        </div>
    </div>
    </article>
    <?php $this->need('comments.php'); ?>
</div><!-- end #main-->

<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>
