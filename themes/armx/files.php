<?php 
/**
* 时光鸡
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
        <div class="article-content">
          <div class="archive">
    	   <ul class="timeline">
            <?php 
                $stat = Typecho_Widget::widget('Widget_Stat');
                Typecho_Widget::widget('Widget_Contents_Post_Recent', 'pageSize='.$stat->publishedPostsNum)->to($archives);
                $color = array("gray","gray","gray","gray","gray","gray","gray","gray");
                $year=0; $mon=0; $i=0; $j=0;
                $output = '';
                $x=0;
                while($archives->next()){
                    $year_tmp = date('Y',$archives->created);
                    $mon_tmp = date('m',$archives->created);
                    $y=$year; $m=$mon;
                    if ($year > $year_tmp || $mon > $mon_tmp) {
                        $output .= '';
                    }
                    if ($year != $year_tmp || $mon != $mon_tmp) {
                        $year = $year_tmp;
                        $mon = $mon_tmp;
                        $x++;
                        if($x>7) $x=1;
                        $colorsec = $color[$x];
                        $output .= '<li class="tl-header"><span class="btn btn-';
                        $output .= $colorsec;
                        $output .=' btn-rounded m-t-none"><a href="/'.date('Y/m/',$archives->created).'"><h2 class="cross">'.date('Y 年 m 月',$archives->created).'</h2></a></span></li>';//输出月份
                    }
                    $output .= '<li class="tl-item"><div class="tl-wrap b-';
                    $output .= $colorsec;
                    $output .='"><span class="tl-date">'.date('d 日',$archives->created).'</span><span class="tl-content bg-';
                    $output .=$colorsec;
                    $output .='"><a href="'.$archives->permalink .'" class="text-lt">'. $archives->title .'</a></span></div></li>'; //输出文章
                }
                $output .= '';
                echo $output;
            ?>
                <li class="tl-header">
                <div class="<?php echo 'btn btn-'.$colorsec.'btn-rounded m-t-none'; ?>"><a href="<?php $this->options->rootUrl(); ?>/start-page.html" class="text-tl">破壳日</a></div></li>
              </ul>
           </div>
        </div>
    </div>
    </article>
</div>

<?php $this->need('sidebar.php'); ?>
<div class="template-cross"></div>
<?php $this->need('footer.php'); ?>

	