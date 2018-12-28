<?php 
/**
* 搜索页
*
* @package custom
*/
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>

    <div class="main single-main search-result" role="main" id="search-result">
    
      <div class="archive-head archive-head-search">

        <div class="search-box"><input id="search-box" type="text" name="s" value="" placeholder="找点什么？男朋友"/><a href="javascript:;" class="search-s-btn" id="search-box-btn"></a></div>
      </div>
      <div class="article-content search-content">
         <?php parseContent($this,1); ?>
      </div>
    </div>

    <div class="search-recom">
     <?php $this->widget('Widget_Metas_Tag_Cloud', 'sort=count&ignoreZeroCount=1&desc=1&limit=50')->to($tags); ?>
        <?php if($tags->have()): ?>
            <?php while ($tags->next()): ?>
            <a href="<?php $tags->permalink(); ?>" class=""># <?php $tags->name(); ?>(<?php $tags->count(); ?>)</a>
            <?php endwhile; ?>
        <?php else: ?>
            <p> Nothing here ! </p>
        <?php endif; ?>
    </div>
<!-- end #main -->
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
    ajaxForm(form, '<?php $this->options->rootUrl();?>/search/'+ encodeURIComponent(val) +'/');
    }
}
    document.getElementById('search-box-btn').onclick = searchBox;
</script>
<div id="search-single"></div>
<?php $this->need('footer.php'); ?>
