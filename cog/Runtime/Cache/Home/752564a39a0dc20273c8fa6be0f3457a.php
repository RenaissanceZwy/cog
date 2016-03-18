<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>登录</title>
    <link rel="stylesheet" href="<?php echo (HOME_CSS); ?>login/main-login.css">
</head>
<body>
<!--承载页面的div盒子-->
<div class="container">
    <!--登陆的主要区域-->
    <div class="main">
        <!--logo图片区域-->
        <div class="logo">
            <img src="<?php echo (HOME_IMGS); ?>/greenLogo.png">
        </div>
        <!--游戏圈子标语-->
        <h1>游戏圈子</h1>
        <!--发现另一个你标语-->
        <h3>发现另一个你！</h3>
        <ul class="login-mode">
            <li class="active" style="border-right: 1px solid rgb(212 ,216,220 )">账号登录</li>
            <li>微信登录</li>
        </ul>
        <form name="login" method="POST" action="<?php echo (URL); ?>Login/handle">
            <div class="mode">
                <input type="text" id="name" name="username" placeholder="邮箱/用户名/手机">

                <p id="resname"></p>
                <input type="password" id="pwd" name="password" placeholder="密码" style="top:80px">

                <p id="respwd"></p>
            </div>
            <div class="mode" style="display: none">
                <input type="text" placeholder="微信账号">
                <input type="password" placeholder="密码" style="top:80px">
                <label id="mess-mode" style="position: absolute;top:-10px;right: 80px;"></label>
            </div>
            <input type="submit" id="login" value="登录">
            <hr size="1" color="#eef0f2" width="100%">
        </form>
        <ul class="forget-password">
            <li style="border-right: 1px solid rgb(212 ,216,220 )"><a
                    href="<?php echo (URL); ?>Findback/findback">忘记密码</a></li>
            <li><a href="<?php echo (URL); ?>Register/register">免费注册</a></li>
        </ul>
    </div>
</div>
<script type="text/javascript" src="<?php echo (HOME_JS); ?>/jquery.js"></script>
<script>
    $(document).ready(function () {
        //账号登录与微信登录被点击事件
        $(".login-mode li").click(function () {
            var index = $(this).index();
            $('.mode').eq(index).show().siblings('.mode').hide();
            $(this).addClass("active").siblings().removeClass('active');
        });
        //微信登录被点击事件
        $(".mode:nth-child(2) input").click(function () {
            $("#mess-mode").css("color", "red").html("暂时不支持微信账号登录！");
        });
        //验证用户名是否存在
        $('#name').blur(function () {
            var name = $(this).val();
            $.ajax({
                type: 'POST',
                url: "<?php echo (URL); ?>Login/check_name",
                data: {'name': name},
                success: function (data) {
                    if (name.length == 0) {
                        $('#resname').css("color", "red").html('用户名不能为空');
                    } else if (data == true) {
                        $('#resname').css("color", "green").html('用户名正确');

                    } else if (data == false) {
                        $('#resname').css("color", "red").html('用户名不存在');
                    }
                },
                dataType: 'json'
            });
        });
        // 检验密码是否正确
        $('#pwd').blur(function () {
            var pwd = $(this).val();
            var name = $('#name').val();
            $.ajax({
                type: 'POST',
                url: "<?php echo (URL); ?>Login/check_pwd",
                data: {'pwd': pwd, 'name': name},
                success: function (data) {
                    if (data == true) {
                        $('#respwd').css("color", "green").html('密码正确');
                    } else if (data == false) {
                        $('#respwd').css("color", "red").html('密码错误');
                    }
                },
                dataType: 'json'
            });
        });
    });
</script>
</body>
</html>