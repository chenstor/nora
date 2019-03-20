<?php if(!defined('__TYPECHO_ROOT_DIR__')) exit();?>
<?php $this->need('header.php'); ?>
<section id="content">
	<div class="home"><i class="iconfont icon-home"></i><a href="<?php $this->options->siteUrl(); ?>">网站首页</a> &raquo; <?php $this->category();?> &raquo; <?php $this->title();?></div>
	<div class="post">
		<div class="post_title">
			<h2 class="title"><?php $this->title() ?></h2><div class="title_info"><span class="time"><i class="iconfont icon-data"></i><a href="//itlu.org/<?php $this->date('Y/m/'); ?>" title="<?php $this->date('Y-m-d'); ?>"><?php $this->dateWord();?></a></span><span class="cate"><i class="iconfont icon-category"></i><?php $this->category(','); ?></span><span class="views"><i class="iconfont icon-view"></i><?php theViews(); ?></span><span class="com"><i class="iconfont icon-comment"></i><a href="#response" class="smooth" title="我也来一发评论"><?php $this->commentsNum('暂无', '1条', '%d条'); ?>（来一发）</a></span></div>
		</div>
		<div class="post_entry clearfix">
			<div class="content" id="main">
				<?php echo $str = str_replace("src=","src='/usr/themes/nora/images/thumb.png' data-original=",$this->content); ?>
			</div>
			<div class="reward">
				<span class="repay">赏</span>
				<div class="window" style="display:none;"><ul id="repay-show"></ul></div>
			</div>			
			<div class="post_end">
				<p class="tag">查看 <?php $this->tags(' ', true, 'none'); ?>的相关文章</p>
				<p>转载本站原创文章请注明：文章转自 <a href="https://itlu.org/">挨踢路</a>，链接: <a href="<?php $this->permalink(); ?>"><?php $this->permalink(); ?></a></p>
			</div>
		</div>
	</div>
	
	<div class="navigation">
		<div class="prev"><span>&laquo;</span> <?php $this->thePrev('%s','已是最早一篇'); ?></div>
		<div class="next"><?php $this->theNext('%s','还没出炉呢'); ?> <span>&raquo;</span></div>				
	</div>
	
	<?php $this->related(8)->to($relatedPosts); ?>
	<?php if ($relatedPosts->have()): ?>
		<div class="relatedpost"><h3><span>相关文章</span></h3>		
		<ul>
		<?php while($relatedPosts->next()):?><li><i class="iconfont icon-article2"></i><a href="<?php $relatedPosts->permalink(); ?>" title="<?php $relatedPosts->title(); ?>"><?php $relatedPosts->title(); ?></a> <span>(<?php $relatedPosts->date('Y-m-j'); ?>)</span></li>
		<?php endwhile;?>
		</ul>
	</div>
	<?php endif; ?>

	<?php $this->need('comments.php'); ?>
</section><!-- end #content-->
<?php $this->need('sidebar.php'); ?>	
<?php $this->need('footer.php'); ?>