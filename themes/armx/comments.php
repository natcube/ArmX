<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div id="comments">

<?php if($this->options->isyiyan == '1' && $this->is('post')): ?>
    <h3 class="box-label"><span class="label-left"></span><span class="box-name">发现共鸣</span></h3>
    <div class="post-yiyan card">
      <span class="text-muted letterspacing indexWords"><?php echo getYiyan();?></span>
    </div>
<?php endif;?>

<?php $this->comments('comment')->to($comments); ?>
    <?php if($this->allow('comment') && !$this->is('attachment')): ?>
<?php if(allowcomment()):?>
    
    <div id="<?php $this->respondId(); ?>" class="respond">
        <div class="cancel-comment-reply">
            <a id="cancel-comment-reply-link" data-href="<?php echo $this->parameter->parentContent['permalink'] . '#' . $this->parameter->respondId;?>" rel="nofollow" style="display:none;" onclick="return TypechoComment.cancelReply();">取消回复</a>
        </div>
    
        <h3 id="response" class="box-label"><span class="label-left"></span><span class="box-name">发表评论</span></h3>
        <div class="card response-form emoji">
        <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
            <?php if($this->user->hasLogin()): ?>
            <div class="form-item form-loginfo">欢迎您，<a target="_blank" data-no-instant href="<?php $this->options->profileUrl(); ?>" rel="nofollow"><?php $this->user->screenName(); ?></a>，<a data-no-instant href="<?php $this->options->logoutUrl(); ?>" title="退出登录" rel="nofollow"><i class="fa fa-sign-out"></i></a></div>
            <?php else: ?>
           <div id="form-user" class="<?php if ($this->remember('author', true)): ?> form-item-hide<?php endif; ?>">
             <div class="form-item">
                 <label for="comment-author">昵称：</label><input type="text" name="author" placeholder="*" id="comment-author" class="text" value="<?php $this->remember('author'); ?>" required />
             </div>
             <div class="form-item">
                 <label for="comment-mail">邮箱：</label><input type="email" placeholder="*" name="mail" id="mail" class="text" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> />
             </div>
             <div class="form-item">
              <label for="comment-url">网址：</label><input id="url" class="text" name="url" type="url" value="<?php $this->remember('url'); ?>" placeholder="" />
             </div>
           </div>
           <?php endif; ?>
           <?php if ($this->remember('author', true)&&!$this->user->hasLogin()): ?>
              <div class="form-item form-loginfo">
                  将以 <a id="form-user-edit" href="###" title="更改身份信息"><?php $this->remember('author'); ?></a> 的身份发表评论：
              </div>
           <?php endif; ?>
           <div class="form-item form-textarea">
               <div><textarea rows="8" placeholder="<?php if($this->options->commentsRequireModeration && !$this->user->hasLogin()){ echo "（已开启评论审核模式，发表后不会立即显示）

";}?><?php if($this->options->inputyiyan == '1') {echo getYiyan();} else{echo $this->options->defaultcomment;}?>" name="text" id="comment-text" class="textarea" required ><?php $this->remember('text'); ?></textarea>
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
            <a class="submit action-btn" data-action="form.submit@comment-form:comment" href="javascript:;" id="submit">发表</a>
        </form>
        </div>
    </div>
    <?php else: ?>
   <!-- <h3><?php _e('暂停评论'); ?></h3>-->
<?php endif; ?>
<?php endif; ?>
    <?php if ($comments->have()): ?>
<div class="box">
	<h3 class="box-label"><span class="label-left"></span><span class="box-name"><?php $this->commentsNum(_t('精选评论'), _t('精选评论'), _t('精选评论')); ?></span></h3>
    <div class="card select-comment">
    <?php $comments->listComments(); ?>
    <?php $comments->pageNav('上一页', '下一页', 1); ?>
    </div>
</div>
    <?php endif; ?>
</div>
