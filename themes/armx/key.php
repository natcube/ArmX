<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!-- begin #keyboard -->
<?php if($this->is('post') && in_array('EnableKey',Helper::options()->switchEnable) && !in_array('enablePjax',Helper::options()->switchEnable) ): ?>
<script type="text/javascript">
if(document.getElementById("template-post")){
 document.onkeydown=nextpage;
 <?php thePrev($this); ?>
 <?php theNext($this); ?>
 function nextpage(event){
  event = event ? event : (window.event ? window.event : null);
  if (event.keyCode == 39){
   if (typeof nextpost != 'undefined') {
    location = nextpost;
   }else{
    ArmMessage.error('已经是最后一篇文章啦！');
   }
  }
  if (event.keyCode == 37){
   if(typeof prevpost != 'undefined') {
    location = prevpost;
   }else{
    ArmMessage.error('已经是第一篇文章啦！');
   }
  }
 }
}
</script>
<?php endif; ?>
<!-- end #keyboard -->
