<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" type="text/css" href="/Public/Css/obadmin.css" />
<form id="form1" name="form1" method="post" action="/index.php/admin/columns/inserts" enctype="multipart/form-data">

<table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="60" colspan="2" align="center" valign="middle"></td>
    </tr>
  <tr>
    <td width="60" height="30" align="center" valign="middle">栏目</td>
    <td width="540" height="30"><input name="typename" type="text"  value="" size="60" /></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30"><input type="submit" name="Submit" value="提交" class="oadd"/>	<input type="reset" name="Submit" value="重置" /></td>
  </tr>
</table>

</form>