<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" type="text/css" href="/Public/Css/obadmin.css" />
<div class="am">
<h2>文章列表</h2>
<?php if(is_array($list)): foreach($list as $key=>$vo): ?><li>
<span class="ilsc">[<?php echo ($vo["typename"]); ?>] <?php echo (msubstr($vo["title"],0,50,'utf-8',false)); ?> <?php echo (date('Y-m-d',$vo["senddate"])); ?></span> 
<span class="ilsd"> <a href="/index.php/admin/index/edit/id/<?php echo ($vo["id"]); ?>" class="ilsdb">修改</a>  <a href="/index.php/admin/index/del/id/<?php echo ($vo["id"]); ?>" class="ilsda">删除</a></span>
</li><?php endforeach; endif; ?>
<div class="pages"><?php echo ($show); ?></div>
</div>