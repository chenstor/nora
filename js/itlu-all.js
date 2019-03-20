/* Lazy Load 1.9.7 */
!function(a,b,c,d){var e=a(b);a.fn.lazyload=function(f){function g(){var b=0;i.each(function(){var c=a(this);if(!j.skip_invisible||c.is(":visible"))if(a.abovethetop(this,j)||a.leftofbegin(this,j));else if(a.belowthefold(this,j)||a.rightoffold(this,j)){if(++b>j.failure_limit)return!1}else c.trigger("appear"),b=0})}var h,i=this,j={threshold:0,failure_limit:0,event:"scroll",effect:"show",container:b,data_attribute:"original",skip_invisible:!1,appear:null,load:null,placeholder:"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC"};return f&&(d!==f.failurelimit&&(f.failure_limit=f.failurelimit,delete f.failurelimit),d!==f.effectspeed&&(f.effect_speed=f.effectspeed,delete f.effectspeed),a.extend(j,f)),h=j.container===d||j.container===b?e:a(j.container),0===j.event.indexOf("scroll")&&h.bind(j.event,function(){return g()}),this.each(function(){var b=this,c=a(b);b.loaded=!1,(c.attr("src")===d||c.attr("src")===!1)&&c.is("img")&&c.attr("src",j.placeholder),c.one("appear",function(){if(!this.loaded){if(j.appear){var d=i.length;j.appear.call(b,d,j)}a("<img />").bind("load",function(){var d=c.attr("data-"+j.data_attribute);c.hide(),c.is("img")?c.attr("src",d):c.css("background-image","url('"+d+"')"),c[j.effect](j.effect_speed),b.loaded=!0;var e=a.grep(i,function(a){return!a.loaded});if(i=a(e),j.load){var f=i.length;j.load.call(b,f,j)}}).attr("src",c.attr("data-"+j.data_attribute))}}),0!==j.event.indexOf("scroll")&&c.bind(j.event,function(){b.loaded||c.trigger("appear")})}),e.bind("resize",function(){g()}),/(?:iphone|ipod|ipad).*os 5/gi.test(navigator.appVersion)&&e.bind("pageshow",function(b){b.originalEvent&&b.originalEvent.persisted&&i.each(function(){a(this).trigger("appear")})}),a(c).ready(function(){g()}),this},a.belowthefold=function(c,f){var g;return g=f.container===d||f.container===b?(b.innerHeight?b.innerHeight:e.height())+e.scrollTop():a(f.container).offset().top+a(f.container).height(),g<=a(c).offset().top-f.threshold},a.rightoffold=function(c,f){var g;return g=f.container===d||f.container===b?e.width()+e.scrollLeft():a(f.container).offset().left+a(f.container).width(),g<=a(c).offset().left-f.threshold},a.abovethetop=function(c,f){var g;return g=f.container===d||f.container===b?e.scrollTop():a(f.container).offset().top,g>=a(c).offset().top+f.threshold+a(c).height()},a.leftofbegin=function(c,f){var g;return g=f.container===d||f.container===b?e.scrollLeft():a(f.container).offset().left,g>=a(c).offset().left+f.threshold+a(c).width()},a.inviewport=function(b,c){return!(a.rightoffold(b,c)||a.leftofbegin(b,c)||a.belowthefold(b,c)||a.abovethetop(b,c))},a.extend(a.expr[":"],{"below-the-fold":function(b){return a.belowthefold(b,{threshold:0})},"above-the-top":function(b){return!a.belowthefold(b,{threshold:0})},"right-of-screen":function(b){return a.rightoffold(b,{threshold:0})},"left-of-screen":function(b){return!a.rightoffold(b,{threshold:0})},"in-viewport":function(b){return a.inviewport(b,{threshold:0})},"above-the-fold":function(b){return!a.belowthefold(b,{threshold:0})},"right-of-fold":function(b){return a.rightoffold(b,{threshold:0})},"left-of-fold":function(b){return!a.rightoffold(b,{threshold:0})}})}(jQuery,window,document);
/* 图片延迟加载配置 */
$(".post img").lazyload({effect: "fadeIn",threshold: 200});
//menu click
function btn_click(btn, on, off) {
	flag=true;
	$(btn).click(function () {
		$(btn).prop('class', (flag = !flag) ? on : off);
	});
}
btn_click("#topmenu", "nav_click", "nav_close");
//article source
if($("#sidebar").is(":hidden")){//边栏隐藏时
	var div_width = $(".container").width();
}else{//不隐藏时
	var div_width = $(".container").width()-340;
	$("#content").css({width:div_width+"px",overflow:"hidden"});
}
if(div_width<728){
	$("#post_end").css({width:div_width+"px",overflow:"hidden"});
	if($("pre").size()>0){
		$("pre").css({width:div_width+"px"});
	}
}
if($(".source").size()>0){$(".source").css({width:div_width+"px",overflow:"auto"});}
if($(".art-content").size()>0){
	var $content_width = $("#content").width();
	var $container_width = $(".container").width();
	if($("#content").width()>$(".container").width()){
		$(".art-content").css("width",$(".container").width())
	}
}
//=========
$('#desktopSideTools').hide();
$(window).scroll(function() {
	if ($(this).scrollTop()>100) {
		$('#desktopSideTools').fadeIn();
	} else {
		$('#desktopSideTools').fadeOut();
	}
});
$(".smooth").click(function(){
	var href = $(this).attr("href");
	var pos = $(href).offset().top;
	$("html,body").animate({scrollTop: pos}, 1000);	
	return false;
});
// GOTO TOP
$('#newScrollTop').click(function() {
        $("body,html").animate({scrollTop:0},1000);
        return false;
});
$(function(){
	$(".tb_share img").each(function(){
		var oldwidth = $(this).width(); 
		var oldheight = $(this).height();
		if(oldheight > oldwidth){
			$(this).css({height:oldwidth+"px"}); 
		}
	});
});
//边栏Tab切换
(function($){
	$.fn.myTab = function(options){
		var defult = {parent:"",index:null};
		var setting =$.extend(defult,options);
		$(this).find("i").on("click",function(){
			var $this=$(this);
			var $index =$this.index();
			$this.addClass("on").siblings().removeClass("on");
			$(setting.parent).children("ul").eq($index).show().siblings().hide();
		})
		if(setting.index==null){
			$(this).find('i').eq(0).click();
		}else{
			$(this).find('i').eq(options.index).click();
		}
	}
})(jQuery)
$(".s_tit").myTab({parent:".s_con",index:0});
//阅读进度条
$(window).scroll(function(){
	var scrollTo = $(window).scrollTop(),
    docHeight = $(document).height(),
    windowHeight = $(window).height();
    scrollPercent = (scrollTo / (docHeight-windowHeight)) * 100;
	$(".scroll-bar").attr("style","width:"+scrollPercent+"%;display:block;");
}).trigger('scroll');

