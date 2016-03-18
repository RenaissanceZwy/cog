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
  <!--  <form action="/cog/index.php/Home/CreateCircle/create_circle" method="post" enctype="multipart/form-data"> -->

         圈子名称：<input type="text" name="circle_name" value="" class="circle_name"></br>
       点击上传头像<input type="file" name="MyFile1"></br>
       圈子地址 <select name="circle_location" class="circle_location">
              <option>武汉市</option>
              <option>孝感市</option>
              <option>云梦县</option>
       </select></br>
        圈子游戏<select name="circle_game" class="circle_game">
              <option>梦幻西游</option>
              <option>三国杀</option>
              <option>英雄联盟</option>
       </select></br>
       圈子说明<input type="text" name="circle_describe" value="" class="circle_describe"></br>
       <input type="submit" name="submit" value="创建" id="submit"></br>
  

    <script type="text/javascript" src="<?php echo (HOME_JS); ?>test/jquery.js"></script>
    <script type="text/javascript" src="<?php echo (HOME_JS); ?>test/jquery.form.js"></script>
    <script type="text/javascript">
       // 对评论进行局部刷新
      $('#submit').click(function(){
        var name=$('.circle_name').val();
        var location=$('.circle_location').val();
        var game=$('.circle_game').val();
        var describe=$('.circle_describe').val();
        $.post("<?php echo (URL); ?>CreateCircle/CreateCircle",{'circle_name':name,'circle_location':location,'circle_game':game,'circle_describe':describe},function(data){
            window.location.reload();
        },'json');
      });
    </script>
</body>
</html>