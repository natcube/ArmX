<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php if( $this->options->loadingtype == '1'){
 echo "<style>#nprogress .bar {position:fixed;}</style>";
 } else if( $this->options->loadingtype == '2'){
 echo "<style>#nprogress .spinner {position:fixed;}</style>"; }
?>
        </div><!-- end .row -->
    </div>
</div><!-- end #body -->
<footer id="footer" class="footer">
    <div class="container">&copy; 2017-<?php echo date('Y'); ?> <?php echo $this->options->copyright; ?> ALL RIGHTS RESERVED.</div>
    <div class="copyright">POWERED BY <?php echo formaturl($this->options->powerby,$this->options->rootUrl); ?>, THEME BY <a href="<?php $this->options->rootUrl(); ?>/go/armx/" target="_blank">ARMX</a> & <a href="https://vircloud.net/default/change-theme.html" target="_blank" id="copyright">VIRCLOUD</a>.</div>
    <div class="footer-line"></div>
    <div class="footer-site"><?php echo formaturl($this->options->footersite,$this->options->rootUrl); ?></div>
    <div class="footer-time">
       本站低碳服务器已续<span id="htmer_time"><?php uptime(0); ?></span>秒

       <?php if($this->options->isdonate == '1' && isset($this->options->plugins['activated']['Like'])): ?>
           ，<a data-fancybox data-animation-duration="700" data-src="#animatedModal" href="javascript:;" class="post-like" id="like-shang">点我给博客 +1s <i class="fa fa-arrow-circle-right"></i></a>
<div style="display: none;" id="animatedModal" class="animated-modal">
          <h3 class="wxscan"><i class="be be-favorite heart"></i>感谢打赏<i class="be be-favorite heart" aria-hidden="true"></i></h3>
<div class="wxscanimg">
  <p class="wxloading">
    <img src="<?php echo __LAZYIMG__; ?>" data-src="<?php echo fullurl($this->options->donate_img,0); ?>" id="shangqr"/>
  </p>
</div>
          <h3 class="thanks like-shang_b">微信扫一扫</h3>
</div>
<?php endif; ?>    

    </div>   
<div class="footer-ext">
  <ul>
<?php if (!empty($this->options->wangbei)):?><li>
<?php if(!empty($this->options->advanced) && in_array('AutoFimg', $this->options->advanced)): ?>
<img src="<?php echo Typecho_Widget::widget('Widget_Options')->themeUrl;?>/img/whs.png">
<?php endif; ?>
<a href="<?php if($this->options->wailian){echo $this->options->wailian;} ?>http://www.miibeian.gov.cn" target="_blank" rel="nofollow"><?php echo $this->options->wangbei ;?></a></li><?php endif; ?>
<?php if (!empty($this->options->anbei)):?><li>
<?php if(!empty($this->options->advanced) && in_array('AutoFimg', $this->options->advanced)): ?>
<img src="<?php echo Typecho_Widget::widget('Widget_Options')->themeUrl;?>/img/ghs.png">
<?php endif; ?>
<a href="<?php if($this->options->wailian){echo $this->options->wailian;} ?>http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=<?php echo getanbei() ;?>" target="_blank" rel="nofollow"><?php echo $this->options->anbei ;?></a></li><?php endif; ?>
  </ul>
</div>  
<div class="footer-count">   
</div> 
</footer><!-- end #footer -->

<ul id="scroll">
	<li><a class="scroll-h" title="返回顶部"><i class="fa fa-angle-up"></i></a></li>
<?php if ($this->is('page', 'guestbook') || $this->is('post')): ?>
	<li><a class="scroll-c" title="评论"><i class="fa fa-comment-o"></i></a></li>
<?php endif; ?>
	<li><a class="scroll-b" title="转到底部"><i class="fa fa-angle-down"></i></a></li>