function is_weixn_qq(){
	var ua = navigator.userAgent.toLowerCase();
	if(ua.match(/MicroMessenger/i)=="micromessenger") {
		return "weixin";
	}else if(ua.match(/QQ/i) == "qq") {
		return "QQ";
	}
	return false;
}
if($("#repay-show").size()>0){
	var browers = is_weixn_qq();
	if(browers == "weixin"){
		$("#repay-show").html("<li><img src=\"//img2.itlu.org/index/weixin-zanshang.png?1119\"></li>");
	}else{
		$("#repay-show").html("<li class=\"alipay\"><img src=\"//img2.itlu.org/index/itlu-alipay.png\"></li> <li><img src=\"//img2.itlu.org/index/itlu-weixin.png\"></li>");
	}
}
function windowsShow(thisobj){
    if ($(thisobj).css("display") == "none") {
        $(thisobj).css('display','block');
    }else{
        $(thisobj).css('display','none');
    }
}
$('.repay').click(function(){windowsShow(".window");});
$('#search-icon').click(function(){windowsShow(".search");});

if($("#scroll_itlu").size()>0){
      var $elm = $('#scroll_itlu');
      var startPos = $elm.offset().top;
      $(window).scroll(function() {		  
          var p = $(window).scrollTop();
          if( p > startPos ){
              $elm.css({'position': 'fixed','top': '5px','width': '310px','z-index':'90'});
          }else{
              $elm.css({'position': 'relative'});
          }
      });
}

//评论提交
$('form[id=comment_form]').keypress(function(e){
	if(e.ctrlKey && e.which == 13 || e.which == 10){$('#misubmit').click();}
});
//评论判断
$("#misubmit").click(function(){
	var author = $("#author").val();
	var mail = $("#mail").val();
	var comment = $("#comment").val();
	if(author==""){
		alert("说好的昵称呢");
		$("#author").focus();
		return false;
	}
	if(mail==""){
		alert("邮箱是要填写的");
		$("#mail").focus();
		return false;
	}
	if(!((/[\u4e00-\u9fa5]{2,}/g.test(comment)) || (/[0-9]{5,}/g.test(comment)))){
		alert("至少输入2个中文或5个数字");
		$("#comment").focus();
		return false;
	}
	$(this).attr({"disabled":"true","class":"submit_dis","value":"提交中..."}); 
	addCookie();
	$("#comment_form").submit();
});

