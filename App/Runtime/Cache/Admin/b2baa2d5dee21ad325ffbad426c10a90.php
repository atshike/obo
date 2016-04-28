<?php if (!defined('THINK_PATH')) exit();?><html>
<link rel="stylesheet" type="text/css" href="/Public/Css/obadmin.css" />

<script type="text/javascript" src="/Public/js/jquery.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$(".ah").mousedown(function(){
			$(this).siblings(".oal").slideToggle();
		}
		);
	});
	
	/*
,function(){
			$(this).siblings(".oal").css("display","none");
		}
	*/
</script>
<body>
<div class="amenu">
	<div class="col">
		<li><div class="ah">文章管理</div>
			<div class="oal">
			<span><a href="/index.php/admin/index/articles" target="mainframe">文章列表</a></span>
			<span><a href="/index.php/admin/index/add" target="mainframe">文章添加</a></span>
			</div>
		</li>
		<li><div class="ah">栏目管理</div>
			<div class="oal">
				<span><a href="/index.php/admin/columns/columns" target="mainframe">栏目列表</a></span>
				<span><a href="/index.php/admin/columns/add" target="mainframe">栏目添加</a></span>
			</div>
		</li>
		<li><div class="ah">用户管理</div>
			<div class="oal">
				<span><a href="/index.php/admin/users/users" target="mainframe">用户列表</a></span>
				<span><a href="/index.php/admin/users/add" target="mainframe">添加用户</a></span>
			</div>
		</li>
	</div>
</div>
</body>
</html>