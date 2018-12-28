<?php 
/**
* 闲言碎语
*
* @package custom
*/
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>

<div id="main" class="main">
  <h3 class="box-label"><span class="label-left"></span><span class="box-name" id="box-name"><?php $this->title() ?></span></h3>
    <article class="article saying">
    <div class="article-box card">
      <hr class="saying-hr">
      <div class="article-content">
<?php if (!empty( Helper::options()->switch ) && in_array('Commentfirst',Helper::options()->switch)){
                $db = Typecho_Db::get();
                $sql = $db->select()->from('table.comments')
                        ->where('cid = ?',$this->cid)
                        ->where('mail = ?', $this->remember('mail',true))
                        ->limit(1);
                $result = $db->fetchAll($sql);
                if($this->user->hasLogin() || $result) {
                        echo parseContent($this,1);
                } else {
                        echo parseContent($this,0);
                }
} else {
                echo parseContent($this,1);
}
?>
      </div> 
      <hr class="saying-hr">
      <div class="saying-content">
     	 <?php $this->need('lib/mood.php'); ?>
      </div>
    </div>
    </article>
</div>
<?php $this->need('sidebar.php'); ?>
<div class="template-mood"></div>
<?php $this->need('footer.php'); ?>
