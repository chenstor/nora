<?php
if(!defined('__TYPECHO_ROOT_DIR__')) exit();
/**
 * tagclond
 * 
 * @package custom
 */
$this->need('header.php');
?>
<section id="content">
	<div class="post">
		<div class="post_title">
			<div class="p_tit">
				<h2 class="title"><a href="<?php $this->permalink() ?>" rel="bookmark"><?php $this->title() ?></a></h2>
			</div>			
		</div>
		<div class="tagpage">				 
			<?php $this->widget('Widget_Metas_Tag_Cloud', 'ignoreZeroCount=true&desc=true&limit=600')->to($tags); ?>
			<?php while($tags->next()): ?>
			<a href="<?php $tags->permalink(); ?>" class="tagsize-<?php $tags->split(5, 10, 20, 30); ?>" title="<?php $tags->count(); ?> 个相关"><?php $tags->name(); ?></a>
			<?php endwhile; ?>
		</div>
	</div>
</section><!-- end #content-->
<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>