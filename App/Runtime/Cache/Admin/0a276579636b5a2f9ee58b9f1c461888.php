<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" type="text/css" href="/Public/Css/obadmin.css" />
<div class="am">
<h2>栏目列表</h2>
<?php if(is_array($list)): foreach($list as $key=>$vo): ?><li><span class="ilsc">[<?php echo ($vo["id"]); ?>] 
<a href="/index.php/admin/columns/showm/id/<?php echo ($vo["id"]); ?>" title="<?php echo ($vo["title"]); ?>" class="ilsb">
<?php echo (msubstr($vo["typename"],0,50,'utf-8',false)); ?></a><span class="ilsd"> <a href="/index.php/admin/columns/edit/id/<?php echo ($vo["id"]); ?>" class="ilsdb">修改</a>  <a href="/index.php/admin/columns/del/id/<?php echo ($vo["id"]); ?>" class="ilsda">删除</a></span>
</a> 
</li><?php endforeach; endif; ?>  
<div class="pages"><?php echo ($show); ?></div>
</div>