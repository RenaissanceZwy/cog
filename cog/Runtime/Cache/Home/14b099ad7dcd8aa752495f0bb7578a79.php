<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>注册</title>
    <link href="<?php echo (HOME_CSS); ?>register/register.css" type="text/css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="main">
        <div class="logo">
            <img src="<?php echo (HOME_IMGS); ?>/redLogo.png">
        </div>
        <h1>游戏圈子</h1>

        <h3>发现另一个你！</h3>
        <ul class="register-mode">
            <li class="active" style="border-right: 1px solid rgb(212 ,216,220)">手机号注册</li>
            <li>邮箱注册</li>
        </ul>
        <div class="mode">
            <form method="POST" action="<?php echo (URL); ?>Register/tele_regist">
                <input maxlength="11" pattern="^1[3|4|5|8]\d{9}$" required id="phone-input" type="text"
                       placeholder="请输入手机号">
                <label id="isPhone"></label>
                <input maxlength="4" required id="yzm" type="text" placeholder="图片验证码"
                       style="top:74px ;width:120px;" onblur="validate()">
                <!--验证码-->
                <input required type="button" id="checkCode" onClick="createCode()" title="刷新验证码"
                       style="width:50px;color:#F00;border:0;letter-spacing:1px;font-family:'Microsoft YaHei',sans-serif;"/>
                <label id="isCode"></label>
                <input required maxlength="6" type="text" placeholder="手机验证码" style="top:128px ;width:120px;">
                <button id="send">发送验证码</button>
                <button type="submit" class="register" style="top:182px">注&nbsp;册</button>
            </form>
            <p style="top:226px">点击注册，表明您同意我们的《服务条款》</p>
        </div>
        <div class="mode" style="display: none">
            <form method="POST" action="<?php echo (URL); ?>Register/mail_regist">
                <input id="email" required type="email" placeholder="邮箱" name="Email">
                <label id="isEmail"></label>
                <input required id="name" type="text" pattern="^[a-zA-Z\d]\w{0,11}[a-zA-Z\d]$" name="username"
                       placeholder="用户名"
                       style="top:74px ;">
                <label id="isName"></label>
                <input maxlength="16" required id="password1" name="password" type="password" placeholder="密码"
                       style="top:128px ;">
                <label id="isPassword1"></label>
                <input maxlength="16" required id="password2" type="password" placeholder="请再次输入密码"
                       onblur="checkPassword()" style="top:182px ;">
                <label id="isSamePassword"></label>
                <button type="submit" class="register" style="top:236px">注&nbsp;册</button>
                <p style="top:280px">点击注册，表明您同意我们的《服务条款》</p>
            </form>
        </div>
        <hr size="2" color="#eef0f2" width="100%">
        <a class="return" href="<?php echo (URL); ?>Login/main_login">返回登录</a>
    </div>
</div>
<script type="text/javascript" src="<?php echo (HOME_JS); ?>/jquery.js"></script>
<script type="text/javascript" src="<?php echo (HOME_JS); ?>test/jquery.form.js"></script>
<script>
    $(document).ready(function(){
        //提醒用户不能使用手机来注册账号
        $("#send").click(function () {
            alert("如果手机不能获取验证码，请使用邮箱来注册账号！");
        });

        //手机号注册以及邮箱注册按钮被点击事件
        $(".register-mode li").click(function () {
            var index = $(this).index();
            $('.mode').eq(index).show().siblings('.mode').hide();
            $(this).addClass("active").siblings().removeClass('active');
        });

        //手机号输入框失去焦点事件
        $("#phone-input").blur(function () {
            var phoneNo = $("#phone-input").val();
            isPhoneNo(phoneNo);
        });

        // 判断是否为手机号码函数
        function isPhoneNo(str) {
            if (str.length == 0) {
                $("#isPhone").css("color", "red").text("请输入手机号码");
                return false;
            }
            else if (str && /^1[3|4|5|8]\d{9}$/.test(str)) {
                $("#isPhone").css("color", "green").text("手机格式正确");
                return true;
            } else {
                $("#isPhone").css("color", "red").text("手机格式有误");
                return false;
            }
        }

        //验证码
        var code;
        //验证码生成函数
        function createCode() {
            code = new Array();
            var codeLength = 4;
            var checkCode = document.getElementById("checkCode");
            checkCode.value = "";
            var selectChar = new Array(2, 3, 4, 5, 6, 7, 8, 9, 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K', 'L', 'M', 'N', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
            for (var i = 0; i < codeLength; i++) {
                var charIndex = Math.floor(Math.random() * 32);
                code += selectChar[charIndex];
            }
            checkCode.value = code;
        }

        //创建验证码
        createCode();

        //检查验证码输入是否正确
        function validate() {
            var inputCode = document.getElementById("yzm").value.toUpperCase();
            if (inputCode.length == 0) {
                $("#isCode").css("color", "red").text("请输入验证码");
                return false;
            }
            else if (inputCode != code) {
                $("#isCode").css("color", "red").text("验证码输入有误");
                $(".register").css("background", "#ccc").attr("disabled", disabled);
                return false;
            }
            else {
                $("#isCode").css("color", "green").text("验证码输入正确");
                return true;
            }
        }

        //检查邮箱格式是否正确
        function checkMail(mail) {
            var filter = /^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/;
            if (mail.length == 0) {
                $("#isEmail").css("color", "red").text("邮箱不能为空");
                return false;
            }
            else if (filter.test(mail)) {
                $("#isEmail").css("color", "green").text("邮箱格式正确");
                return true;
            }
            else {
                $("#isEmail").css("color", "red").text("邮箱格式错误");
                return false;
            }
        }

        //邮箱输入表单失去焦点事件
        $("#email").blur(function () {
            var emailStr = $("#email").val();
            checkMail(emailStr);
        });

        //用户名输入表单失去焦点事件
        $("#name").blur(function () {
            var nameStr = $("#name").val();
            $.post("<?php echo (URL); ?>Login/check_name", {'name': nameStr}, function (data) {
                if (data == false) {
                } else {
                    $("#isName").css("color", "red").text("用户名已存在");
                }
            }, 'json');
            var filter = /^[a-zA-Z\d]\w{0,11}[a-zA-Z\d]$/;
            if (nameStr.length == 0) {
                $("#isName").css("color", "red").text("用户名不能为空");
                return false;
            }
            else if (filter.test(nameStr)) {
                $("#isName").css("color", "green").text("用户名格式正确");
                return true;
            }
            else {
                $("#isName").css("color", "red").text("用户名格式错误");
                return false;
            }
        });

        //密码输入框失去焦点事件
        $("#password1").blur(function () {
            var str = $("#password1").val();
            if (str.length == 0) {
                $("#isPassword1").css("color", "red").text("密码不能为空");
            } else {
                $("#isPassword1").css("color", "green").text("密码格式正确");
            }
        });

        //再次输入密码失去焦点函数
        $("#password2").blur(function(){
            checkPassword();
        });
        //检查两次密码是否输入一致函数
        function checkPassword() {
            var str1 = $("#password1").val();
            var str2 = $("#password2").val();
            if (str1.length != 0) {
                if (str1 != str2) {
                    $("#isSamePassword").css("color", "red").text("两次密码不相同");
                    $(".register").css("background", "#ccc").attr("disabled", "disabled");
                } else {
                    $("#isSamePassword").css("color", "green").text("两次密码相同");
                    $(".register").css("background", "rgb(92, 185, 92)").attr("disabled", false);
                }
            }
        };
    });
</script>
</body>
</html>