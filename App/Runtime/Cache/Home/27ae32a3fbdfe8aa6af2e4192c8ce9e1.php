<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登录-乄無时博客</title>
<style>
.logn{ float:right;}
</style>
<script type="text/javascript" src="/Public/JS/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#uname").focus(function(){
		document.getElementById("un").innerHTML="<div style=color:red>* 请输入用户名!</div>";
	});
	$("#uname").blur(function(){
		var uname=document.getElementById("uname").value;
		if(uname.length ==""){
			document.getElementById("un").innerHTML="<div style=color:red>× 用户名不能为空!</div>";
		}else{
			$.post("/index.php/home/index/checkName",{uname:uname},function(data){
			//alert(data);
				if(data==0){
					document.getElementById("un").innerHTML="<div style=color:red>用户名不存在!</div>";
				}else{
					document.getElementById("un").innerHTML="<div style=color:green>√ 格式正确</div>";
				}
			}
			);
		}
	});
	$("#pwd").focus(function(){
		document.getElementById("pw").innerHTML="<div style=color:red>* 请输入密码!</div>";
	});
	$("#pwd").blur(function(){
		var pwd=document.getElementById("pwd").value;
		if(pwd.length==""){
			document.getElementById("pw").innerHTML="<span style=color:red>× 密码不能空</span>";
		}else{
			document.getElementById("pw").innerHTML="<span style=color:green>√ 格式正确</span>";
		}
	});

});
</script>
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
<div class="log"><br />


<form action="/index.php/home/index/login" method="post">
用户名：<input name="uname" id="uname" type="text" value="" placeholder="请输入用户名"/><div id="un" class="logn"> * 请输入用户名</div>
<br />
<br />

密　码：<input name="pwd" id="pwd" type="password" value="" placeholder="请输入密码" /><div id="pw" class="logn"> * 请输入密码</div>
<br />
<br />
验证码：<input name="code" id="code" type="text"  value="" size="8" /><img src="/index.php/Home/Public/code" onclick="this.src=this.src+'?'+Math.random()"><br />
<br />

<input name="" type="submit" value="提交" />　<a href="/index.php/home/index/reg">注册</a>
<br />
</form>
</div>
</volist>
<br />
<br />
<br />
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

</body></html>