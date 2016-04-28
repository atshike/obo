<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户注册-乄無时博客</title>
<link rel="stylesheet" type="text/css" href="/Public/Css/obthink.css" />
<script type="text/javascript" src="/Public/JS/jquery.js"></script>
<script type="text/javascript">

$(document).ready(function(){
	$(".inpu").focus(function(){
		//document.getElementById("un").style.color="#FF0000";
		$(this).parent("li").next(".ofc").css("display","block");
	});
	
	$("#uname").blur(function(){
		var uname=document.getElementById("uname").value;
		
		$.post("/index.php/home/index/checkName",{uname:uname},function(data,status){
			//alert("数据：" + data + "\n状态：" + status);
				if(data==0){
					if(uname.length > 12 || uname.length < 4){
						document.getElementById("un").innerHTML="<div class='cred'>用户名至少4位！</div>";
					}else{
						document.getElementById("un").innerHTML="<div class='cgre'>√ 格式正确 </div>";
					}
				}else{
					document.getElementById("un").innerHTML="<div class='cred'>× 用户名存在! </div>";
				}
			},"json"
			);
	});
	
	$("#pwd").focus(function(){
		document.getElementById("pw").style.color="#FF0000";
	});
	$("#pwd").blur(function(){
		var pwd=document.getElementById("pwd").value;
		if(pwd==""){
			document.getElementById("pw").innerHTML="<div class='cred'>× 密码不为空! </div>";
		}else if(pwd.length > 20 ||pwd.length < 6){
			document.getElementById("pw").innerHTML="<div class='cred'>× 密码不能小于6位! </div>";
		}else{
			document.getElementById("pw").innerHTML="<div class='cgre'>√ 格式正确 </div>";
		}
	});
	
	$("#pwd2").focus(function(){
		document.getElementById("pw2").style.color="#FF0000";
	});
	$("#pwd2").blur(function(){
		var pwa=document.getElementById("pwd").value;
		var pwd=document.getElementById("pwd2").value;
		if(pwd==""){
			document.getElementById("pw2").innerHTML="<div class='cred'>× 密码不为空! </div>";
		}else if(pwa!=pwd){
			document.getElementById("pw2").innerHTML="<div class='cred'>× 两次密码不一致! </div>";
		}else{
			document.getElementById("pw2").innerHTML="<div class='cgre'>√ 格式正确 </div>";
		}
	});
	
	$("#email").focus(function(){
		document.getElementById("em").style.color="#FF0000";
	});
	$("#email").blur(function(){
	var email=document.getElementById("email").value;
	var ema= /^([0-9]|[a-z])+@([0-9]|[a-z])+(\.[c][o][m])$/i;
	if(!ema.test(email)){
		document.getElementById("em").innerHTML="<div class='cred'>× 邮箱格式错误！ </div>";
	}else{
		document.getElementById("em").innerHTML = "<div class='cgre'>√ 格式正确 </div>";
	}
	});
	
	$("#code").focus(function(){
		document.getElementById("co").style.color="#FF0000";
	});
	$("#code").blur(function(){
		var code=document.getElementById("code").value;
		if(code == ''){
			document.getElementById("co").innerHTML="<div class='cred'>× 验证码不为空! </div>";
		}else{
			document.getElementById("co").innerHTML="<div class='cgre'>√ 格式正确 </div>";
		}
	});

});
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


<div class="clea"></div><br />
<br />
<br />
<div class="regs">
<div class="oform">
<form id="form1" name="form1" method="Post" action="/index.php/home/index/regin">
<ul>
<li class="ofa">用 户 名</li>
<li class="ofb"><input name="uname" type="text" id="uname" class="inpu"  value="" size="36" placeholder="请填写用户名" /> 
</li>
<li class="ofc"><span id="un">请填写用户名！</span></li>
</ul>
<ul>
<li class="ofa">设置密码</li>
<li class="ofb"><input name="pwd" type="password" id="pwd" class="inpu"  value="" size="36" placeholder="请填写密码" />
</li>
<li class="ofc"><span class="pw" id="pw">请填写密码！</span></li>
</ul>
<ul>
<li class="ofa">确认密码</li>
<li class="ofb"><input name="pwd2" type="password" id="pwd2" class="inpu"  value="" size="36" placeholder="再次输入密码" />
</li>
<li class="ofc"><span class="pw2" id="pw2">再次输入密码</span></li>
</ul>
<ul>
<li class="ofa">邮　　箱</li>
<li class="ofb"><input name="email" type="text" id="email" class="inpu"  value="" size="36" placeholder="请填写邮箱" />
</li>
<li class="ofc"><span class="em" id="em">请填写邮箱！</span></li>
</ul>
<ul>
<li class="ofa">验 证 码</li>
<li class="ofb"><input name="code" id="code" type="text"  value="" size="8" />
		  <img src="/index.php/Home/Public/code" onclick="this.src=this.src+'?'+Math.random()"></li>
<li class="ofc"><span class="em" id="co">请填写验证码！</span></li>
</ul>
<ul>
<li class="ofa"></li>
<li class="ofb"><input type="submit" name="Submit" value="注册" class="sub" />　<input type="reset" name="Submit" value="重置" class="sub" />
</li>
<li class="ofc"></li>
</ul>
	
</form>
</div>
</div>
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

 </body>
 </html>