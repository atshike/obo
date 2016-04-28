<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>更新-乄無时博客</title>
<link rel="stylesheet" type="text/css" href="/Public/Css/obthink.css" /> 
<?php if(is_array($vo)): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?></head>

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
<form id="form1" name="form1" method="post" action="/index.php/home/index/update" enctype="multipart/form-data">

<table width="826" height="470" border="0" align="center" cellpadding="0" cellspacing="0" style="position:relative;">
  <tr>
    <td width="121" height="40">标题</td>
    <td width="705" height="40">
	
      <input name="title" type="text"  value="<?php echo ($vo["title"]); ?>" size="60" />    </td>
  </tr>
  <tr>
    <td height="40">栏目</td>
    <td height="40">
	<select name="typeid">
		<option value="<?php echo ($vo["typeid"]); ?>"><?php echo ($vo["typename"]); ?></option>
		<?php if(is_array($atype)): foreach($atype as $key=>$va): ?><option value="<?php echo ($va["id"]); ?>"><?php echo ($va["typename"]); ?></option><?php endforeach; endif; ?>
	</select>	</td>
  </tr>
   <tr>
    <td height="60">图片</td>
    <td>  
<table width="100%" height="60" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="200"><input type="text" name="litpics" value="<?php echo ($vo["litpic"]); ?>" class="infile"/><input type="file" name="litpic"  class="infile"/></td>
    <td><?php if($vo["litpic"] != '' ): ?><img src="<?php echo ($vo["litpic"]); ?>" width="130" height="130" style="position: absolute; right:100px; margin:5px; padding:5px; border:1px solid #efefef;"><?php endif; ?></td>
  </tr>
</table>

</td>
  </tr>
  <tr>
    <td height="40">关键词</td>
    <td height="40"> <input name="keywords" type="text" value="<?php echo ($vo["keywords"]); ?>" size="60" />
	<input type="hidden" name="id" value="<?php echo ($vo["id"]); ?>" />
	<input type="hidden" name="voteid" value="0" />	</td>
  </tr>
	<tr>
	<td height="351" valign="top">	<br /><br />内容</td>
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
	<td><textarea id="myEditor" name="body" style="width:700px;height:300px;"> <?php echo ($vo["body"]); ?></textarea>  
 
	</td>
	</tr>
	<tr>
    <td height="44">验证码</td>
    <td><input name="code" type="text"  value="" size="8"/><img src="/index.php/Home/Public/code" onclick="this.src=this.src+'?'+Math.random()" class="ocode"></td>
  </tr>
  <tr>
    <td height="34">&nbsp;</td>
    <td>
	<input type="submit" name="Submit" value="修改" class="oupda"/></td>
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
 </html><?php endforeach; endif; else: echo "" ;endif; ?>