/*! jquery.cookie v1.4.1 | MIT */
!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):"object"==typeof exports?a(require("jquery")):a(jQuery)}(function(a){function b(a){return h.raw?a:encodeURIComponent(a)}function c(a){return h.raw?a:decodeURIComponent(a)}function d(a){return b(h.json?JSON.stringify(a):String(a))}function e(a){0===a.indexOf('"')&&(a=a.slice(1,-1).replace(/\\"/g,'"').replace(/\\\\/g,"\\"));try{return a=decodeURIComponent(a.replace(g," ")),h.json?JSON.parse(a):a}catch(b){}}function f(b,c){var d=h.raw?b:e(b);return a.isFunction(c)?c(d):d}var g=/\+/g,h=a.cookie=function(e,g,i){if(void 0!==g&&!a.isFunction(g)){if(i=a.extend({},h.defaults,i),"number"==typeof i.expires){var j=i.expires,k=i.expires=new Date;k.setTime(+k+864e5*j)}return document.cookie=[b(e),"=",d(g),i.expires?"; expires="+i.expires.toUTCString():"",i.path?"; path="+i.path:"",i.domain?"; domain="+i.domain:"",i.secure?"; secure":""].join("")}for(var l=e?void 0:{},m=document.cookie?document.cookie.split("; "):[],n=0,o=m.length;o>n;n++){var p=m[n].split("="),q=c(p.shift()),r=p.join("=");if(e&&e===q){l=f(r,g);break}e||void 0===(r=f(r))||(l[q]=r)}return l};h.defaults={},a.removeCookie=function(b,c){return void 0===a.cookie(b)?!1:(a.cookie(b,"",a.extend({},c,{expires:-1})),!a.cookie(b))}});

function addCookie(){//增加Cookie
	$.cookie('author', $("#author").val(),{expires:365,path:'/',domain:'itlu.org',secure:true});
	$.cookie('mail', $("#mail").val(),{expires:365,path:'/',domain:'itlu.org',secure:true});
	$.cookie('url', $("#url").val(),{expires:365,path:'/',domain:'itlu.org',secure:true});
}
function ReadCookie() {
	if($.cookie('author')!=null){
		$("#author").val(unescape($.cookie('author')));
		$(".author_info").hide();
		$(".welcome").show();
		$(".welcome .we").text(unescape($.cookie('author')));
	}else{
		$(".author_info").show();
		$(".welcome").hide();
	}
	if($.cookie('mail')!=null){$("#mail").val(unescape($.cookie('mail')));}
	if($.cookie('url')!=null){$("#url").val(unescape($.cookie('url')));}
}
function comment_change(){
	var author=document.getElementById('author').value;
	var email=document.getElementById('mail').value;
	var change=document.getElementById('comment-change');
	var change_name=document.getElementById('comment-change-name');
	switch(change.innerHTML.replace(/\s+/g,'')){
		case '修改':$(".author_info").show(); change.innerHTML='确定'; break;
		case '确定':if(author!='' && email!=''){change_name.innerHTML=author;addCookie();}else{change_name.innerHTML='#信息不全#';} $(".author_info").hide(); change.innerHTML='修改'; break;
	}
}
function autoloadUser(){
	var autoload_hash=window.location.hash;
	if(autoload_hash.slice(0,9)=="#comment-" && autoload_hash.length>9){
		autoload_array=autoload_hash.split("&");
		if(autoload_array[1]=="auto"){
			if(autoload_array[2]){$.cookie('author', decodeURIComponent(autoload_array[2]),{expires:365,path:'/',domain:'itlu.org',secure:true});}
			if(autoload_array[3]){$.cookie('mail', decodeURIComponent(autoload_array[3]),{expires:365,path:'/',domain:'itlu.org',secure:true});}
			if(autoload_array[4]){$.cookie('url', decodeURIComponent(autoload_array[4]),{expires:365,path:'/',domain:'itlu.org',secure:true});}
			window.location.hash=autoload_array[0];
		}
	}
	if($("#comment_form").size()>0){ReadCookie();}
}
$("#comment-change").click(function(){comment_change();});