<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>找回密码</title>
    <link href="<?php echo (HOME_CSS); ?>findback/findback.css" type="text/css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="main">
        <div class="logo">
            <img src="<?php echo (HOME_IMGS); ?>/redLogo.png">
        </div>
        <h1>游戏圈子</h1>
        <h3>发现另一个你！</h3>
        <ul class="find-mode">
            <li  class= "active" style="border-right: 1px solid rgb(212 ,216,220 )">通过绑定手机找回</li>
            <li>通过绑定邮箱找回</li>
        </ul>
        <div class="mode">
            <form>
                <label style="position: absolute;top:-10px;left: 130px;"></label>
                <input  maxlength="11" required pattern="^1[3|4|5|8]\d{9}$" type="text" placeholder="请输入手机号">
                <button class="send">发送验证码</button>
                <input type="text" placeholder="请输入验证码" style="top:80px">
                <button type="submit"  class="ensure" >确&nbsp;定</button>
            </form>
            <p style="top:226px"></p>
        </div>
        <div class="mode" style="display: none">
               <form>
                   <label style="position: absolute;top:-10px;left: 130px;"></label>
                    <input required type="email" placeholder="请输入邮箱号">
                    <button  class="send">发送验证码</button>
                    <input type="text" placeholder="请输入验证码" style="top:80px">
                    <button type="submit" class="ensure" >确&nbsp;定</button>
                </form>
        </div>
        <hr size="2" color="#eef0f2" width="100%">
        <a class="return" href="<?php echo (URL); ?>Login/main_login">返回登录</a>
    </div>
</div>
<script type="text/javascript" src="<?php echo (HOME_JS); ?>/jquery.js"></script>
<script>
    $(document).ready(function(){
        //通过邮箱找回与通过手机找回点击事件
        $(".find-mode li").click(function(){
            var index = $(this).index();
            $('.mode').eq(index).show().siblings('.mode').hide();
            $(this).addClass("active").siblings().removeClass('active');
        });

        //提醒用户找回密码功能暂未实现
        $(".mode form input").click(function(){
            $("label").css("color","red").html("找回功能暂未实现");
        });
    });
</script>
</body>
</html>