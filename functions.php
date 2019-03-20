<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit();

function themeConfig($form) {
	echo ('<style>body{font-family:Microsoft Yahei,微软雅黑;}</style><div style="font-size:14px;border-left:5px solid #1A1A1A;padding-left:8px;">Nora&nbsp;Theme&nbsp;版本：1.1(2018120701)&nbsp;&nbsp;<strong>主题设置页</strong>&nbsp;&nbsp;<a href="https://itlu.org/themes/" title="检查更新">检查更新</a></div>');
	//LOGO设置
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点LOGO地址'), _t('在这里填入一个图片URL地址'));
    $form->addInput($logoUrl);	
	$slogan = new Typecho_Widget_Helper_Form_Element_Text('slogan', NULL, NULL, _t('logo旁边的标语'), _t('在这里输入标语'));
	$form->addInput($slogan);
	$fileext = new Typecho_Widget_Helper_Form_Element_Text('fileext', NULL, NULL, _t('第三方CDN图片处理'), _t('启用第三方CDN，如又拍等需要添加图片后缀，默认留空'));
	$form->addInput($fileext);
	//边栏广告
	$sidebarAD = new Typecho_Widget_Helper_Form_Element_Textarea('sidebarAD', NULL, NULL, _t('边栏顶部广告'), _t('在这里输入广告内容, 支持HTML'));
	$form->addInput($sidebarAD);
	$sidebarADFoot = new Typecho_Widget_Helper_Form_Element_Textarea('sidebarADFoot', NULL, NULL, _t('边栏底部广告'), _t('在这里输入广告内容, 支持HTML'));
	$form->addInput($sidebarADFoot);
}

function escape($string, $in_encoding = 'UTF-8',$out_encoding = 'UCS-2') { 
    $return = ''; 
    if (function_exists('mb_get_info')) { 
        for($x = 0; $x < mb_strlen ( $string, $in_encoding ); $x ++) { 
            $str = mb_substr ( $string, $x, 1, $in_encoding ); 
            if (strlen ( $str ) > 1) { // 多字节字符 
                $return .= '%u' . strtoupper ( bin2hex ( mb_convert_encoding ( $str, $out_encoding, $in_encoding ) ) ); 
            } else { 
                $return .= '%' . strtoupper ( bin2hex ( $str ) ); 
            } 
        } 
    } 
    return $return; 
}

