<?php if(!defined('__TYPECHO_ROOT_DIR__')) exit();?>
<?php $this->need('header.php'); ?>

    <section id="content">
        <div class="post">
			<div class="post_title">
				<h2 class="title"><a href="<?php $this->permalink() ?>" rel="bookmark"><?php $this->title() ?></a></h2>
			</div>			
			<div class="post_entry clearfix">
			<?php $this->content(); ?>
			</div>
		</div>

		<?php $this->need('comments.php'); ?>
    </section><!-- end #content-->
	<?php $this->need('sidebar.php'); ?>
	<?php $this->need('footer.php'); ?>
