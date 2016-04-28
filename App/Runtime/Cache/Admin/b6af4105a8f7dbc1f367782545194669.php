<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" type="text/css" href="/Public/Css/obadmin.css" />
<div class="am">
<h2>用户列表</h2>
<?php if(is_array($list)): foreach($list as $key=>$vo): ?><li>
<span class="ilsc">[<?php echo ($vo["id"]); ?>] <?php echo ($vo["uname"]); ?> <?php echo (date('Y-m-d',$vo["logintime"])); ?> <?php echo ($vo["loginip"]); ?></span> 
<span class="ilsd">
<a href="/index.php/admin/users/edit/id/<?php echo ($vo["id"]); ?>" class="ilsdb">修改</a>  <a href="/index.php/admin/users/del/id/<?php echo ($vo["id"]); ?>" class="ilsda">删除</a></span>
</li><?php endforeach; endif; ?>  
<div class="pages"><?php echo ($show); ?></div>
</div>