<?php if (!empty( Helper::options()->switchEnable ) && in_array('GB2Site',Helper::options()->switchEnable)) :?>
	<li class="gb2-site"><a id="gb2big5" href="javascript:StranBody()" title="繁體"><span>繁</span></a></li>
<?php endif; ?>
<?php if($this->options->nightmode):?>
	<li class="nightmode-btn"><a id="nightmode-btn" href="javascript:tmode()" title="夜间模式"><i class="fa fa-moon-o" id="tmode-btn"></i></a></li>
<?php endif; ?>
<?php if($this->options->isstat == '1'): ?>
        <li class="sum-li"><a id="sum-btn" href="javascript:" title="网站统计"><i class="fa fa-cogs"></i></a></li>
<div id="scrooll-summary">
<div id="sc-sum-de">
<li><i class="fa fa-eye likepost"></i>浏览总量：<?php echo get_sum_views(); ?> 次</li>
<?php $all = Typecho_Plugin::export(); ?><?php if(array_key_exists('Links',$all['activated'])): ?>
<li><i class="fa fa-link likepost"></i>友情链接：<?php echo get_sum_links();?> 个</li><?php endif;?>
<li><i class="fa fa-clock-o likepost"></i>网站运行：<?php uptime(1);?> 天</li>
<?php if(!empty(Helper::options()->footerswitch)&&in_array('LastLogin',Helper::options()->footerswitch)):?>
<li><i class="fa fa-sign-in likepost"></i>上次在线：<?php get_last_login(1);?></li><?php endif;?>
<?php if(!empty(Helper::options()->footerswitch)&&in_array('LastUpdate',Helper::options()->footerswitch)):?>
<li><i class="fa fa-pencil-square-o likepost"></i>最后更新：<?php get_last_update();?></li><?php endif;?>
<?php if (!empty( Helper::options()->footerswitch ) && in_array('CountTime',Helper::options()->footerswitch)) :?>
<li id="usetime"><i class="fa fa-spinner likepost"></i>加载耗时：<?php echo timer_stop();?> </li><?php endif; ?>
<?php if (!empty( Helper::options()->footerswitch ) && in_array('CountRam',Helper::options()->footerswitch)) :?>
<li><i class="fa fa-ravelry likepost"></i>使用内存：<?php echo ramusage();?> </li> <?php endif; ?>
<?php if (!empty( Helper::options()->switchEnable ) && in_array('CountOnline',Helper::options()->switchEnable)) :?>
<li><i class="fa fa-line-chart likepost"></i>当前在线：<?php echo getOnline();?> 人</li><?php endif; ?>
</div>
</div>
<?php endif; ?>
<?php if(!empty($this->options->showad) && in_array('ShowSide', $this->options->showad) && isset($this->options->sidehb_img)):?>
<li class="sidehb"><a data-fancybox data-animation-duration="700" data-src="#animatedModal_Sidehb" href="javascript:;" class="sidehb_a" id="sidehb_a" title="<?php echo $this->options->sidealt; ?>"><i class="fa fa-rmb sidehb_i"></i></a></li>
<div style="display: none;" id="animatedModal_Sidehb" class="animated-modal">
 <h3 class="aliscan"><?php echo $this->options->sidealt; ?></h3>
 <div class="wxscanimg">
  <p class="wxloading">
    <a href="<?php echo $this->options->sideurl; ?>" target="_blank" title="<?php echo $this->options->sidealt; ?>">
     <img src="<?php echo __LAZYIMG__; ?>" data-src="<?php echo fullurl($this->options->sidehb_img,0); ?>" id="sidehbqr"/>
    </a>
  </p>
 </div>
<?php if(!empty($this->options->ismewechat)):?>
 <a data-fancybox data-animation-duration="700" data-src="#animatedModal3" href="javascript:;" id="tabali" class="thanks sidehb_b">红包提现</a>
<?php else:?>
 <h3 class="thanks sidehb_b">支付宝扫一扫</h3>
