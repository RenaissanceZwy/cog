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
	 <!--  <form method="post" action="/cog/index.php/Home/Follow/login_pro"> -->
      <input type="text" id="name" name="username" class="username"><div class="result"></div>
      <input type="text" id="pwd" name="password" class="password">
      <input type="submit" name="submit" class="submit" value="登录" onclick="submit()">
    <!-- </form> -->
    <script type="text/javascript" src="<?php echo (HOME_JS); ?>test/jquery.js"></script>
    <script type="text/javascript" src="<?php echo (HOME_JS); ?>test/jquery.form.js"></script>
    <script type="text/javascript">
    // function tijiao()
    // {
    //     var name = document.getElementById('name').value;
    //     var pwd = document.getElementById('pwd').value;
    //     var xhr = new XMLHttpRequest();
    //     xhr.open('get','/cog/index.php/Home/Follow/login_pro?name='+name+'&pwd='+pwd);
    //     xhr.send(null);
    //     xhr.onreadystatechange = function()
    //     {
    //         if(xhr.readyState == 4)
    //         {
    //             if(xhr.responseText)
    //             {
    //                 alert(xhr.responseText);
    //             }
    //         }
    //     }
    // }
    // function submit(){
    //     var username=$('.username').val();
    //     var password=$('.password').val();
    //     $.post('/cog/index.php/Home/Test/login_pro',{'username':'username','password':'password'},function(data){
    //              window.location.reload();
    //              alert(1);
    //     },'json');
    // }
    $('.submit').click(function(){
        var username=$('.username').val();
        var password=$('.password').val();
        $.post('/cog/index.php/Home/Test/login_pro',{'name':username,'password':password},function(data){
                 if(data.status==1){
                    alert(data.back);
                 }else{
                    alert(data.info);
                 }
        },'json');
    });

    // $('.submit').click(function(){
    //     var username=$('.username').val();
    //     var password=$('.password').val();
    //      $.ajax({
    //         url: "/cog/index.php/Home/Test/login_pro",    //请求的url地址
    //         // dataType: "json",   //返回格式为json
    //         async: true, //请求是否异步，默认为异步，这也是ajax重要特性
    //         data: { 'name':username,'password':password},    //参数值
    //         type: "post",   //请求方式
    //         beforeSend: function() {
    //             //请求前的处理
    //         },
    //         success: function(data) {
    //             //请求成功时处理
    //             if(data.status==1){
    //                 alert(data.back);
    //             }else{
    //                 alert(0);
    //             }
    //         },
    //         complete: function() {
    //             //请求完成的处理
    //             // alert(1);
    //         },
    //         error: function() {
    //             //请求出错处理
    //         }
    //     });
    // });
    </script>
</body>
</html>