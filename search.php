<?php if(!defined('__TYPECHO_ROOT_DIR__')) exit();?>
<?php $this->need('header.php');?>
    <section id="content">
		<div class="home"><i class="iconfont icon-home"></i><a href="<?php $this->options->siteUrl(); ?>">网站首页</a> &raquo; 
		<?php $this->archiveTitle('','搜索<span>','</span>的文章');?></div>
    <?php if ($this->have()): ?>
	<?php while($this->next()): ?>
        <article class="post">
			<div class="post_title">
				<h2 class="title"><a href="<?php $this->permalink() ?>" rel="bookmark"><?php $this->title() ?></a></h2>
				<div class="title_info">
					<span class="time"><i class="iconfont icon-data"></i><a href="/<?php $this->date('Y/m/'); ?>" title="<?php $this->date('Y-m-d'); ?>"><?php $this->dateWord();?></a></span>
					<span class="author"><i class="iconfont icon-author"></i><a href="/"><?php $this->author(); ?></a></span>
					<span class="cate"><i class="iconfont icon-category"></i><?php $this->category(','); ?></span>
					<span class="views"><i class="iconfont icon-view"></i><?php Views_Plugin::theViews(); ?></span>
					<span class="com"><i class="iconfont icon-comment"></i><a href="<?php $this->permalink() ?>#comments"><?php $this->commentsNum('暂无', '1条', '%d条'); ?></a></span>
				</div>	
			</div>			
			<div class="post_entry clearfix">
				<a href="<?php $this->permalink();?>" title="<?php $this->title() ?>"><img class="thumbnail" src="//itlu.org/index/thumb.png" data-original="<?php show_first_img($this);?><?php $this->options->fileext(); ?>" /></a>
				<div class="art-content">
					<?php $this->excerpt(172, '...'); ?>
					<div class="art-tags"><a href="<?php $this->permalink() ?>" class="rd_more" rel="bookmark" title="阅读『<?php $this->title(); ?>』全文">阅读全文</a><span><?php $this->tags('  ', true, 'none'); ?></span></div>
				</div>
			</div>
        </article>
	<?php endwhile; ?>
    <?php else: ?>
        <div class="search_tips">
            <h2 class="s_title"><?php _e('您输入的关键词搜索不到，换个其他试试？'); ?></h2>
			<div class="s_other">
				<div class="s_o_tit">或者使用百度站内搜索试试</div>
				<div class="s_o_con">
					<script type="text/javascript">(function(){document.write(unescape('%3Cdiv id="bdcs"%3E%3C/div%3E'));var bdcs = document.createElement('script');bdcs.type = 'text/javascript';bdcs.async = true;bdcs.src = 'http://znsv.baidu.com/customer_search/api/js?sid=13548290040828183702' + '&plate_url=' + encodeURIComponent(window.location.href) + '&t=' + Math.ceil(new Date()/3600000);var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(bdcs, s);})();</script>
				</div>
			</div>
        </div>
    <?php endif; ?>
    
	<?php $this->pageNav('上一页','下一页',3,'...'); ?>
    </section><!-- end #content-->
	<?php $this->need('sidebar.php'); ?>
	<?php $this->need('footer.php'); ?>
