<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div id="comments">
    <?php $this->comments()->to($comments); ?>
    <?php if($this->allow('comment')): ?>
    <div id="<?php $this->respondId(); ?>" class="respond">
        <div class="cancel-comment-reply">
            <a id="cancel-comment-reply-link" data-href="<?php echo $this->parameter->parentContent['permalink'] . '#' . $this->parameter->respondId;?>" rel="nofollow" style="display:none;" onclick="return TypechoComment.cancelReply();">取消回复</a>
        </div>
    
        <h3 id="response" class="box-label"><span class="label-left"></span><span class="box-name">发表评论</span></h3>
        <div class="card response-form">
        <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
            <?php if($this->user->hasLogin()): ?>
            <div class="form-item form-loginfo"><a target="_blank" data-no-instant href="<?php $this->options->profileUrl(); ?>"><?php echo '<img class="user-avatar" src="' . Typecho_Common::gravatarUrl($this->user->mail, 36, 'X', 'mm', $this->request->isSecure()) . '" alt="' . $this->user->screenName . '" />'; ?><?php $this->user->screenName(); ?></a> <a href="javascript:;" data-action="logout" title="Logout">退出 &raquo;</a></div>
            <?php else: ?>
            <div class="form-item">
                <input type="text" name="author" placeholder="请输入昵称" id="comment-author" class="text" value="<?php $this->remember('author'); ?>" required /><label for="comment-author">昵称*</label>
            </div>
            <div class="form-item">
                <input type="email" placeholder="请输入邮箱" name="mail" id="mail" class="text" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> /><label for="comment-mail">邮箱*</label>
            </div>
            <?php endif; ?>
            <div class="form-item form-textarea">
                <div><textarea rows="8" placeholder="评论内容" name="text" id="comment-text" class="textarea" required ><?php $this->remember('text'); ?></textarea></div>
            </div>
            <a class="submit action-btn" data-action="form.submit@comment-form:comment" href="javascript:;">发表评论</a>
        </form>
        </div>
    </div>
    <?php else: ?>
    <h3><?php _e('评论已关闭'); ?></h3>
    <?php endif; ?>
    <?php if ($comments->have()): ?>
<div class="box">
	<h3 class="box-label"><span class="label-left"></span><span class="box-name"><?php $this->commentsNum(_t('暂无评论'), _t('仅有一条评论'), _t('已有 %d 条评论')); ?></span></h3>
    <div class="card">
    <?php $comments->listComments(); ?>
    <?php $comments->pageNav('上一页', '下一页'); ?>
    </div>
</div>
    <?php endif; ?>
</div>
