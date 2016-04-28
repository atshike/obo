<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>乄無时博客</title>
<meta name="description" content="This is action！" >
<meta name="keywords" content="SEO,网站建设,网络营销,">
<link rel="stylesheet" type="text/css" href="/Public/Css/obthink.css" />
<script src="/Public/js/jquery.js"></script>
<script>
$(document).ready(function(){
	$(".con").prepend('<div class="nav_ub"></div><div class="nav_db"></div>')
	$(".con").hover(function(){
		$(this).children(".nav_ub").stop().animate({top:-26},300);
		$(this).find(".pos").stop().animate({left:220},250);
		$(this).children(".nav_db").stop().animate({bottom:-14},300);
		$(this).find(".pos").stop().animate({left:220},250);
	},function(){
		$(this).children(".nav_ub").stop().animate({top:0},300);
		$(this).find(".pos").stop().animate({left:200},250);
		$(this).children(".nav_db").stop().animate({bottom:0},300);
		$(this).find(".pos").stop().animate({left:200},250);
	});
})
</script>
</head>

<body>
<div class="head">
<div class="header">
<h2>乄無时博客</h2>
<div class="reg">

<?php if(($_SESSION['uname'] != '')): ?>欢迎您，<?php echo ($_SESSION['uname']); ?> <a href="/index.php/home/member/">[用户中心]</a> &nbsp;&nbsp;[<a href="/index.php/home/index/add">发布</a>]&nbsp;&nbsp; <a href="/index.php/home/index/logout">[退出]</a>
<?php else: ?> 
	<a href="/index.php/home/index/reg">[注册]</a><a href="/index.php/home/index/log">[ 登录]</a><?php endif; ?>

</div></div>
</div> <div class="clea"></div>	
<div class="menu">
<ul>
    <li><a href="/index.php/home/index">网站首页</a></li>
    <li><a href="/index.php/home/index/listi/typeid/10">WEB前端开发</a></li>
    <li><a href="/index.php/home/index/listi/typeid/34">SEO优化</a></li>
    <li><a href="/index.php/home/index/listi/typeid/33">网络营销</a></li>
    <li><a href="/index.php/home/index/listi/typeid/11">程序开发</a></li>
    <li><a href="/index.php/home">HTML5</a></li>
	<li><a href="/index.php/home">服务项目</a></li>
    <li><a href="/index.php/home">成功案例</a></li>
    <li><a href="#">微网站</a> </li>
</ul>
</div>


<div class="clea"></div>
<div class="indexshow">

<div class="indexleftshow">
<h4>文章列表</h4>
<ul>
<?php if(is_array($list)): foreach($list as $key=>$vo): ?><li>[<a href="/index.php/home/index/listi/typeid/<?php echo ($vo["typeid"]); ?>" title="<?php echo ($vo["typename"]); ?>" class="ilsa"><?php echo ($vo["typename"]); ?></a>]
<a href="/index.php/home/index/showm/id/<?php echo ($vo["id"]); ?>" title="<?php echo ($vo["title"]); ?>" class="ilsb">
<?php echo (msubstr($vo["title"],0,50,'utf-8',false)); ?>
</a> <span class="ilsc"><?php echo (date('Y-m-d',$vo["senddate"])); ?></span> 
</li><?php endforeach; endif; ?>  
 </ul>
<div class="pages"><?php echo ($show); ?></div>
</div>
<div class="indexrightshow">
 <div class="obona">
<h4>目录分类</h4>
<ul>
<?php if(is_array($atype)): foreach($atype as $key=>$arc): ?><li><a href="/index.php/home/index/listi/typeid/<?php echo ($arc["id"]); ?>" title="<?php echo ($arc["typename"]); ?>"><?php echo ($arc["typename"]); ?></a></li><?php endforeach; endif; ?>
</ul>
</div>
<div class="obona">
<form action="/index.php/home/index/search" method="get">

<input id="search-keyword" class="intext" type="text" onblur="if(this.value==''){this.value='在这里搜索...';}" onfocus="if(this.value=='在这里搜索...'){this.value='';}" value="在这里搜索..." name="q">
<input name="提交" type="submit" value="搜索" class="sub" />　
</form>
</div>
 <div class="obona">
<h4>点击排行</h4>
<ul>
<?php if(is_array($hit)): foreach($hit as $key=>$hii): ?><li><a href="/index.php/home/index/showm/id/<?php echo ($hii["id"]); ?>">
<?php echo (msubstr($hii["title"],0,14,'utf-8',false)); ?>
</a>
</li><?php endforeach; endif; ?>
</ul>
</div>
</div>
</div>
 <div class="clea"></div>
<div class="footer">
<div class="foot">
Copyright 2015-2015 ObO1com <br />
本站保留内容版权，但允许进行转载，如涉版权问题请发邮件删除atshike#163.com
</div> 
</div>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?79ad7d5aba0b2e36a3305e383be6f10f";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>

</body>
</html>