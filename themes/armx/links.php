<?php 
/**
* 友情链接
*
* @package custom
*/
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>

<div id="main" class="main">
  <h3 class="box-label"><span class="label-left"></span><span class="box-name" id="box-name"><?php $this->title() ?></span></h3>
    <article class="article">
    <div class="article-box card">
        <div class="article-content linkspage">
         <?php $this->content(); ?>
<div class="line"></div>
<div class="links">
  <ul>
    <li>
     <a href="https://vircloud.net" target="_blank" data-no-instant rel="nofollow"><span class="sitename">VirCloud's Blog</span><div class="linkdes">Learning & Sharing.</div></a>
    </li>
   <?php 
    $mypattern = '
    <li>
     <a href="{url}" target="_blank" data-no-instant rel="nofollow"><span class="sitename">{name}</span><div class="linkdes">{title}</div></a>
    </li>'."\n"; 
    $all = Typecho_Plugin::export();
    if(array_key_exists('Links', $all['activated'])){
      Links_Plugin::output($mypattern, 0, "one");
    } else{
     echo' <br /><span style="color:red">请启用 <a href="https://vircloud.net/default/change-theme.html" target="_blank"  style="color:red">Links </a>插件</span>';
    }
    ?>
  </ul>
</div>
        </div>
    </div>
    </article>

</div>

<?php $this->need('sidebar.php'); ?>
<div class="template-links"></div>
<?php $this->need('footer.php'); ?>

	
