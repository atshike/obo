<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" type="text/css" href="/Public/Css/obadmin.css" />
<div class="userlist">
<h4>用户列表</h4>
<ul>
<?php if(is_array($list)): foreach($list as $key=>$vo): ?><li>[<?php echo ($vo["id"]); ?>] 
<a href="/index.php/admin/users/showm/id/<?php echo ($vo["id"]); ?>" title="<?php echo ($vo["title"]); ?>" class="ilsb">
<?php echo (msubstr($vo["uname"],0,50,'utf-8',false)); ?>
</a> <span class="ilsc"><?php echo (date('Y-m-d',$vo["logintime"])); ?></span> 
    
</li><?php endforeach; endif; ?>  
 </ul>
<div class="pages"><?php echo ($show); ?></div>
</div>