<?php endif;?>
</div>
<?php endif; ?>
</ul>
<?php if(!empty($this->options->ismewechat)):?>
	<div style="display: none;" id="animatedModal3" class="animated-modal">
	<h3 class="wxscan postqr">添加好友/加入微信群</h3>
		<div class="wxscanimg">
			<p class="wxloading">
				<img src="<?php echo __LAZYIMG__; ?>" data-src="<?php echo fullurl($this->options->ismewechat,0);?>" class="aboutme" id="groupqr">
			</p>
		</div>
	<h3 class="thanks">微信扫一扫</h3>
	</div>
<?php endif;?>
<div id="back-to-top" class="red" title="返回顶部" data-scroll="body">
    <svg id="point-up" version="1.1" xmlns="http://www.w3.org/2000/svg" xlink="http://www.w3.org/1999/xlink" width="48" height="48" viewBox="0 0 32 32">
        <path d="M23.588 17.637c-0.359-0.643-0.34-1.056-2.507-3.057 0.012-7.232-4.851-12.247-5.152-12.55 0-0.010 0-0.015 0-0.015s-0.003 0.003-0.007 0.007l-0.007-0.007c0 0 0 0.005 0 0.015-0.299 0.305-5.141 5.342-5.097 12.575-2.158 2.010-2.138 2.423-2.493 3.068-0.65 1.178-0.481 5.888 0.132 6.957 0.613 1.069 1.629 0.293 1.977-0.004 0.348-0.298 1.885-2.264 2.263-2.176 0 0 0.465-0.090 0.989 0.414 0.518 0.498 1.462 0.966 2.27 1.033 0 0.001 0 0.002-0 0.003 0.005-0.001 0.010-0.001 0.015-0.002 0.005 0 0.010 0.001 0.015 0.001 0-0.001-0-0.002 0-0.003 0.808-0.070 1.749-0.543 2.265-1.043 0.522-0.507 0.988-0.419 0.988-0.419 0.378-0.090 1.923 1.869 2.272 2.165 0.35 0.296 1.369 1.067 1.977-0.005 0.608-1.072 0.756-5.783 0.101-6.958v0 0zM15.95 14.86c-1.349 0.003-2.445-1.112-2.448-2.492-0.003-1.38 1.088-2.5 2.437-2.503 1.349-0.003 2.445 1.112 2.448 2.492 0.003 1.379-1.088 2.5-2.437 2.503v0 0zM17.76 24.876c-0.615 0.474-1.236 0.633-1.801 0.626-0.566 0.009-1.187-0.147-1.804-0.617-0.553-0.403-1.047-0.348-1.308 0.003-0.261 0.351-0.169 2.481 0.152 2.939 0.321 0.458 0.697-0.298 1.249-0.327 0.552-0.028 1.011 1.103 1.221 1.75 0.107 0.331 0.274 0.633 0.5 0.654 0.226-0.023 0.392-0.326 0.497-0.657 0.207-0.648 0.661-1.781 1.213-1.756 0.553 0.026 0.932 0.78 1.251 0.321 0.319-0.459 0.401-2.59 0.139-2.94-0.262-0.35-0.757-0.403-1.308 0.003v0 0z" fill="#CCCCCC"></path>
    </svg>
