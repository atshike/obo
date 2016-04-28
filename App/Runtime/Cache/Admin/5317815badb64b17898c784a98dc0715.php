<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" type="text/css" href="/Public/Css/obadmin.css" />
<?php if(is_array($vo)): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><form id="form1" name="form1" method="post" action="/index.php/admin/columns/update" enctype="multipart/form-data">

<table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="60" colspan="2" align="center" valign="middle"></td>
    </tr>
  <tr>
    <td width="60" height="30" align="center" valign="middle">栏目</td>
    <td width="540" height="30">
	<input name="typename" type="text"  value="<?php echo ($vo["typename"]); ?>" size="60" />
	<input type="hidden" name="id" value="<?php echo ($vo["id"]); ?>" />
	</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30"><input type="submit" name="Submit" value="提交" class="oadd"/>	
	<input name="goback" type="button" class="oupda" id="goback"  onclick="javascript:window.history.back(-1);" value="返回"/>
	</td>
  </tr>
</table>

</form><?php endforeach; endif; else: echo "" ;endif; ?>