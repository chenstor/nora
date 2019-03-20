<?php if(!defined('__TYPECHO_ROOT_DIR__')) exit();?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit" /> 
<meta http-equiv="x-dns-prefetch-control" content="on" /><link rel="dns-prefetch" href="//img2.itlu.org" /><link rel="dns-prefetch" href="//upcdn.b0.upaiyun.com" /><link rel="dns-prefetch" href="//sdn.geekzu.org" /><link rel="dns-prefetch" href="//cdn.bootcss.com" /><link rel="dns-prefetch" href="//cn.gravatar.com" />
<title><?php if ($this->is('index')){$this->options->title();} 
elseif($this->is('post') || $this->is('page')){$this->archiveTitle('','',' - '); $this->options->title();} 
elseif($this->is('category')){$this->archiveTitle('','分类: ',' - '); $this->options->title();} elseif($this->is('tag')){$this->archiveTitle('','标签: ',' - '); $this->options->title();} 
elseif($this->is('search')){$this->archiveTitle('','搜索: ',' - '); $this->options->title();}
elseif($this->is('archive')){$this->archiveTitle('年','',' - '); $this->options->title();} 
else{$this->archiveTitle('','','');}?><?php if($this->_currentPage>1) echo '_第'.$this->_currentPage.'页'; ?></title>
<link rel="stylesheet" type="text/css" media="all" href="<?php $this->options->themeUrl('style.css'); ?>" />
<?php $this->header('generator=&template=&pingback=&xmlrpc=&wlw='); ?>
<script type="text/javascript" src="//upcdn.b0.upaiyun.com/libs/jquery/jquery-1.7.2.min.js" data-no-track></script>
<?php if($this->options->logoUrl):?>
<style type="text/css">
.header .logo a{background:url("<?php $this->options->logoUrl();?>");}
</style>
<?php endif;?>
</head>
<body>
<div class="scroll-bar"></div>
<header id="header">
	<div class="header container">
		<h1 class="logo"><a href="<?php $this->options->siteUrl();?>"><?php $this->options->title();?></a></h1>
		<h3 class="slogan"><?php $this->options->slogan(); ?></h3>
		<div class="search"><form method="post" action="/">
		<div><input type="text" name="s" placeholder="想搜点什么..." class="s_inp" size="12" /></div>
		<input type="submit" value="搜索" class="s_btn" /></form>
		</div>
	</div>
	<div id="search-icon"><i class="iconfont icon-search"></i></div>
	<div id="topmenu">
		<nav class="menu container"><ul>
		<li><a href="<?php $this->options->siteUrl();?>" <?php if ($this->is('index') || ($this->is('post')&& ($this->category != "itlu-recommend") )){echo "class=\"current\"";} ?>>首页</a></li>
		<?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
		<?php while($pages->next()):?>
		<li><a href="<?php $pages->permalink(); ?>" title="<?php $pages->title();?>"<?php if($this->is('page', $pages->slug)){echo " class=\"current\"";}?>><?php $pages->title();?></a></li>
		<?php endwhile;?>
		</ul></nav>
		<i class="i_1"></i>
		<i class="i_2"></i>
	</div>
</header>
<div class="header_bg"></div>
<section class="main_bg container clearfix">