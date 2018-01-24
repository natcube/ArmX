<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

    <div class="main single-main search-result" role="main" id="search-result">
    
        <div class="search-box"><input id="search-box" type="text" name="s" value="<?php $this->archiveTitle(array(
            'search'    =>  _t('%s'),
            'tag'       =>  _t('%s'),
            'author'    =>  _t('%s')
        ), '', ''); ?>"/><a href="javascript:;" class="search-btn" id="search-box-btn"></a></div>
    	<div class="search-count">为您找到 <?php echo $this->getTotal();?> 篇相关文章</div>
        <?php if ($this->have()): ?>
    	<?php while($this->next()): ?>
        <article class="post">
            <div class="card post-box clearfix">
                <div class="post-thumbnail"><?php the_post_cat($this);?><a href="<?php $this->permalink() ?>"><img src="<?php the_post_thumbnail($this);?>"></a></div>
                <div class="post-body">
                    <h2 class="post-title"><a href="<?php $this->permalink() ?>"><?php echo highlightSearch($this->getKeywords(),$this->title) ?></a></h2>
                    <div class="post-tag"><?php $this->tags('， ', true, ''); ?></div>
                    <div class="post-content"><?php echo highlightSearch($this->getKeywords(),mb_substr(strip_tags($this->content), 0, 55, 'utf-8')); ?>...</div>
                    <div class="post-meta"><a class="meta-item" href="<?php $this->author->permalink(); ?>" rel="author"><img class="avatar" src="<?php echo Typecho_Common::gravatarUrl($this->author->mail, 23, 'X', 'mm', $this->request->isSecure());?>"><?php $this->author(); ?></a><span class="meta-item"><?php $this->date(); ?></span></div>
                </div>
            </div>
        </article>
    	<?php endwhile; ?>
        <?php else: empty_message('暂无内容'); ?>
        <?php endif; ?>

        <?php $this->pageNav('上一页', '下一页'); ?>
    </div><!-- end #main -->

<script type="text/javascript">
function searchBox(){
    var input = document.getElementById('search-box'),
        _input = document.getElementById('s'),
        form = document.getElementById('search'),
        val = input.value.replace(/^\s+/,'').replace(/\s+$/,'');
    if(!val || !val.length){
      return alert('请输入关键词');
    }
    _input.value = val;
    search();
}

document.getElementById('search-box-btn').onclick = searchBox;
</script>
<?php $this->need('footer.php'); ?>