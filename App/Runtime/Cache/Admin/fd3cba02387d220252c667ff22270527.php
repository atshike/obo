<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" type="text/css" href="/Public/Css/obadmin.css" />
<form id="form1" name="form1" method="post" action="/index.php/admin/index/insert" enctype="multipart/form-data">
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
    <td><textarea id="myEditor" name="body" style="width:700px;height:300px;"></textarea>  
 
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="40">
	<input type="submit" name="Submit" value="提交" class="oadd"/>	<input type="reset" name="Submit" value="重置" /></td>
  </tr>
</table>
	
</form>