</div>
<!--<nocompress>-->
<script type="text/javascript">
window.__onece = <?php echo Typecho_Common::shuffleScriptVar($this->security->getToken($this->request->getRequestUrl())) ?>;
</script>
<!--</nocompress>-->
<?php if($this->options->commentsThreaded && $this->is('single')): ?>
<script type="text/javascript">
var __respondId = '<?php echo $this->respondId;?>';
  (function () {
      window.TypechoComment = {
          currentParent: null,
          dom : function (id) {
              return document.getElementById(id);
          },
      
          create : function (tag, attr) {
              var el = document.createElement(tag);
          
              for (var key in attr) {
                  el.setAttribute(key, attr[key]);
              }
          
              return el;
          },

          reply : function (cid, coid) {
              var comment = this.dom(cid), parent = comment.parentNode,
                  response = this.dom(__respondId), input = this.dom('comment-parent'),
                  form = 'form' == response.tagName ? response : response.getElementsByTagName('form')[0],
                  textarea = response.getElementsByTagName('textarea')[0];

              if (null == input) {
                  input = this.create('input', {
                      'type' : 'hidden',
                      'name' : 'parent',
                      'id'   : 'comment-parent'
                  });

                  form.appendChild(input);
              }

              input.setAttribute('value', coid);

              if (null == this.dom('comment-form-place-holder')) {
                  var holder = this.create('div', {
                      'id' : 'comment-form-place-holder'
                  });

                  response.parentNode.insertBefore(holder, response);
              }
              comment.insertBefore(response, this.dom('comment-clear-'+coid));
              this.dom('cancel-comment-reply-link').style.display = '';
              this.dom('comment-reply-'+coid).style.display = 'none';
              if(null!=this.currentParent){
                this.dom('comment-reply-'+this.currentParent).style.display = '';
              }
              this.currentParent = coid;
              if (null != textarea && 'text' == textarea.name) {
                  textarea.focus();
              }

              return false;
          },

          cancelReply : function () {
              var response = this.dom(__respondId),
              holder = this.dom('comment-form-place-holder'), input = this.dom('comment-parent');

              if (null != input) {
                  input.parentNode.removeChild(input);
              }

              if (null == holder) {
                  return true;
              }

              this.dom('cancel-comment-reply-link').style.display = 'none';
              if(null!=this.currentParent){
                this.dom('comment-reply-'+this.currentParent).style.display = '';
              }
              this.currentParent = null;
              holder.parentNode.insertBefore(response, holder);
              return false;
          }
      };
  })();
  <?php if ($this->options->commentsAntiSpam && $this->is('single')): ?>
  (function () {
      var event = document.addEventListener ? {
          add: 'addEventListener',
          triggers: ['scroll', 'mousemove', 'keyup', 'touchstart'],
          load: 'DOMContentLoaded'
      } : {
          add: 'attachEvent',
          triggers: ['onfocus', 'onmousemove', 'onkeyup', 'ontouchstart'],
          load: 'onload'
      }, added = false;

      var r = document.getElementById(__respondId),
          input = document.createElement('input');
      input.type = 'hidden';
      input.name = '_';
      input.value = window.__onece;

      if (null != r) {
          var forms = r.getElementsByTagName('form');
          if (forms.length > 0) {
              function append() {
                  if (!added) {
                      forms[0].appendChild(input);
                      added = true;
                  }
              }
          
              for (var i = 0; i < event.triggers.length; i ++) {
                  var trigger = event.triggers[i];
                  document[event.add](trigger, append);
                  window[event.add](trigger, append);
              }
          }
      }
  })();
  <?php endif;?>

  <?php if($replyId = $this->request->filter('int')->replyTo): ?>
    TypechoComment.reply('comment-<?php echo $replyId;?>', <?php echo $replyId;?>);
  <?php endif;?>
</script>
<?php endif;?>

</div> <!-- end #page-->
<script type="text/javascript" data-no-instant="true" src="//cdn.staticfile.org/jquery/3.3.1/jquery.min.js"></script>
<?php
  $this->footer();
  $switchEnablePjax = !empty($this->options->switchEnable) && in_array('enablePjax', $this->options->switchEnable);
  $switchEnablePlayer = !empty($this->options->switchEnable) && in_array('ShowMusicPlayer', $this->options->switchEnable);
