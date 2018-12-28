<?php 
/**
* 留言板
*
* @package custom
*/
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>

<div id="main" class="main">
  <h3 class="box-label"><span class="label-left"></span><span class="box-name" id="box-name"><?php $this->title() ?></span></h3>
    <article class="article" id="article">
    <div class="article-box card">
        <div class="article-content singlepage">
            <?php parseContent($this,1); ?>
        </div>
    </div>
    </article>
<?php $this->need('comments.php'); ?>
</div>

<?php $this->need('sidebar.php'); ?>
<div class="template-guestbook"></div>
<?php $this->need('footer.php'); ?>

	
