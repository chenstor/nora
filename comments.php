<?php if(!defined('__TYPECHO_ROOT_DIR__')) exit();?>
<?php 
	function threadedComments($comments, $singleCommentOptions) {
		$commentClass = '';
		if ($comments->authorId) {
			if ($comments->authorId == $comments->ownerId) {
				$commentClass .= ' comment-by-author';  //如果是文章作者的评论添加 .comment-by-author 样式
			} else {
				$commentClass .= ' comment-by-user';  //如果是评论作者的添加 .comment-by-user 样式
			}
		} 
		$commentLevelClass = $comments->_levels > 0 ? ' comment-child' : ' comment-parent';  //评论层数大于0为子级，否则是父级
?> 
<li data-no-instant itemscope id="<?php $comments->theId(); ?>" class="comment-body<?php
    if ($comments->levels > 0) {echo ' comment-child';$comments->levelsAlt(' comment-level-odd', ' comment-level-even');}
	else {echo ' comment-parent';}
    $comments->alt(' comment-odd', ' comment-even');
    echo $commentClass;?>">
    <div class="comment-author" itemscope itemprop="creator"><span class="comment-reply"><?php $comments->reply($singleCommentOptions->replyWord); ?></span><span itemprop="image"><?php $comments->gravatar($singleCommentOptions->avatarSize, $singleCommentOptions->defaultAvatar); ?></span><cite class="fn" itemprop="name"><?php $comments->author();?></cite></div><div class="comment-meta"><a href="<?php $comments->permalink(); ?>"><time itemprop="commentTime" datetime="<?php $comments->date('c'); ?>"><?php $comments->date('Y-m-d H:i'); ?></time></a><?php if ('waiting' == $comments->status){ ?><em class="comment-awaiting-moderation"><?php $singleCommentOptions->commentStatus(); ?></em><?php } ?></div>
	<?php if($comments->parent > 0):?><div class="comment-content" itemprop="commentText" parentid="comment-<?php $comments->parent()?>"><?php else:?><div class="comment-content" itemprop="commentText"><?php endif;?><?php $comments->content(); ?></div>
	<?php if ($comments->children){?><div class="comment-children" itemprop="discusses"><?php $comments->threadedComments($singleCommentOptions); ?></div><?php } ?>
</li><?php } ?>

<div id="comments">
<?php $this->comments()->to($comments); ?>
	<?php if ($comments->have()): ?>
	<h4><span><?php $this->commentsNum(_t('当前暂无评论'), _t('仅有 1 条评论'), _t('已有 %d 条评论')); ?></span></h4>
    <?php $comments->pageNav(); ?>            
    <?php $comments->listComments(); ?>	
	<?php endif; ?>	
	<?php if($this->allow('comment')): ?>
	<div id="<?php $this->respondId(); ?>" class="respond">            
	<div class="cancel-comment-reply"><?php $comments->cancelReply(); ?></div>            
	<h4 id="response"><span><?php _e('添加新评论'); ?></span></h4>
	<form method="post" action="<?php $this->commentUrl() ?>" id="comment_form" name="comment_form">                
		<?php if($this->user->hasLogin()):?>
		<p>欢迎管理员 <a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a> 回来~~ <a href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?> &raquo;</a></p>
		<?php else: ?>
			<p class="title welcome">您好，<span class="we" id="comment-change-name">#请填信息#</span>！<span class="edit_author" id="comment-change">修改</span></p>
			<div class="author_info">
			<div class="iform"><i class="iconfont icon-author"></i><label for="author"><input type="text" name="author" id="author" class="text" size="15" value="<?php if(isset($_COOKIE['itlu_author'])){echo urldecode($_COOKIE['itlu_author']);}?>" placeholder="您的昵称" tabindex="1" /></label></div>
			<div class="iform"><i class="iconfont icon-email"></i><label for="mail"><input type="text" name="mail" id="mail" class="text" size="15" value="<?php if(isset($_COOKIE['itlu_mail'])){echo urldecode($_COOKIE['itlu_mail']);}?>" placeholder="您的邮箱" tabindex="2" /></label></div>
			<div class="iform"><i class="iconfont icon-url"></i><input type="text" name="url" id="url" class="text" size="15" value="<?php if(isset($_COOKIE['itlu_url'])){echo urldecode($_COOKIE['itlu_url']);}?>" placeholder="您的网站" tabindex="3" /></div>
			</div>
		<?php endif; ?>
		<div><?php Smilies_Plugin::output(); ?></div>
		<div>
		<textarea rows="5" cols="50" name="text" class="textarea" id="comment" tabindex="4" placeholder="评论有缓存，无需多次提交..."><?php $this->remember('text'); ?></textarea><!--//input end-->
		</div>
		<div><input type="submit" value="提交评论（Ctrl+Enter）" class="submit" id="misubmit" tabindex="5" /></div>
	</form>
	</div>
<script type="text/javascript" data-no-track>
(function () {window.TypechoComment = {dom : function (id) {return document.getElementById(id);},create : function (tag, attr) {var el = document.createElement(tag);for (var key in attr) {el.setAttribute(key, attr[key]);}return el;},reply : function (cid, coid) {var comment = this.dom(cid), parent = comment.parentNode,response = this.dom('<?php echo $this->respondId(); ?>'), input = this.dom('comment-parent'),form = 'form' == response.tagName ? response : response.getElementsByTagName('form')[0],textarea = response.getElementsByTagName('textarea')[0];if (null == input){input = this.create('input', {'type':'hidden','name':'parent','id':'comment-parent'});form.appendChild(input);}input.setAttribute('value', coid);if (null == this.dom('comment-form-place-holder')) {var holder = this.create('div', {'id' : 'comment-form-place-holder'});response.parentNode.insertBefore(holder, response);}comment.appendChild(response);this.dom('cancel-comment-reply-link').style.display = '';if (null != textarea && 'text' == textarea.name) {textarea.focus();}return false;},cancelReply : function () {var response = this.dom('<?php echo $this->respondId(); ?>'),holder = this.dom('comment-form-place-holder'), input = this.dom('comment-parent');if (null != input) {input.parentNode.removeChild(input);}if (null == holder) {return true;}this.dom('cancel-comment-reply-link').style.display = 'none';holder.parentNode.insertBefore(response, holder);return false;}};})();</script>
<?php else: ?>
<!--关闭评论不输出任何东西-->
<?php endif; ?>
</div>