?>
<?php if($switchEnablePjax):?><script type="text/javascript" data-no-instant="true" src="<?= THEME_URL ?>/js/instantclick.js"></script><?php endif; ?>
<script type="text/javascript" data-no-instant="true" src="<?= THEME_URL ?>/js/main.js"></script>  
<?php if (!empty( Helper::options()->switchEnable ) && in_array('GB2Site',Helper::options()->switchEnable)) :?>
<script type="text/javascript" data-no-instant="true" src="<?= THEME_URL ?>/js/gb2big5.js"></script>
<script type="text/javascript">
var gb2big5_Obj=document.getElementById("gb2big5");
if (gb2big5_Obj)
{
	var JF_cn="ft"+self.location.hostname.toString().replace(/\./g,"");
	var BodyIsFt=getCookie(JF_cn);
	if(BodyIsFt!="1") BodyIsFt=Default_isFT;
	with(gb2big5_Obj);
	{
		if(typeof(document.all)!="object")
		{
			href="javascript:StranBody()";
		}
		else
		{
			href="#";
			onclick= new Function("StranBody();return false");
		}
		title=StranText("繁体",1,1);
		//innerHTML=StranText(innerHTML,1,1);
	}
	if(BodyIsFt=="1"){setTimeout("StranBody()",StranIt_Delay);}
}  
</script>  
<?php endif; ?>
<script type="text/javascript" data-no-instant="true" src="<?= THEME_URL ?>/js/jquery.fancybox.min.js"></script>
<?php if($this->options->lazyimg == '1'):?>
<script type="text/javascript" data-no-instant="true" src="<?= THEME_URL ?>/js/blazy.min.js"></script>
<script type="text/javascript">
    +(function(){
        var blazy = new Blazy();
    })();
</script>
<?php endif;?>
<?php if($this->options->showtagtype):?>
<script type="text/javascript" data-no-instant="true" src="<?= THEME_URL ?>/js/jquery.tagcanvas.min.js"></script>
<script type="text/javascript">
 $(document).ready(function() {
   if( ! $('#myCanvas').tagcanvas({
     textColour : '#58666e',
     outlineThickness : 1,
     outlineColour: '#25b15e',
     outlineMethod: 'colour',
     reverse: true,
     textHeight : 13 ,
     maxSpeed : 0.03,
     depth : 0.75,
     minTags:40,
     outlineRadius:5
   })) {
     $('#myCanvasContainer').hide();
   }
 });
</script>
<?php endif; ?>
<?php if($this->options->nightmode):?>
<script type="text/javascript"  data-no-instant="true" src="<?= THEME_URL ?>/js/nightmode.js"></script>
<?php if($this->options->nightmode == '2'){echo autoNight();} ?>
<script type="text/javascript">
$(function() {
    if (Cookies.get('tmode') == 'dark') {
        $(".post-box,.widget-box,#about-card-list,.article-box,.article-box .links ul li,#article-index,.response-form,.select-comment,.article-extend").each(function(){$(this).addClass("darkindexback");});
        document.body.style.backgroundColor="#2e3131";
	document.getElementById("page").classList.add("darkpage");
//        document.getElementById("tmode-btn").innerHTML = "日";
	$("#nightmode-btn").attr("title","正常模式");
	document.getElementById("tmode-btn").classList.remove("fa-moon-o");
	document.getElementById("tmode-btn").classList.add("fa-sun-o");
    }
});
</script> 
<?php endif;?>
<?php if (!empty( Helper::options()->switch ) && in_array('TypeColorful',Helper::options()->switch)) :?>
<script type="text/javascript" data-no-instant="true" src="<?= THEME_URL ?>/js/commentTyping.js"></script>
<?php endif;?>
<?php if (!empty( Helper::options()->switchEnable ) && in_array('AutoScroll',Helper::options()->switchEnable)) :?>
<script type="text/javascript" data-no-instant="true">
var t=0;
window.ondblclick=function(){
  if(t){
    clearInterval(t);
    t=0;
  }else{
    t=setInterval(function(){
       scrollBy(0,<?php if(Helper::options()->scrollpix){ echo Helper::options()->scrollpix;}else{echo '1';} ?>);
    },<?php if(Helper::options()->scrolltime){ echo Helper::options()->scrolltime;} else{echo '50';} ?>);
  }
}
</script>
<?php endif;?>
<?php if ( !in_array('enablePjax',Helper::options()->switchEnable) && in_array('EnableNotice',Helper::options()->switchEnable)) :?>
<?php welcome_hello();?>
<?php endif;?>
<?php if (!empty( Helper::options()->switchEnable ) && in_array('EnableCopyright',Helper::options()->switchEnable)) :?>
<script type="text/javascript">
document.body.oncopy=function(){ArmMessage.warn('复制成功！引用转载请保留原文链接，谢谢！');}
//if (document.location.href != "<?php echo Helper::options()->siteUrl;?>") {location.href = location.href.replace(document.location.href,'<?php echo Helper::options()->siteUrl;?>');}
//console.log(document.location.href);
</script> 
<?php endif;?>
<script type="text/javascript" charset="UTF-8" src="<?= THEME_URL ?>/js/script.js"></script>
<?php if (isset($_SERVER['HTTP_USER_AGENT']) && !strpos(getBR($_SERVER['HTTP_USER_AGENT'],0),'Internet Explorer')): ?>
<script type="text/javascript" src="<?= THEME_URL ?>/js/voice.fix.js"></script>
<?php endif;?>

