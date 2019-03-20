<?php if(!defined('__TYPECHO_ROOT_DIR__')) exit();?>
<aside id="sidebar">
	<?php if($this->options->sidebarAD):?><!--有内容时才显示-->
	<div class="widget"><div style="padding-top:3px;"><?php $this->options->sidebarAD(); ?></div></div>
	<?php endif;?>
	
	<?php if(!$this->is('page')): ?>
	<div class="widget">
		<h4><span>最新评论</span></h4>
		<ul class="commentlist"><?php $this->widget('Widget_Comments_Recent','pageSize=8&ignoreAuthor=true')->to($comments); ?>
		<?php while($comments->next()):?><li><?php $comments->gravatar('32','');?><strong><?php $comments->author(false);?><span><a href="<?php $comments->permalink();?>"><?php $comments->date('n-d H:i'); ?></a></span></strong>
			<a href="<?php $comments->permalink();?>" title='<?php $comments->title();?> 的评论'>
			<?php
			if(preg_match("/[\x7f-\xff]/", $comments->text)){ 
				$comments->excerpt(34, '...'); 				
			}else{
				$comments->content();
			}
			?></a></li><?php endwhile; ?>
		</ul>
	</div>
	<?php endif; ?>
	
	<div class="widget">
		<h4 class="s_tit"><i>热评文章</i><i>热门文章</i><i>随机文章</i></h4>
		<div class="s_con">
		<ul class="hotlist"><?php theMostCommented(); ?></ul>
		<ul class="hotlist"><?php theMostViewed(); ?></ul>
		<ul class="postlist"><?php theRandom(); ?></ul>
		</div>
	</div>	

	<?php if($this->is('index')): ?>
	<div class="widget">
		<h4><span>友情链接</span></h4>
		<ul class="linklist">
			<?php if ($this->is('index')):?>
			<?php Links_Plugin::output("SHOW_TEXT", 0, "index"); ?>
			<?php Links_Plugin::output("SHOW_TEXT", 0, "sell_index"); ?>
			<?php endif; ?>
			<?php Links_Plugin::output("SHOW_TEXT", 0, "all"); ?>
			<?php Links_Plugin::output("SHOW_TEXT", 0, "sell_all"); ?>
			<li><i class="iconfont icon-friend"></i><a href="/links/" target="_blank" title="查看更多链接">更多链接</a></li>
		</ul><div class="clear"></div>
	</div>
	<?php endif; ?>

	<?php if ($this->is('index') || $this->is('post')): ?>
	<div id="scroll_itlu">	
	<div class="widget">
		<h4><span>标签云</span></h4>
		<ul><div class="m_tags"><?php 
		$this->widget('Widget_Metas_Tag_Cloud', array('sort' => 'count', 'ignoreZeroCount' => true, 'desc' => true, 'limit' => 22))->parse('<a href="{permalink}">{name} ({count})</a>');?></div></ul>
	</div>
	<div class="widget">		
		<?php if($this->options->sidebarADFoot):?><!--有内容时才显示-->
		<div id="bar_top"><?php $this->options->sidebarADFoot(); ?></div>
		<?php endif;?>
	</div>
	</div>	
	<?php endif; ?>
</aside><!-- end #sidebar -->