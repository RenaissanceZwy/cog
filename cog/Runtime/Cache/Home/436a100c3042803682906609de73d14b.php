<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>登录&注册</title>
    <link rel="stylesheet" href="<?php echo (HOME_CSS); ?>login/login.css">
</head>
<body>
<!--初始化页面时候的背景图片-->
<div id="bgImg">
    <img class="bg-img" src="<?php echo (HOME_IMGS); ?>/bgImage2.jpg">
    <img class="bg-img" src="<?php echo (HOME_IMGS); ?>/bgImage.png">
</div>
<!--承载页面的div盒子-->
<div class="container">
    <!--承载logo以及游戏圈子div盒子-->
    <div class="logo">
        <img src="<?php echo (HOME_IMGS); ?>/whiteLogo.png">
        游戏圈子
    </div>
    <!--承载标语的div盒子-->
    <div class="slogan">发现另一个你！</div>
    <!--登录按钮-->
    <div id="login"><a href="<?php echo (URL); ?>/Login/main_login">登录</a></div>
    <!--注册按钮-->
    <div id="register"><a href="<?php echo (URL); ?>/Register/register">注册</a></div>
</div>
<script type="text/javascript" src="<?php echo (HOME_JS); ?>/jquery.js"></script>
<script>
    $(document).ready(function () {
        //页面加载完成后向上移动标语“发现另一个你”
        $(".slogan").fadeIn(1000).animate({"top": 100, "font-size": 35}, 1000);
        //自动更换背景函数
        var play = null;
        var i = 0;
        autoPlay();
        function autoPlay() {
            play = setInterval(function () {
                i++;
                if (i % 2 == 0) {
                    $(".bg-img:eq(1)").fadeIn(3000);
                    $(".bg-img:eq(2)").fadeOut(3000);
                } else {
                    $(".bg-img:eq(2)").fadeIn(3000);
                    $(".bg-img:eq(1)").fadeOut(3000);
                }
            }, 5000);
        }
    });
</script>
</body>
</html>