<!--<nocompress>-->
<script type="text/javascript" data-no-instant="true">
<?php if( $switchEnablePjax ):?>
/**
 * InstantClick
 */
if(InstantClick && InstantClick.supported){
	InstantClick.expire(43200*1000); // 设置缓存时间12h
	InstantClick.content('page');
	InstantClick.on('change', function(init){ //页面已更改
		if(!init){
			if (typeof _hmt !== 'undefined'){
				_hmt.push(['_trackPageview', location.pathname + location.search]);
			}
			<?php if(!empty($this->options->analysis) && $this->options->analysistype){
				echo "window.dataLayer = window.dataLayer || [];
					function gtag(){dataLayer.push(arguments);}
					gtag('js', new Date());
					gtag('config', '".$this->options->analysis."');";
			}?>
			pageInit();
			NProgress.done(); 
			var url = window.location.href;
                	if(url.indexOf("comment")>-1 ){
                        	$('html,body').animate({scrollTop: $('#comments').offset().top /*+ Ch*/ }, 500);
                        }
			if(typeof Blazy != 'undefined' && Blazy instanceof Function){
				$(document).ready(function(){
					var blazy = new Blazy();
				});
			}
		}
	});
	InstantClick.on('wait', function(){  //点击链接但未加载
		NProgress.start();
		NProgress.inc();
		<?php if ($this->options->text2speech && isset($_SERVER['HTTP_USER_AGENT'])):?>
			if (typeof speechList != 'undefined' && speechList.length) {
				var speech = speechList[speechIndex]; 
					if (!speech.paused) {
						speech.pause();
					}
				}
		<?php endif;?>
	});
//	InstantClick.on('receive',function(url){  //页面已预加载
//	url
//	body
//	title
//	});
//	InstantClick.on('fetch',function(url){  //页面开始预加载
//	});
	InstantClick.init('mousedown');
}
<?php endif;?>
pageInit();
<?php if (isset($_SERVER['HTTP_USER_AGENT']) && strpos(getBR($_SERVER['HTTP_USER_AGENT'],0),'Internet Explorer') && $this->options->lazyimg == '1'): ?>
Blazy();
<?php endif;?>
</script>
<!--欢迎使用本主题！主题名：Armx Mod for Typecho，作者：欧文斯，网站：https://vircloud.net/-->
<!--</nocompress>-->
</body>
</html>
<?php if (!empty( Helper::options()->switchEnable ) && in_array('EnableCompression',Helper::options()->switchEnable)){
  $html_source = ob_get_contents();
  ob_clean();
  print compressHtml($html_source);
  ob_end_flush();
  }
?>
