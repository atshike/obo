<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" type="text/css" href="/Public/Css/obadmin.css" />
<?php if(is_array($vo)): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><form id="form1" name="form1" method="post" action="/index.php/admin/index/update" enctype="multipart/form-data">

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
    <td height="34">&nbsp;</td>
    <td>
	<input type="submit" name="Submit" value="修改" class="oupda"/>&nbsp;&nbsp;&nbsp;&nbsp;
	<input name="goback" type="button" class="oupda" id="goback"  onclick="javascript:window.history.back(-1);" value="返回"/>
	</td>
  </tr>
</table>
	
</form><?php endforeach; endif; else: echo "" ;endif; ?>