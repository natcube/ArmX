<?php
function parsesmilies($type){
	$turl = Typecho_Widget::widget('Widget_Options')->themeUrl.'/img/smiles/';
	$smsort = array('icon_mrgreen.gif','icon_neutral.gif','icon_twisted.gif','icon_arrow.gif','icon_eek.gif','icon_smile.gif','icon_confused.gif','icon_cool.gif','icon_evil.gif','icon_biggrin.gif','icon_idea.gif','icon_redface.gif','icon_razz.gif','icon_rolleyes.gif','icon_wink.gif','icon_cry.gif','icon_surprised.gif','icon_lol.gif','icon_mad.gif','icon_sad.gif','icon_exclaim.gif','icon_question.gif');
	if(!isset($type)){
		$type = '0';
	}
	if($type == '0'){
		$pattern = array(':mrgreen:',':neutral:',':twisted:',':arrow:',':shock:',':smile:',':???:',':cool:',':evil:',':grin:',':idea:',':oops:',':razz:',':roll:',':wink:',':cry:',':eek:',':lol:',':mad:',':sad:',':!:',':?:');
		
	} elseif($type == '1'){
		$pattern = array(':alumrgreen:',':aluneutral:',':alutwisted:',':aluarrow:',':alushock:',':alusmile:',':alu???:',':alucool:',':aluevil:',':alugrin:',':aluidea:',':aluoops:',':alurazz:',':aluroll:',':aluwink:',':alucry:',':alueek:',':alulol:',':alumad:',':alusad:',':alu!:',':alu?:');
		
	} elseif($type == '2') {
		$pattern = array(':qqmrgreen:',':qqneutral:',':qqtwisted:',':qqarrow:',':qqshock:',':qqsmile:',':qq???:',':qqcool:',':qqevil:',':qqgrin:',':qqidea:',':qqoops:',':qqrazz:',':qqroll:',':qqwink:',':qqcry:',':qqeek:',':qqlol:',':qqmad:',':qqsad:',':qq!:',':qq?:');
		
	}
	$smtrans = array_combine($pattern,$smsort);
	$smiled = array();
	$smiliesicon = array();
	$smiliestag = array();
	$smiliesimg = array();
	$loading = 'data:image/gif;base64,R0lGODlhKwAeAJEAAP///93d3Xq9VAAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQFFAAAACwDAA0AJQADAAACEpSPAhDtHxacqcr5Lm416f1hBQAh+QQJFAAAACwDAA0AJQADAAACFIyPAcLtDKKcMtn1Mt3RJpw53FYAACH5BAkUAAAALAMADQAlAAMAAAIUjI8BkL0CoxQtrYrenPjcrgDbVAAAOw==';
	if(Helper::options()->smilescdn){
		$smurl = str_ireplace($turl,Helper::options()->smilescdn,$turl);
	}
	if($type == '0'){
		$smurl = $smurl.'qq/';
	} elseif($type == '1'){
		$smurl = $smurl.'alu/';
	} elseif($type == '2') {
		$smurl = $smurl.'qqplus/';
	}
	foreach ($smtrans as $tag=>$grin) {
	if (!in_array($grin,$smiled)) {
		if(Helper::options()->lazyimg){
		if( $type =='1' ){
			$smiliesicon[] ='<a href="javascript:grin(\''.$tag.'\')"><img src="'.$loading.'" data-src="'.$smurl.$grin.'" alt="'.$grin.'" class="asmile lazyloading b-lazy"/></a>';
			$smiliesimg[] = '<img src="'.$loading.'" data-src="'.$smurl.$grin.'" alt="'.$grin.'" class="smilies lazyloading b-lazy"/>'; 
		}else{
                        $smiliesicon[] ='<a href="javascript:grin(\''.$tag.'\')"><img src="'.$loading.'" data-src="'.$smurl.$grin.'" alt="'.$grin.'" class="asmile lazyloading b-lazy qqplus"/></a>';
                        $smiliesimg[] = '<img src="'.$loading.'" data-src="'.$smurl.$grin.'" alt="'.$grin.'" class="smilies lazyloading b-lazy qqplus"/>';
		}}else{
		if($type == '1'){
			$smiliesicon[] ='<a href="javascript:grin(\''.$tag.'\')"><img src="'.$smurl.$grin.'" alt="'.$grin.'" class="asmile lazyloading b-lazy"/></a>'; 
			$smiliesimg[] = '<img src="'.$smurl.$grin.'" alt="'.$grin.'" class="smilies lazyloading b-lazy"/>'; 
		}else{
			$smiliesicon[] ='<a href="javascript:grin(\''.$tag.'\')"><img src="'.$smurl.$grin.'" alt="'.$grin.'" class="asmile lazyloading b-lazy smiliesqq"/></a>';
                        $smiliesimg[] = '<img src="'.$smurl.$grin.'" alt="'.$grin.'" class="smilies lazyloading b-lazy smiliesqq"/>';
	}
	}}
	$smiliestag[] = $tag;
	}
	return array($smiliesicon,$smiliestag,$smiliesimg);
}
function outputsilies($type){
	$arrays = parsesmilies($type);
	$smilies = '';
	foreach ($arrays['0'] as $icon) {
		$smilies .= $icon;
	}
	$output = preg_replace('/\'/','\\\'',$smilies);
	echo $output;
}
function outputstyle(){
	return "<style>.qqplus{width:32px;}.smilies{vertical-align:middle;}.smiles{background-color:#25b15e;color:#fff}.smiles:hover,.smiles:active,.smiles.active{background-color:#59B76D;}.smilies-list{width:90%;margin-top:7px;display:block;position:relative;}.smiles-sidebar{position:absolute;z-index:1;width:100%;display:none;}.smiles-widget-tab .smiles-widget-box{background:#F6F6F6;height:160px;overflow-y:auto;max-height:160px;border:1px #ddd solid;}.new-list li{display:block;}</style>";
}
function outputbutton(){
	return "<button id=\"smilies\" class=\"btn btn-s smiles\" type=\"button\">表情</button>";
}
function outputlistf(){
	return "<div class=\"smilies-list\" id=\"smilies-list\"><div class=\"smiles-sidebar\" id=\"smiles-sidebar\"><div class=\"smiles-widget smiles-widget-tab\" id=\"smiles-widget\"><div class=\"smiles-widget-box\"><ul class=\"new-list\"><li>";
}
function outputlistl(){
	return "</li></ul></div></div></div></div>";
}
function outputjs(){
	if(Helper::options()->lazyimg){
		return "<script type=\"text/javascript\" src=\"/usr/themes/armx/js/blazy.min.js\"></script>"."<script type=\"text/javascript\" src=\"/usr/themes/armx/lib/smaile.js\"></script>";
	}else{
		return "<script type=\"text/javascript\" src=\"/usr/themes/armx/lib/smaile.js\"></script>";
	}
}

?>
