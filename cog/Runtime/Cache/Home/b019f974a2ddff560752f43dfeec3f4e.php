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
      这里是个人简介，不能够编辑</br>
      <?php if(is_array($user)): $i = 0; $__LIST__ = $user;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><a href="/cog/index.php/Home/Follow/entrance?userid=<?php echo ($data["user"]); ?>">进入用户<?php echo ($data["user"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
        你好用户<?php echo ($username); ?>
	  <form method="post" action="/cog/index.php/Home/Follow/follow">
      <input type="hidden" name="user_id" value="<?php echo ($user_id); ?>">
      <input type="submit" name="submit" value="关注">
      <input type="submit" name="submit" value="取消关注">
    </form>
    <script type="text/javascript" src="<?php echo (HOME_JS); ?>test/jquery.js"></script>
    <script type="text/javascript" src="<?php echo (HOME_JS); ?>test/jquery.form.js"></script>
    <script type="text/javascript">
    </script>
</body>
</html>