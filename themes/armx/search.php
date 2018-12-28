<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

    <div class="main single-main search-result" role="main" id="search-result">
    
    <div class="archive-head">

        <div class="search-box"><input id="search-box" type="text" name="s" placeholder="找什么？女朋友" value="<?php $this->archiveTitle(array(
            'search'    =>  _t('%s'),
            'tag'       =>  _t('%s'),
            'author'    =>  _t('%s')
        ), '', ''); ?>"/><a href="javascript:;" class="search-s-btn" id="search-box-btn"></a></div>
    </div>

<?php if($this->getTotal() != '0'): ?>
    	<div class="search-count">找到 <?php echo $this->getTotal();?> 篇关于 “ <?php $this->archiveTitle(array(
            'category'  =>  _t('%s'),
            'search'    =>  _t('%s'),
            'tag'       =>  _t('%s'),
            'author'    =>  _t('%s')
        ), '', ''); ?> ” 的文章</div>
<?php endif; ?>

        <?php if ($this->have()): ?>
    	<?php while($this->next()): ?>
        <article class="post">
            <div class="card post-box clearfix">
                <div class="post-thumbnail"><?php the_post_cat($this);?><a href="<?php $this->permalink() ?>"><img src="<?php the_index_thumbnail($this);?>"></a></div>
                <div class="post-body">
                    <h2 class="post-title"><a href="<?php $this->permalink() ?>"><?php echo highlightSearch($this->getKeywords(),$this->title) ?></a></h2>
                    <div class="post-content">
             <?php if(isset($this->fields->desc)){ 
               echo $this->fields->desc;
             }else{
               echo highlightSearch($this->getKeywords(),mb_substr(strip_tags($this->content), 0, 80, 'utf-8'));
             } ?>
                    ......</div>
                    <div class="post-meta">
<a class="meta-item" href="<?php $this->author->permalink(); ?>"  title="" rel="author"><i class="fa fa-user-o text-muted"></i><?php $this->author(); ?></a>
<span class="meta-item" title=""><i class="fa fa-clock-o text-muted"></i><a href="<?php $this->options->rootUrl();?>/<?php $this->date('Y/m'); ?>/" title=""><?php echo $this->dateWord; ?></a></span>
<span class="meta-item" title=""><i class="fa fa-eye text-muted"></i>阅读(<?php get_post_view($this) ?>)</span>
<span class="meta-item" title=""><i class="fa fa-comments-o text-muted"></i>评论(<a href="<?php $this->permalink() ?>#comments"><?php $this->commentsNum('0', '1', '%d'); ?></a>)</span>
<?php if(isset($this->options->plugins['activated']['Like']) && $this->options->isdonate == '1'): ?><span class="meta-item" title=""><i class="fa fa-heart-o text-muted"></i>喜欢(<?php Like_Plugin::indexLike(); ?>)</span><?php endif;?>
                    </div>
                </div>
            </div>
        </article>
    	<?php endwhile; ?>
        <?php else: empty_message('未找到相关内容，请尝试更换关键字。'); ?>
        <?php endif; ?>
        <?php $this->pageNav('上一页', '下一页'); ?>
    </div><!-- end #main -->
<div class="template-search"></div>
<script type="text/javascript">
function searchBox(){
    var input = document.getElementById('search-box'),
        _input = document.getElementById('s'),
        form = document.getElementById('search'),
        val = input.value.replace(/^\s+/,'').replace(/\s+$/,'');
    if(!val || !val.length){
      ArmMessage.error('找点什么？');
    } else {
    _input.value = val; 
    ajaxForm(form,'<?php $this->options->rootUrl();?>/search/'+ encodeURIComponent(val) +'/');
    }
}

document.getElementById('search-box-btn').onclick = searchBox;
</script>
<?php $this->need('footer.php'); ?>