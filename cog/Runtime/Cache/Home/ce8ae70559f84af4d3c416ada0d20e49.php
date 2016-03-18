<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html  onselectstart="return false">
<head lang="en">
    <meta charset="UTF-8">
    <title>游戏圈子-首页</title>
    <link rel="icon" href="../../../Public/images/icon.ico" >
    <style>
    </style>
</head>
<body>
      这里是个人简介，自己能够编辑</br>
      <?php if(is_array($user)): $i = 0; $__LIST__ = $user;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><a href="/cog/index.php/Home/Follow/entrance?userid=<?php echo ($data["user"]); ?>">进入用户<?php echo ($data["user"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
        你好用户<?php echo ($user_name); ?></br>
	
    关注列表：</br>
    <?php if(is_array($follow_result)): $i = 0; $__LIST__ = $follow_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><span>
                <a href="/cog/index.php/Home/Follow/entrance?userid=<?php echo ($data["user_id"]); ?>">你在关注用户<?php echo ($data["user_id"]); ?></a>
                <a href="/cog/index.php/Home/Follow/follow_cancel?userid=<?php echo ($data["user_id"]); ?>"><input type="button" value="取消关注"></a>
                
               </span></br><?php endforeach; endif; else: echo "" ;endif; ?>
    <script type="text/javascript" src="<?php echo (HOME_JS); ?>test/jquery.js"></script>
    <script type="text/javascript" src="<?php echo (HOME_JS); ?>test/jquery.form.js"></script>
    <script type="text/javascript">
    </script>
</body>
</html>