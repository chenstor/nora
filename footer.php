<?php if(!defined('__TYPECHO_ROOT_DIR__')) exit();?>
</section>
<div id="footer">
<p><a href="//itlu.org/zhidao/" title="灰狼知识库" target="_blank">知识库</a> | <a href="//itlu.org/index/ip.php" title="域名IP地址查询" target="_blank">IP查询</a> | <a href="//itlu.org/tool/jseval/" title="JavaScript加密解密" target="_blank">JS加密解密</a> | <a href="//itlu.org/tool/csstidy/" title="CSS整形与优化工具" target="_blank">CSS整形</a></p>
<p>版权所有 本博客由Typecho驱动 主题由<a href="//itlu.org/" target="_blank">Nora</a>设计</p>
<p><a href="<?php $this->options->feedUrl(); ?>">RSS订阅</a> | <a href="/sitemap.xml">Sitemap</a> | <a href="http://www.miitbeian.gov.cn/" target="_blank" rel="nofollow">湘ICP备88888888号</a> | <a href="/" target="_blank" rel="nofollow">网站统计</a></p>
</div><!-- end #footer -->
<div style="display:none;" class="backtop" id="desktopSideTools"><a href="#top" title="返回顶部" id="newScrollTop"></a></div>
<script type="text/javascript" src="<?php $this->options->themeUrl('js/itlu-all.js'); ?>" data-no-track></script>
<script data-no-track>autoloadUser();ReadCookie();</script>
<script src="<?php $this->options->themeUrl('js/instantclick.min.js'); ?>" data-no-track></script>
<script data-no-instant>
	InstantClick.on('change', function(isInitialLoad) {
		if (isInitialLoad === false) {
			_hmt.push(['_trackPageview', location.pathname + location.search]);
		}
	});
	InstantClick.init('mousedown');

    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "//hm.baidu.com/hm.js?33846ca5214a558836c2133287cdb7b8";
        var s = document.getElementsByTagName("script")[0]; 
        s.parentNode.insertBefore(hm, s);
    })();
</script>
<!--[if lt IE 9]>
<script src="//cdn.bootcss.com/html5shiv/r29/html5.min.js"></script>
<script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
<div class="browsehappy" role="dialog">你正在使用一个过时的浏览器，为了正常的访问, 请<a href="http://browsehappy.com/" target="_blank">升级你的浏览器</a>以查看此页面。</div>
<![endif]-->

<?php $this->footer(); ?>
</body>
</html>