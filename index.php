<?php
if(!defined('__TYPECHO_ROOT_DIR__')) exit();
/**
 * Typecho Nora模板
 * 
 * @package Nora Theme 
 * @author itlu
 * @version 2018.12
 * @link https://itlu.org
 */
$this->need('header.php');
?>
<section id="content">
<?php while($this->next()): ?>
	<article class="post">
		<div class="post_title">
		<h2 class="title"><a href="<?php $this->permalink() ?>" rel="bookmark"><?php $this->title() ?></a></h2>
		<div class="title_info"><span class="time"><i class="iconfont icon-data"></i><a href="<?php $this->date('Y/m/'); ?>" title="<?php $this->date('Y-m-d'); ?>"><?php $this->dateWord();?></a></span><span class="author"><i class="iconfont icon-author"></i><a href="/"><?php $this->author(); ?></a></span><span class="cate"><i class="iconfont icon-category"></i><?php $this->category(','); ?></span><span class="views"><i class="iconfont icon-view"></i><?php Views_Plugin::theViews(); ?></span><span class="com"><i class="iconfont icon-comment"></i><a href="<?php $this->permalink();?>#comments"><?php $this->commentsNum('暂无', '1条', '%d条'); ?></a></span></div>
		</div>		
		<div class="post_entry clearfix">		
			<a href="<?php $this->permalink();?>" title="<?php $this->title() ?>"><img class="thumbnail" src="//itlu.org/index/thumb.png" data-original="<?php show_first_img($this);?><?php $this->options->fileext(); ?>" /></a>
			<div class="art-content"><?php $this->excerpt(172, '...'); ?>
			<div class="art-tags"><a href="<?php $this->permalink();?>" class="rd_more" rel="bookmark" title="阅读『<?php $this->title(); ?>』全文">阅读全文</a><span><?php $this->tags('  ', true, 'none'); ?></span></div>
			</div>
		</div>
	</article>
<?php endwhile; ?>
<?php $this->pageNav('上一页','下一页',3,'...');?>
</section><!-- end #content-->	
<?php $this->need('sidebar.php'); ?>	
<?php $this->need('footer.php'); ?>
