<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" type="text/css" href="/Public/Css/obadmin.css" />
<form id="form1" name="form1" method="post" action="/index.php/admin/users/insert" enctype="multipart/form-data">
<table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="60" colspan="2" align="center" valign="middle"></td>
    </tr>
  <tr>
    <td width="60" height="30" align="center" valign="middle">用户名：</td>
    <td width="540" height="30">
	<input name="uname" type="text"  value="" size="60" />
	</td>
  </tr>
    <tr>
    <td width="60" height="30" align="center" valign="middle">密 码：</td>
    <td width="540" height="30">
	<input name="pwd" type="password"  value="" size="60" />
	</td>
  </tr>
      <tr>
    <td width="60" height="30" align="center" valign="middle">邮 箱：</td>
    <td width="540" height="30">
	<input name="email" type="text"  value="" size="60" />
	</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30"><input type="submit" name="Submit" value="添加" class="oadd"/>	
	<input name="goback" type="button" class="oupda" id="goback"  onclick="javascript:window.history.back(-1);" value="返回"/>
	</td>
  </tr>
</table>
</form>