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
			$.post("/index.php/admin/index/checkName",{uname:uname},function(data){
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

<h2 align="center">后台登录</h2>
<div class="log"><br />


<form action="/index.php/admin/index/login" method="post">
用户名：<input name="uname" id="uname" type="text" value="" placeholder="请输入用户名"/><div id="un" class="logn"> * 请输入用户名</div>
<br />
<br />

密　码：<input name="pwd" id="pwd" type="password" value="" placeholder="请输入密码" /><div id="pw" class="logn"> * 请输入密码</div>
<br />
<br />
验证码：<input name="code" id="code" type="text"  value="" size="8" /><img src="/index.php/Home/Public/code" onclick="this.src=this.src+'?'+Math.random()"><br />
<br />

<input name="" type="submit" value="提交" class="alog"/>　<a href="/index.php/admin/index/reg">注册</a>
<br />
</form>
</div>
</volist>
<br />
<br />
<br />

</body></html>