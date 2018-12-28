<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$i = 1;
$n = 1;
foreach(glob('img/avatarcache/*.jpg') as $file){
$ext = pathinfo($file,PATHINFO_EXTENSION);
$imginfo = getimagesize($file);
$type = substr(strrchr($imginfo['mime'],'/'),1);
if ($type =='jpeg'){
 $type = 'jpg';
} else{
   $pw = $imginfo[0];
   $ph = $imginfo[1];
   $dstimg = imagecreatetruecolor($pw,$ph);
   $color = imagecolorallocate($dstimg,255,255,255);
   imagefill($dstimg,0,0,$color);
   if ($type=='png'){
      $srcimg = imagecreatefrompng($file);
   }
   if ($type=='gif'){
      $srcimg = imagecreatefromgif($file);
   }
   imagecopyresampled($dstimg,$srcimg,0,0,0,0,$pw,$ph,$pw,$ph);
   imagejpeg($dstimg,$file,90);
   imagedestroy($dstimg);
   $n++;
   echo '第'.$i.'个文件是：'.basename($file).'，扩展名是：'.$ext.'，真实格式是：'.$type.'；已尝试自动转换。';
   echo '<br>';
}
$i++;
}
$i = $i-1;
$n = $n-1;
if($n == 0){
  echo '本目录下有 '.$i.' 个文件，扩展名与文件类型一致，无需转换。';
}else{
  echo '本目录下有 '.$i.' 个文件，扩展名与文件类型不一致的有 '.$n.' 个并已自动尝试转换成 .jpg 格式，请刷新页面查看结果。';
}
?>
