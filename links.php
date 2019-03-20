<?php
if(!defined('__TYPECHO_ROOT_DIR__')) exit();
/**
 * links
 * 
 * @package custom
 */
$this->need('header.php');
?>
    <section id="content">
        <div class="post">
			<div class="post_title">
				<h2 class="title"><a href="<?php $this->permalink() ?>" rel="bookmark"><?php $this->title() ?></a></h2>
			</div>
			<div class="post_entry clearfix">
			<?php $this->content(); ?>
			</div>

			<div class="link_content clearfix">
			<h3>首页链接</h3>
			<ul>				
				<?php Links_Plugin::output("SHOW_TEXT", 0, "index"); ?>
				<?php Links_Plugin::output("SHOW_TEXT", 0, "all"); ?>
			</ul>
			<div class="clearfix"></div>
			
			<h3>内页链接</h3>
			<ul>				
				<?php Links_Plugin::output("SHOW_TEXT", 0, "page"); ?>
			</ul>
			<div class="clearfix"></div>

			<h3>我的爷</h3>
			<ul>				
				<?php Links_Plugin::output("SHOW_TEXT", 0, "sell_all"); ?>
				<?php Links_Plugin::output("SHOW_TEXT", 0, "sell_index"); ?>
			</ul>
			<div class="clearfix"></div>

			<h3>我的收藏</h3>
			<ul>				
				<?php Links_Plugin::output("SHOW_TEXT", 0, "fav"); ?>
			</ul>
			<div class="clearfix"></div>
			</div>
		</div>
    </section><!-- end #content-->
	<?php $this->need('sidebar.php'); ?>
	<?php $this->need('footer.php'); ?>