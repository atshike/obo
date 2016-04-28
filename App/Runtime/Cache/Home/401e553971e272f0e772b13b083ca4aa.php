<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>信息添加-乄無时博客</title>
<link rel="stylesheet" type="text/css" href="/Public/Css/obthink.css" />

<script type="text/javascript" src="/Public/Js/Jquery.js"></script>
<script type="text/javascript" src="/Public/plugins/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="/Public/plugins/ueditor/ueditor.all.js"></script>

<script type="text/javascript" charset="utf-8">
window.UEDITOR_HOME_URL = "/Public/plugins/ueditor/";  //UEDITOR_HOME_URL、config、all这三个顺序不能改变
window.onload=function(){
	window.UEDITOR_CONFIG.initialFrameHeight=300;//编辑器的高度
	window.UEDITOR_CONFIG.imageUrl="<?php echo U('admin/Category/checkPic');?>";          //图片上传提交地址
	window.UEDITOR_CONFIG.imagePath=' /Uploads/thumb/';//编辑器调用图片的地址
	UE.getEditor('myEditor');//里面的contents是我的textarea的id值
   
	}
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
<form id="form1" name="form1" method="post" action="/index.php/home/index/insert" enctype="multipart/form-data">
<table width="818" height="537" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="77" height="39">标题</td>
    <td width="741">
      <input name="title" type="text"  value="" size="60" />    </td>
  </tr>
  <tr>
    <td height="37">栏目</td>
    <td>
	<select name="typeid" id="typename">
	 <?php if(is_array($atype)): foreach($atype as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["typename"]); ?></option><?php endforeach; endif; ?>
	</select>	</td>
  </tr>
  <tr>
    <td height="43">关键词</td>
    <td> <input name="keywords" type="text" value="" size="60" />
	<input type="hidden" name="voteid" value="0" />	</td>
  </tr>
    <tr>
    <td height="43">图片</td>
    <td> <input type="file" name="litpic" value="" class="infile"/></td>
  </tr>
  <tr>
    <td height="322" valign="top"><br />
内容</td>
    <td>
	
		<textarea id="myEditor" name="body" style="width:700px;height:300px;"> </textarea>  

	</td>
  </tr>
  <tr>
    <td height="44">验证码</td>
    <td><input name="code" type="text"  value="" size="8"/><img src="/index.php/Home/Public/code" onclick="this.src=this.src+'?'+Math.random()" class="ocode"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="40">
	<input type="submit" name="Submit" value="提交" class="oadd"/>	<input type="reset" name="Submit" value="重置" /></td>
  </tr>
</table>
	
</form>
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