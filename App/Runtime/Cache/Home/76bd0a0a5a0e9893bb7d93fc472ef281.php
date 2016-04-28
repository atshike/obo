<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php if(is_array($show)): $i = 0; $__LIST__ = $show;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sh): $mod = ($i % 2 );++$i;?><title><?php echo ($sh["title"]); ?>-乄無时博客</title>
<link rel="stylesheet" type="text/css" href="/Public/Css/obthink.css" />
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
<div class="oshow">

<h2><?php echo ($sh["title"]); ?></h2>
<div class="wri"><?php echo ($sh["writer"]); ?> | <?php echo ($sh["typename"]); ?> |  <?php echo (date('Y-m-d',$sh["senddate"])); if($_SESSION['uname'] == 'xadmin' ): ?>| <a href="/index.php/home/index/del/id/<?php echo ($sh["id"]); ?>">删除</a> 
		 | <a href="/index.php/home/index/edit/id/<?php echo ($sh["id"]); ?>">修改</a>
    <?php else: endif; ?></div>
<div style="padding:20px; size:12px; border:1px solid #ccc; background:#ffeeee; margin:10px 0;"><?php echo ($sh["title"]); ?></div>

<?php if($sh["litpic"] != '' ): ?><img src="<?php echo ($sh["litpic"]); ?>"><br /><?php endif; ?>

<?php echo (stripslashes(htmlspecialchars_decode($sh["body"]))); endforeach; endif; else: echo "" ;endif; ?>

<div class="nm" style="margin:20px 0;">
<li>
<?php if(is_array($sa)): $i = 0; $__LIST__ = $sa;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sa): $mod = ($i % 2 );++$i; if($sa['title'] != '' ): ?>下一条：<a href="/index.php/home/index/showm/id/<?php echo ($sa["id"]); ?>"><?php echo ($sa["title"]); ?></a>
    <?php else: ?> 
		无记录！<?php endif; endforeach; endif; else: echo "" ;endif; ?>
</li>
<li><?php if(is_array($sc)): $i = 0; $__LIST__ = $sc;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sc): $mod = ($i % 2 );++$i; if($sc['title'] != '' ): ?>上一条：<a href="/index.php/home/index/showm/id/<?php echo ($sc["id"]); ?>"><?php echo ($sc["title"]); ?></a>
    <?php else: ?> 
		无记录！<?php endif; endforeach; endif; else: echo "" ;endif; ?>

</li>
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