<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div id="comments">
    <?php $this->comments()->to($comments); ?>
    
   
     <div id="<?php $this->respondId(); ?>" class="respond">
     <div class="cancel-comment-reply">
            <a id="cancel-comment-reply-link" data-href="<?php echo $this->parameter->parentContent['permalink'] . '#' . $this->parameter->respondId;?>" rel="nofollow" style="display:none;" onclick="return TypechoComment.cancelReply();">取消回复</a>
     </div>
        <div class="card-say response-form emoji">
         <?php if($this->user->hasLogin()): ?>
        <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
            <div class="form-item form-loginfo">
        <?php $time= date("H",time()+($this->options->timezone - idate("Z")));
          if($time>=6 && $time<=11){
          	echo "早上好";
          }elseif($time>=12 && $time<=17){
          	echo "下午好";
          }else{
          	echo "晚上好";
          }
        ?>，<a target="_blank" data-no-instant="true" href="<?php $this->options->profileUrl(); ?>" rel="nofollow"><?php $this->user->screenName(); ?></a>！今天想要分享什么呢？</div>
           <div class="form-item form-textarea">
               <div><textarea rows="8" placeholder="眼见何事，情系何处，身在何方，心思何人？" name="text" id="comment-text" class="textarea" required ><?php $this->remember('text'); ?></textarea>
           </div>
           </div>     
           <div class="form-emoji" id="form-emoji">
             <button id="smilies" class="smiles" type="button">
		<i class="fa fa-smile-o"></i>
	     </button>
<div class="smilies-list" id="smilies-list">
<div class="smiles-sidebar" style="display:none" id="smiles-sidebar">
	<div class="smiles-widget smiles-widget-tab" id="smiles-widget">
		<input type="radio" name="smiles-widget-tab" id="new" checked="checked"/>
		<input type="radio" name="smiles-widget-tab" id="hot"/>
		<input type="radio" name="smiles-widget-tab" id="random"/>
		<div class="smiles-widget-title smiles-inline-ul">
			<ul>
				<li class="smiles-new" id="qqs">
					<label for="new">QQ</label>
				</li>
				<li class="smiles-hot">
					<label for="hot">颜文字</label>
				</li>
				<li class="smiles-random" id="alus">
					<label for="random">阿鲁</label>
				</li>
			</ul>
		</div>
		<div class="smiles-widget-box">
			<ul class="new-list">
				<li>
					<?php echo outputsilies(0);?>
					<?php echo outputsilies(2);?>
				</li>
			</ul>
    <ul class="hot-list">
      <li class="yanwenzi"><a href="javascript:grin('OωO')" title="DIYgod">OωO</a></li>
      <li class="yanwenzi"><a href="javascript:grin('|´・ω・)ノ')" title="Hi">|´・ω・)ノ</a></li>
      <li class="yanwenzi"> <a href="javascript:grin('ヾ(≧∇≦*)ゝ')" title="开心">ヾ(≧∇≦*)ゝ</a></li>
      <li class="yanwenzi"><a href="javascript:grin('(☆ω☆)')" title="星星眼">(☆ω☆)</a></li>
      <li class="yanwenzi"><a href="javascript:grin('￣﹃￣')" title="流口水">￣﹃￣</a></li>
      <li class="yanwenzi"><a href="javascript:grin('(/ω＼)')" title="捂脸">(/ω＼)</a></li>
      <li class="yanwenzi"><a href="javascript:grin('∠( ᐛ 」∠＿')" title="给跪">∠( ᐛ 」∠)＿</a></li>
      <li class="yanwenzi"><a href="javascript:grin('(๑•̀ㅁ•́ฅ)')" title="Hi">(๑•̀ㅁ•́ฅ)</a></li>
      <li class="yanwenzi"><a href="javascript:grin('→_→')" title="斜眼">→_→</a></li>
      <li class="yanwenzi"><a href="javascript:grin('୧(๑•̀⌄•́๑)૭')" title="加油">୧(๑•̀⌄•́๑)૭</a></li>
      <li class="yanwenzi"><a href="javascript:grin('٩(ˊᗜˋ*)و')" title="有木有WiFi">٩(ˊᗜˋ*)و</a></li>
      <li class="yanwenzi"><a href="javascript:grin('(ノ°ο°)ノ')" title="前方高能预警">(ノ°ο°)ノ</a></li>
      <li class="yanwenzi"><a href="javascript:grin('⌇●﹏●⌇')" title="吓死宝宝惹">⌇●﹏●⌇</a></li>
      <li class="yanwenzi"><a href="javascript:grin('(ฅ´ω`ฅ)')" title="已阅留爪">(ฅ´ω`ฅ)</a></li>
      <li class="yanwenzi"><a href="javascript:grin('(╯°A°)╯︵○○○')" title="去吧大师球">(╯°A°)╯︵○○○</a></li>
      <li class="yanwenzi"><a href="javascript:grin('φ(￣∇￣o)')" title="太萌惹">φ(￣∇￣o)</a></li>
      <li class="yanwenzi"><a href="javascript:grin('ヾ(´･ ･｀｡)ノ')" title="咦咦咦">ヾ(´･ ･｀｡)ノ</a></li>
      <li class="yanwenzi"><a href="javascript:grin('(ó﹏ò｡)')" title="我受到了惊吓">(ó﹏ò｡)</a></li>
      <li class="yanwenzi"><a href="javascript:grin('Σ(っ °Д °;)っ')" title="什么鬼">Σ(っ °Д °;)っ</a></li>
      <li class="yanwenzi"><a href="javascript:grin('╮(╯▽╰)╭ ')" title="无奈">╮(╯▽╰)╭ </a></li>
      <li class="yanwenzi"><a href="javascript:grin('＞﹏＜')" title="难受">＞﹏＜</a></li>
      <li class="yanwenzi"><a href="javascript:grin('(๑•̀ㅂ•́)و✧')" title="棒">(๑•̀ㅂ•́)و✧</a></li>
    </ul>
			<ul class="random-list">
				<li>
					<?php echo outputsilies(1);?>
				</li>
			</ul>
		</div>
	</div>
</div>
</div>  

           </div> 
           <a class="submit action-btn" data-action="form.submit@comment-form:comment" href="javascript:;">发表</a>            
        </form>
<hr class="saying-hr">
        <?php endif; ?>
        </div>
     </div>
    
    <?php if ($comments->have()): ?>
     <?php $comments->listComments(); ?>
     <?php $comments->pageNav('上一页', '下一页'); ?>
    <?php endif; ?>
</div>

