<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div id="main" class="main">
single
    <article class="article" id="article">
    <div class="article-box card">
        <h1 class="article-title" ><?php $this->title() ?></h1>
        <div class="article-meta">
            <a class="meta-item meta-author" href="<?php $this->author->permalink(); ?>" rel="author"><img src="<?php echo Typecho_Common::gravatarUrl($this->author->mail, 23, 'X', 'mm', $this->request->isSecure());?>"><?php $this->author(); ?></a><span class="meta-item meta-date"><?php $this->date(); ?></span><span class="meta-item meta-cate"><?php $this->category('，'); ?></span>
        </div>
        <div class="article-content">
            <?php $this->content(); ?>
        </div>
        <?php if($this->tags):?>
        <div class="article-tags"><?php $this->tags('', true, ''); ?></div>
        <?php endif;?>
    </div>
    </article>

    <?php $this->need('comments.php'); ?>

    <ul class="post-near">
    <?php $this->thePrev('<li class="post-prev">%s</li>','',['title'=>'上一篇','tagClass'=>'post-near-label']); ?>
    <?php $this->theNext('<li class="post-next">%s</li>','',['title'=>'下一篇','tagClass'=>'post-near-label']); ?>
    </ul>
</div><!-- end #main-->

<?php $this->need('sidebar.php'); ?>
<div class="template-single"></div>
<?php $this->need('footer.php'); ?>
