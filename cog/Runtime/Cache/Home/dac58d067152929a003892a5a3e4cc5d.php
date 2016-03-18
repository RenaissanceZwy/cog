<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>具体信息</title>
    <link href="<?php echo (HOME_CSS); ?>information/information.css" type="text/css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1>个人信息</h1>
    <img id="logo-img" width="80" height="80" src="<?php echo (HOME_IMGS); ?>greenLogo.png">

    <div class="username">
        <p>用户名:&nbsp;&nbsp;&nbsp;<span style="color: orange"><?php echo ($username); ?></span></p>
    </div>
    <form enctype="multipart/form-data" method="POST" action="<?php echo (URL); ?>Information/information_add">
        <div class="gender">
            <p>性别:</p>
            <label> <input name="radio" type="radio">男</label>
            <label> <input name="radio" type="radio">女</label>
        </div>
        <img style="box-shadow: 0 0 5px gray;" width="100" height="100" id='preview-3' class="photo">
        <input required onchange='setImagePreview3()' accept='image/*' type="file" name="MyFile" id="post">
        <div id="upload-img">上传头像</div>
        <div class="birthday">
            <label>生日：</label>
            <select required id="select_year" name="select_year" style="margin-left: 50px"></select>年
            <select required id="select_month" name="select_month"></select>月
            <select required id="select_day" name="select_day"></select>日
        </div>
        <div class="email">
            <p>电子邮箱:</p>
            <input required id="email" type="email">
            <label id="isEmail"></label>
        </div>
        <div class="position">
            <p>居住地:</p>
            <select required name="province" class="select-area1" style="margin-left: 52px;">
            </select>

            <select required name="city">
            </select>

            <select required name="area">
            </select>
        </div>
        <div class="personal-note">
            <p>个人说明：</p>
            <textarea class="personal-note-content" name="note"></textarea>
        </div>
        <input type="submit" id="complete" value="完成">
    </form>
</div>
<script src="<?php echo (HOME_JS); ?>/jquery.js"></script>
<script src="<?php echo (HOME_JS); ?>concrete-information/birthday.js"></script>
<script src="<?php echo (HOME_JS); ?>concrete-information/PCASClass.js"></script>
<script src="<?php echo (HOME_JS); ?>test/jquery.form.js"></script>
<script>
    $(function () {
        $.ms_DatePicker({
            YearSelector: "#select_year",
            MonthSelector: "#select_month",
            DaySelector: "#select_day"
        });
    });
    new PCAS("province", "city", "area", "", "", "");
    $(document).ready(function () {
        $(".container").fadeIn(500).animate({"top": 0}, 500);
    });

    //下面用于图片上传预览功能3
    function setImagePreview3(avalue) {
        var docObj = document.getElementById("post");
        var imgObjPreview = document.getElementById("preview-3");
        if (docObj.files && docObj.files[0]) {
            //火狐下，直接设img属性
            imgObjPreview.style.display = 'block';
            imgObjPreview.style.width = '100px';
            imgObjPreview.style.height = '100px';
            //imgObjPreview.src = docObj.files[0].getAsDataURL();

            //火狐7以上版本不能用上面的getAsDataURL()方式获取，需要一下方式
            imgObjPreview.src = window.URL.createObjectURL(docObj.files[0]);
        }
        else {
            //IE下，使用滤镜
            docObj.select();
            var imgSrc = document.selection.createRange().text;
            var localImagId = document.getElementsByClassName("localImag-3");
            //必须设置初始大小
            localImagId.style.width = "100px";
            localImagId.style.height = "100px";
            //图片异常的捕捉，防止用户修改后缀来伪造图片
            try {
                localImagId.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)";
                localImagId.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = imgSrc;
            }
            catch (e) {
                alert("您上传的图片格式不正确，请重新选择!");
                return false;
            }
            imgObjPreview.style.display = 'none';
            document.selection.empty();
        }
        return true;
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

    //性别选择事件
    $("input[name='radio']").click(function () {
        if ($(this).prop("checked")) {
            $(this).parent("label").css('color', 'orange').siblings().css("color", "black");
        }
    });
</script>
</body>
</html>