//获得读者墙
function getFriendWall(){
	$period = time() - 2592000*6; // 時段: 30 天*6, 單位: 秒
	$db = Typecho_Db::get();
	$sql = $db->select('COUNT(author) AS cnt', 'author', 'url', 'mail')
	->from('table.comments')
	->where('created > ?', $period )
	->where('status = ?', 'approved')
	->where('type = ?', 'comment')          
	->where('authorId = ?', '0')
	->where('mail != ?', 'a@itlu.org')   //排除自己上墙
	->group('author')
	->order('cnt', Typecho_Db::SORT_DESC)
	->limit('40');    //读取几位用户的信息
	$result = $db->fetchAll($sql);
	$mostactive = "";
	if (count($result) > 0) {
		foreach ($result as $value) {
			empty($value['url']) ? $a_url="//itlu.org/" : $a_url=$value['url'];
			$mostactive .= '<li><a href="' . $a_url . '" title="' . $value['author'] . ' : ' . $value['cnt'] . '次重要讲话" target="_blank" rel="nofollow">';
			$mostactive .= '<div class="wallshow" style="
    background-image:url(//cn.gravatar.com/avatar/'.md5(strtolower($value['mail'])).'?s=70&d=&r=g);background-position:center center;background-size:cover;border-radius:25%;"></div><i>' . $value['cnt'] . '</i></a></li>';
		}      
		echo $mostactive;
	}
}

function isImageCheck($type,$arr_ext){	
	for($i = 0;$i<count($arr_ext);$i++){
		if( $type == $arr_ext[$i] ){
			$isImg = true;
			break;
		}
	}
	if( $isImg ){
		return true;
	}else{
		return false;
	}
}
// 文章区域获取第一张图
function show_first_img($obj){
	$cid = $obj->cid;
	$content = $obj->text;
	$options = Typecho_Widget::widget('Widget_Options');
	$default_img = $options->themeUrl.'/images/nopic.png';
	$arr_ext = array('jpg','gif','png','bmp','jpeg');
	$db = Typecho_Db::get();
	$attach = $db->fetchAll($db->select()->from('table.contents')
				->where('type = ? AND parent = ? ', 'attachment', $cid)
				);
	if( empty($attach) ){ // 没有附件
		preg_match_all( "/\<img.*?src\=\"(.*?)\"[^>]*>/i", $content, $matches);
		$imgCount = count($matches[0]);
		if( $imgCount >=1 ){
			$img = $matches[1][0];
		}
		else{
			$img = $default_img;
		}
	}
	else{ //从附件中找出第一个上传的图片			
		foreach( $attach as $attach ){
			$attach_text = unserialize($attach['text']);
			if( isImageCheck($attach_text['type'],$arr_ext) ){
				$img = $attach_text['path'];
				break;
			}			
		}	
	}
	echo $img;
}

//获取第一张图
function img_postthumb($cid) {
   $db = Typecho_Db::get();
   $rs = $db->fetchRow($db->select('table.contents.text')
       ->from('table.contents')
       ->where('table.contents.cid=?', $cid)
       ->order('table.contents.cid', Typecho_Db::SORT_ASC)
       ->limit(1));
   preg_match_all("/\<img.*?src\=\"(.*?)\"[^>]*>/i", $rs['text'], $thumbUrl);  //通过正则式获取图片地址
   $img_src = $thumbUrl[0];  //将赋值给img_src
   $img_counter = count($thumbUrl[0]);  //一个src地址的计数器
   switch ($img_counter > 0) {
       case $allPics = 1:
		   $imgurl = $thumbUrl[1][0];
		   echo "<img src=\"".$imgurl."!sidebar\" class=\"itlu_thumbnail\" />";
           break;
       default:
		   $options = Typecho_Widget::widget('Widget_Options');
		   $imgurl = $options->themeUrl.'/images/nopic.png';
		   //$imgurl = "//img2.itlu.org/usr/uploads/2016/rand".rand(1,3).".jpg";
		   echo "<img src=\"".$imgurl."\" class=\"itlu_thumbnail\" />";
   };
}

/**
 * 输出最评价最多文章
 *
 * 语法: theMostCommented();
 *
 * @access public
 * @param int  $limit  文章数目
 * @param int  $days   查询天数
 * @return string
*/
function theMostCommented($limit = 8, $days = 90) {
	$db = Typecho_Db::get();
	$options = Typecho_Widget::widget('Widget_Options');
	$limit = is_numeric($limit) ? $limit : 10;
	$period = time() - $days*24*60*60; // 单位: 秒
	$posts = $db->fetchAll($db->select()->from('table.contents')
			 ->where('type = ? AND status = ? AND password IS NULL', 'post', 'publish')
			 ->where('created > ?', $period )
			 ->order('commentsNum', Typecho_Db::SORT_DESC)
			 ->limit($limit)
			 );
	if ($posts) {
		foreach ($posts as $post) {
			$result = Typecho_Widget::widget('Widget_Abstract_Contents')->push($post);
			$post_comments = number_format($result['commentsNum']);
			$post_title = htmlspecialchars($result['title']);
			$permalink = $result['permalink'];
			$post_time = date('Y-m-d',$result['created']);
			echo "<li><a href='$permalink' title='$post_title'>";
			echo img_postthumb($result['cid']);
			echo "</a><a href='$permalink' title='$post_title' class='h_title'>$post_title</a><p><i class='time'>$post_time</i><i class='views'>$post_comments 条评论</i></p></li>\n";
		}

	} 
	else {
		echo "<li>N/A</li>\n";
	}
}

// 随机文章
function theRandom($format='<li><i class="iconfont icon-article2"></i><a href="{permalink}">{title}</a></li>', $randomNum = 10, $rndtime = 300, $file='./usr/ArticleListNora.xml'){
	/**读取XML文件*/        
	$xml1=@simplexml_load_file($file);	
	/**可以直接返回xml对象*/
	if($xml1 && $rndtime!=0 && time()-$xml1->attributes()<$rndtime){
		foreach($xml1->rd as $rd)
		{
			echo str_replace(array('{permalink}','{title}'),array($rd->link,$rd->title),$format);
		}
	}else{ //读取数据库，判断是否输出或是更新缓存
		$db=Typecho_Db::get();
		$rs = $db->fetchRow($db->select(array('COUNT(cid)' => 'total'))->from('table.contents')
			->where('table.contents.status = ?', 'publish')
			->where('table.contents.type = ?', 'post'));
		$total=$rs['total'];

		/**设置随机数组*/
		srand((float) microtime() * 10000000);
		$ary=range(0,$total-1);
		if($randomNum>$total) $randomNum=$total;
		$rand = array_rand($ary, $randomNum);

		$list = '<lists/>';
		$xml = new SimpleXMLElement($list);
		$xml->addAttribute('time', time());

		foreach($rand as $index){
			$result = $db->fetchRow($db->select('cid','title','slug','created','type','text')->from('table.contents')
					->where('table.contents.status = ?', 'publish')
					->where('table.contents.type = ?', 'post')
					->offset($index)
					->limit(1));

			$value = Typecho_Widget::widget('Widget_Abstract_Contents')->push($result);
			$title = $value['title'];
			echo str_replace(array('{permalink}', '{title}'), array($value['permalink'],  $title), $format);
			$rd=$xml->addChild('rd');
			$rd->addChild('title',$title);
			$rd->addChild('link',$value['permalink']);
		}
		// 更新XML文件
		file_put_contents($file, $xml->asXML());            
	}   
}

/**
 * 输出最受欢迎文章
 *
 * 语法: theMostViewed();
 *
 * @access public
 * @param int  $limit  文章数目
 * @param int  $days   查询天数
 * @return string
 */
function theMostViewed($limit = 8, $days = 90)
{
	$db = Typecho_Db::get();
	$options = Typecho_Widget::widget('Widget_Options');
	$limit = is_numeric($limit) ? $limit : 8;
	$period = time() - $days*24*60*60; // 单位: 秒
	$posts = $db->fetchAll($db->select()->from('table.contents')
			 ->where('type = ? AND status = ? AND password IS NULL', 'post', 'publish')
			 ->where('created > ?', $period )
			 ->order('views', Typecho_Db::SORT_DESC)
			 ->limit($limit)
			 );

	if ($posts) {
		foreach ($posts as $post) {
			$result = Typecho_Widget::widget('Widget_Abstract_Contents')->push($post);
			$post_views = number_format($result['views']);
			$post_title = htmlspecialchars($result['title']);
			$permalink = $result['permalink'];
			$post_time = date('Y-m-d',$result['created']);
			echo "<li><a href='$permalink' title='$post_title'>";
			echo img_postthumb($result['cid']);
			echo "</a><a href='$permalink' title='$post_title' class='h_title'>$post_title</a><p><i class='time'>$post_time</i><i class='views'>$post_views ℃</i></p></li>\n";
		}

	} else {
		echo "<li>N/A</li>\n";
	}
}

/**
 * 输出访问次数
 *
 * 语法: theViews();
 * 输出: 'xx,xxx 次'
 *
 * @access public
 * @param string  $after  后字串
 * @param bool    $echo   是否显示 (0 用于运算，不显示)
 * @return string
 */
function theViews($after = '次', $echo = 1)
{
	$db = Typecho_Db::get();
	
	// contents 表中若无 views 字段则添加
	// 第一次使用建议开启这个检测，以免报错
	/*if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))){
		$prefix = $db->getPrefix();
		$db->query('ALTER TABLE `'. $prefix .'contents` ADD `views` INT(10) DEFAULT 0;');
	}*/
	
	$cid = Typecho_Widget::widget('Widget_Archive')->cid;
	// 计数
	$rowupdate = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
	$db->query($db->update('table.contents')->rows(array('views' => (int)$rowupdate['views']+1))->where('cid = ?', $cid));
	
	$row = $db->fetchRow($db->select('views','cid')->from('table.contents')->where('cid = ?', $cid));	
	if ($echo)
		echo number_format($row['views']).$after;
	else
		return $row['views'];
}

function isMobile(){ 
    if (isset($_SERVER['HTTP_X_WAP_PROFILE'])){return true;} 
    if (isset($_SERVER['HTTP_VIA'])){return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;} 
    if (isset ($_SERVER['HTTP_USER_AGENT'])){$clientkeywords = array ('nokia',
            'sony','ericsson','mot','samsung','htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel','lenovo','iphone','ipod','blackberry','meizu','android','netfront','symbian','ucweb','windowsce','palm','operamini','operamobi','openwave','nexusone','cldc','midp','wap','mobile'); 
        if (preg_match("/(".implode('|', $clientkeywords).")/i", strtolower($_SERVER['HTTP_USER_AGENT']))){
            return true;
        } 
    }
    if (isset ($_SERVER['HTTP_ACCEPT'])){
        if((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
        {
            return true;
        } 
    } 
    return false;
}