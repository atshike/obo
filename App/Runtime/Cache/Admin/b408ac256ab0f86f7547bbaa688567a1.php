<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" type="text/css" href="/Public/Css/obadmin.css" />
<div class="aheader">
<div class="head">
<h2>后台管理</h2>
<?php if(($_SESSION['uname'] != '')): ?>欢迎您，<?php echo ($_SESSION['uname']); ?> <a href="/index.php/home/member/">[用户中心]</a> &nbsp;&nbsp;[<a href="/index.php/admin/index/add">发布</a>]&nbsp;&nbsp; <a href="javascript:parent.location.replace('logout');">[退出]</a>
<?php else: ?> 
<script>
	parent.location.replace('log');
</script><?php endif; ?>
</div>
</div>