<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit();
/**
 * guestbook
 * 
 * @package custom
 */
$this->need('header.php');
?>
    <div id="content">
        <div class="post">
			<div class="post_title">
				<h2 class="title"><a href="<?php $this->permalink() ?>" rel="bookmark"><?php $this->title() ?></a></h2>
			</div>
			<div class="post_entry clearfix">
			<?php $this->content(); ?>
			</div>

			<div class="wall_content clearfix">
			<h3>读者墙(最近180天)</h3>
			<ul>				
				<?php getFriendWall(); ?>
			</ul>
			</div>
		</div>

		<?php $this->need('comments.php'); ?>
    </div><!-- end #content-->
	<?php $this->need('sidebar.php'); ?>
	<?php $this->need('footer.php'); ?>