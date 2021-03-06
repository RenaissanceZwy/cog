<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>帖子界面</title>
    <link rel="stylesheet" href="<?php echo (HOME_CSS); ?>user/user.css">
</head>
<body>
<!--nav导航条信息1-->
<div id="gray"></div>
<!--nav导航条信息1-->
<div class="nav-container">
    <img class="nav-logo" src="<?php echo (HOME_IMGS); ?>redLogo.png" title="logo">
    <img class="nav-caption" src="<?php echo (HOME_IMGS); ?>caption.png" title="发现另一个你！">
    <ul class="nav-bar">
        <li><a href="<?php echo (URL); ?>Index/index">首页</a></li>
        <li><a href="<?php echo (URL); ?>Circle/index">圈子</a></li>
        <li><a href="<?php echo (URL); ?>Game/index">游戏</a></li>
        <li><a href="<?php echo (URL); ?>MyCircle/index">我的圈子</a></li>
    </ul>
    <form action="" class="nav-form">
        <input class="nav-form-search" type="text" placeholder="搜索附近的圈子">
        <input class="nav-form-submit" style="background: url('<?php echo (HOME_IMGS); ?>search.png') no-repeat center"
               type="submit" value="">
    </form>
</div>

<!--贴子主体部分-->
<input type="hidden" name="post_id" class="post_id" value="<?php echo ($post_id); ?>">

<div id="main-container">
    <?php if(is_array($post)): $i = 0; $__LIST__ = $post;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$post): $mod = ($i % 2 );++$i;?><h4 style="line-height: 30px;margin-left: 20px;">
            <?php echo ($post["post_circle_id"]); ?>-><?php echo ($post["post_game"]); ?>-><?php echo ($post["post_server"]); ?></h4>

        <div id="main">
            <div class="main-title-main">
                <div class="main-title"><strong><?php echo ($post["post_title"]); ?></strong></div>
                <div class="main-admin">
                    <!-- 判断是否是管理员 -->
                    <?php if($user_id==$monitor_id){ ?>
                    <!-- <a href="/cog/index.php/Home/Circle/boutique?post_id=<?php echo ($post["post_id"]); ?>"> -->
                    <p class="admin-boutique" data-id="<?php echo ($post["post_id"]); ?>">加精</p>
                    <!--  </a> -->
                    <?php } ?>
                    <?php if($post['post_user']==$user_id || $monitor_id==$user_id){ ?>
                    <!-- <a href="<?php echo (URL); ?>Circle/delete_post?post_id=<?php echo ($post["post_id"]); ?>"> -->
                    <div class="admin-delete" data-id="<?php echo ($post["post_id"]); ?>">删除该帖</div>
                    <!--  </a> -->
                    <?php } ?>
                </div>
            </div>
            <div class="main-time">发帖：<strong style="color: blueviolet"><?php echo ($post["post_user"]); ?></strong >&nbsp; 时间<strong style="color: blueviolet"><?php echo ($post["post_time"]); ?></strong></div>
            <div class="main-context">
                <?php echo ($post["post_content"]); ?><br><br><br><br><br><br><br>
            </div>
            <input type="hidden" class="post_id" value="<?php echo ($post["post_id"]); ?>"/>

            <div class="collect-btn">收藏</div>
            <div class="share-btn"><img src="<?php echo (HOME_IMGS); ?>user/1.png"></div>
            <div class="share">
                <img src="<?php echo (HOME_IMGS); ?>user/2.png" alt="">
            </div>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
    <div id="reply-interface">

        <button class="comment-post-btn">点击评论</button>

        <!-- 评论输入框-->
        <!--  <form style="display: none;" class='comment-form-1' action="<?php echo (URL); ?>User/comment" method="post"> -->
        <form style="display: none;" class='comment-form-1' action="" method="">
            <textarea name='comment' placeholder='请输入评论内容' class="form-1-comment"></textarea>

            <div class='upload-pic'>图片</div>
            <div id='localImag-1' style='display: none;top: 150px;left: 20px;position: absolute'>
                <img id='preview-1' border='none' width='50' height='50' style='display:block;width: 50px;height: 50px;'>
            </div>
            <input id='doc-1' style='display: none;color: gray;' onchange='setImagePreview1();' accept='image/*'
                   type='file'>

            <div class='upload-expressions'>表情</div>
            <input type='submit' id="comment-submit-1" name="submit" value="评论">
        </form>
        <!-- 主评论显示内容 -->
        <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i; if($data['comment_pid']==0){ ?>
            <!-- 主评论显示 -->
            <div class="comment-box">
                <div class="comment-information">
                    <img src="/cog/<?php echo ($data["user_headimg"]); ?>" title="用户头像" width="70" height="70">

                    <p class="users-name" style="width:auto;text-align: center"><?php echo ($data["user_name"]); ?></p>

                    <p class="users-rank" style="width:auto;text-align: center">等级:<?php echo ($data["user_level"]); ?></p>
                </div>
                <div class="comment-context">
                    <?php echo ($data["comment_content"]); ?><span class="data_comment_id" style="display:none"><?php echo ($data["comment_id"]); ?></span>

                    <div class="comment-time">时间：<?php echo ($data["comment_time"]); ?></div>
                    <!-- 判断用户权限 -->
                    <?php if($data['comment_user_id']==$user_id){ ?>
                    <!-- <a href="/cog/index.php/Home/User/delete_comment?comment_id=<?php echo ($data["comment_id"]); ?>"> -->
                    <button class="delete-btn" data-id="<?php echo ($data["comment_id"]); ?>">删除</button><!-- </a> -->

                    <?php } ?>
                    <button class="reply-btn" value="<?php echo ($data["comment_id"]); ?>">回复</button>
                    <button class="view-reply-btn">点击查看</button>
                </div>
                <!-- 主评论回复 -->
                <!-- <form style="display: none;" class='box comment-form-2' action="<?php echo (URL); ?>User/comment?comment_id=<?php echo ($data["comment_id"]); ?>" method="post" > -->
                <form style="display: none;" class='box comment-form-2'>
                    <input type="hidden" name="post_id" class="post_id" value="<?php echo ($data["post_id"]); ?>"/>
                    <textarea name='reply' placeholder='请输入回复内容:' class="reply-text-{data.comment_id}"></textarea>

                    <div class='upload-pic'>图片</div>
                    <div id='localImag-2' style='display: none;top: 150px;left: 20px;position: absolute'><img
                            id='preview-2' border='none' width='50' height='50'
                            style='display:block;width: 50px;height: 50px;'></div>
                    <input id='doc-2' style='display: none;color: gray;' onchange='setImagePreview2();' accept='image/*'
                           type='file'>

                    <div class='upload-expressions'>表情</div>
                    <input type='submit' name="submit" class="submit-2" value="回复" id="comment-submit-2"
                           data-uid="<?php echo ($data["comment_user_id"]); ?>" data-id="<?php echo ($data["comment_id"]); ?>">
                </form>
                <!--  </div> -->
            </div>
            <?php }else{ ?>
            <!-- 子评论回复 -->
            <div class="reply-comment-1">
                <!--  <form style="display: none;" class='box-3 comment-form-3' action="<?php echo (URL); ?>User/comment?comment_id=<?php echo ($data["comment_id"]); ?>" method="post" > -->
                <form style="display: none;" class='box-3 comment-form-3' action="" method="">
                    <textarea name='reply' placeholder='请输入评论内容：' class="reply-text-3"></textarea>

                    <div class='upload-pic'>图片</div>
                    <div id='localImag-3' style='display: none;top: 150px;left: 20px;position: absolute'><img
                            id='preview-3' border='none' width='50' height='50'
                            style='display:block;width: 50px;height: 50px;'></div>
                    <input id='doc-3' style='display: none;color: gray;' onchange='setImagePreview3();' accept='image/*'
                           type='file'>

                    <div class='upload-expressions'>表情</div>
                    <input type='submit' id="comment-submit-3" class="submit-3" name="submit" value="回复"
                           data-uid="<?php echo ($data["comment_user_id"]); ?>" data-id="<?php echo ($data["comment_id"]); ?>">
                </form>
                <!-- 子评论显示内容 -->
                <div class="reply-box box-2" style="display:none;">
                    <div class="reply-information">
                        <img style="float: left;" src="/cog/<?php echo ($data["user_headimg"]); ?>" title="回复人头像" width="70" height="70">

                        <p class="users-name" style="text-align: center"><?php echo ($data["user_name"]); ?></p>
                    </div>
                    <div class="reply-context">回复 <?php echo ($data["comment_puser_name"]); ?>：<?php echo ($data["comment_content"]); ?>
                        <!-- 判断用户权限 -->
                        <?php if($data['comment_user_id']==$user_id){ ?>
                        <!-- <a href="/cog/index.php/Home/User/delete_comment?comment_id=<?php echo ($data["comment_id"]); ?>"> -->
                        <button class="delete-btn-2" data-id="<?php echo ($data["comment_id"]); ?>">删除</button>
                        <!-- </a> -->
                        <?php } ?>
                        <button class="reply-btn-2">回复</button>
                    </div>
                </div>
            </div>
            <?php } endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>

<script src="<?php echo (HOME_JS); ?>test/jquery.js"></script>
<script src="<?php echo (HOME_JS); ?>test/jquery.form.js"></script>
<script>
    $(function () {
        var i;
        //1点击评论按钮被click显示第一个回复form-1
        $(".comment-post-btn").click(function () {
            // $(".comment-box").css("top",0);
            //获取该按钮中的字符串
            var string1 = $(this).html().toString();
            // var string2 = $(".reply-btn").html().toString();
            // var string3 = $(".view-reply-btn").html().toString();
            $(this).siblings(".comment-box").children(".box").hide().end().find(".reply-btn").html("回复");
            if (string1[0] == "点") {
                //回复box隐藏
                $(".reply-box").hide();
                $(".comment-form-1").show();
                $(".comment-form-2").hide();
                $(".comment-form-3").hide();
                //表单1显示出来
                // if(string2[0]=="取"){
                //     $(".reply-btn").html("回复");
                // }
                // if(string3[0]=="收"){
                //     $(".view-reply-btn").html("点击查看");
                // }
                $(this).html("取消");
                $(".upload-pic").click(function () {
                    $("#localImag-1").show();
                    $("#doc-1").show();
                });
            }
            if (string1[0] == "取") {
                $(".comment-form-1").hide();
                $(this).html("点击评论");
            }
        });
        //2点击回复按钮点击回复事件显示第二个回复form-2
        $(".reply-btn").click(function () {
            //获取回复按钮中的字符串
            var string1 = $(this).html().toString();
            //获取评论按钮中的字符串
            var string2 = $(".comment-post-btn").html().toString();
            var string3 = $(".view-reply-btn").html().toString();
            $(this).parents(".comment-box").css("top", 0);
            $(this).parents(".comment-box").siblings(".comment-box").css("top", 0);
            $(this).parents(".comment-box").siblings(".comment-box").children(".box").hide().end().find(".reply-btn").html("回复");
            //判断回复按钮中的字符串是否以“回”开头
            if (string1[0] == "回") {
                //将按钮改为“取消”
                $(this).html("取消");
                //回复box隐藏
                $(".reply-box").hide();
                //表单1和3隐藏
                $(".comment-form-1").hide();
                $(".comment-form-3").hide();
                //表单2显示出来
                $(this).parent(".comment-context").siblings(".box").show();
                //判断点击评论按钮中的字符串是否是“取消”
                if (string2[0] == "取") {
                    $(".comment-post-btn").html("点击评论");
                }
                if (string3[0] == "收") {
                    $(".view-reply-btn").html("点击查看");
                }
                //图片按钮上传图片
                $(".upload-pic").click(function () {
                    $("#localImag-2").show();
                    $("#doc-2").show();
                });
            }
            if (string1[0] == "取") {
                $(".comment-form-2").hide();
                $(this).html("回复");
            }
        });

        //3回复列表中的回复按钮被click显示第三个form-3
        $(".reply-btn-2").click(function () {
            var string = $(this).html().toString();
            $("#gray").show();
            if (string[0] == "回") {
                $(".box-3").hide();
                $(this).parents(".box-2").siblings(".comment-form-3").show();
                $(".upload-pic").click(function () {
                    $("#localImag-3").show();
                    $("#doc-3").show();
                });
            }
        });

        //4点击收回查看按钮事件
        $(".view-reply-btn").click(function () {
            var string1 = $(this).html().toString();
            var string2 = $(".comment-post-btn").html().toString();
            var string3 = $(".reply-btn").html().toString();
            $(".comment-form-1").hide();
            $(".comment-form-2").hide();
            $(".comment-form-3").hide();
            $(".box-2").hide();
            if (string1[0] == "点") {
                $(this).html("收回查看");


                // for(int i = 1;i<=1;i++){
                //     $(this).parents(".comment-box").nextAll(".reply-comment-1").slice(0, 1).find(".box-2").show();
                // }
                var MAX = 50;
                for (i = 0; i < MAX; i++) {
                    var str = $(this).parents(".comment-box").nextAll("div").eq(i).attr("class");
                    if (str == "comment-box") {
                        $(this).parents(".comment-box").nextAll(".reply-comment-1").slice(0, i).find(".box-2").show();
                        $(this).html("收回查看" + i);
                        break;
                    }
                    if (typeof(str) == 'undefined') {
                        $(this).parents(".comment-box").nextAll(".reply-comment-1").slice(0, i).find(".box-2").show();
                        $(this).html("收回查看" + i);
                        break;
                    }
                }

                // $(this).parents(".comment").children(".reply-box").show();
                $(".reply-comment-1").show();
                // var i = 3;
                // $(this).parents(".comment-box").nextAll(".reply-comment-1").slice(0, i).find(".box-2").show();
                // $(this).parents(".comment-box").nextAll(".box-2").eq(0).show();
                $(this).parents(".comment-box").css("top", 0);
                $(this).parents(".comment-box").siblings(".comment-box").css("top", 0);
                $(this).parents(".comment-box").siblings(".comment-box").find(".view-reply-btn").html("点击查看");
                if (string2[0] == "取") {
                    $(".comment-post-btn").html("点击评论");
                }
                if (string3[0] == "取") {
                    $(".reply-btn").html("回复");
                }
            }
            else if (string1[0] == "收") {
                $(".box-2").hide();
                $(this).parents(".comment-box").siblings().css("top", 0);
                $(this).html("点击查看");
                if (string2[0] == "取") {
                    $(".comment-post-btn").html("点击评论");
                }
                if (string3[0] == "取") {
                    $(".reply-btn").html("回复");
                }
            }
        });
        //灰色蒙版被点击事件
        $("#gray").click(function () {
            $(this).hide();
            $(".comment-form-3").hide();
        });
        //收藏按钮被点击事件
        $(".collect-btn").click(function () {
            if ($(this).html() == "收藏") {
                $(this).html("取消");
            }
            else if ($(this).html() == "取消") {
                $(this).html("收藏");
            }
        });
        //分享按钮
        $(".share-btn").hover(function () {
            $(".share").show();
        }, function () {
            $(".share").hide();
        });
        $(".share").hover(function () {
            $(this).show();
        }, function () {
            $(this).hide();
        });
    });
    //下面用于图片上传预览功能1
    function setImagePreview1(avalue) {
        var docObj = document.getElementById("doc-1");
        var imgObjPreview = document.getElementById("preview-1");
        if (docObj.files && docObj.files[0]) {
            //火狐下，直接设img属性
            imgObjPreview.style.display = 'block';
            imgObjPreview.style.width = '50px';
            imgObjPreview.style.height = '50px';
            //imgObjPreview.src = docObj.files[0].getAsDataURL();

            //火狐7以上版本不能用上面的getAsDataURL()方式获取，需要一下方式
            imgObjPreview.src = window.URL.createObjectURL(docObj.files[0]);
        }
        else {
            //IE下，使用滤镜
            docObj.select();
            var imgSrc = document.selection.createRange().text;
            var localImagId = document.getElementById("localImag-1");
            //必须设置初始大小
            localImagId.style.width = "50px";
            localImagId.style.height = "50px";
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
    //下面用于图片上传预览功能2
    function setImagePreview2(avalue) {
        var docObj = document.getElementById("doc-2");
        var imgObjPreview = document.getElementById("preview-2");
        if (docObj.files && docObj.files[0]) {
            //火狐下，直接设img属性
            imgObjPreview.style.display = 'block';
            imgObjPreview.style.width = '50px';
            imgObjPreview.style.height = '50px';
            //imgObjPreview.src = docObj.files[0].getAsDataURL();

            //火狐7以上版本不能用上面的getAsDataURL()方式获取，需要一下方式
            imgObjPreview.src = window.URL.createObjectURL(docObj.files[0]);
        }
        else {
            //IE下，使用滤镜
            docObj.select();
            var imgSrc = document.selection.createRange().text;
            var localImagId = document.getElementsByClassName("localImag-2");
            //必须设置初始大小
            localImagId.style.width = "50px";
            localImagId.style.height = "50px";
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
    //下面用于图片上传预览功能3
    function setImagePreview3(avalue) {
        var docObj = document.getElementById("doc-3");
        var imgObjPreview = document.getElementById("preview-3");
        if (docObj.files && docObj.files[0]) {
            //火狐下，直接设img属性
            imgObjPreview.style.display = 'block';
            imgObjPreview.style.width = '50px';
            imgObjPreview.style.height = '50px';
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
            localImagId.style.width = "50px";
            localImagId.style.height = "50px";
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
    // $(".comment-box").click(function(){
    //     var index = $(this).index();
    //     alert(index);
    // });
    // $(".box-2").click(function(){
    //     var index = $(this).index();
    //     alert(index);
    // });

    // 进行收藏操作
    $('.collect-btn').click(function () {
        var post_id = $('.post_id').val();
        $.post("<?php echo (URL); ?>User/collect_post", {'post_id': post_id}, function (data) {
            if (data.status == 1) {
                alert(data.info);
            }
        }, 'json');
    });

    // 进行评论操作
    $('#comment-submit-1').click(function () {
        var comment = $('.form-1-comment').val();
        var submit = $('#comment-submit-1').val();
        var post_id = $('.post_id').val();
        $.post("<?php echo (URL); ?>User/comment", {
            'comment': comment,
            'submit': submit,
            'post_id': post_id
        }, function (data) {
            if (data.status == 1) {
                alert(data.info);
                window.location.reload();
            } else {
                alert(data.info);
            }
        }, 'json');
    });

    // 进行主评论回复操作
    $('.submit-2').click(function () {

        var submit = $('.submit-2').val();
        var comment_id = $(this).attr('data-id');
        var reply = $(this).siblings('textarea').val();
        var comment_user_id = $(this).attr('data-uid');
        var post_id = $('.post_id').val();
        $.post("<?php echo (URL); ?>User/comment", {
            'reply': reply,
            'submit': submit,
            'comment_id': comment_id,
            'comment_user_id': comment_user_id,
            'post_id': post_id
        }, function (data) {
            if (data.status == 1) {
                alert(data.info);
                window.location.reload();
            } else {
                alert(data.info);
            }
        }, 'json');
    });


    // 进行子评论回复操作
    $('.submit-3').click(function () {
        var reply = $(this).siblings('textarea').val();
        var post_id = $('.post_id').val();
        var comment_id = $(this).attr('data-id');
        var comment_user_id = $(this).attr('data-uid');
        var submit = $(this).val();
        $.post("<?php echo (URL); ?>User/comment", {
            'reply': reply,
            'post_id': post_id,
            'comment_id': comment_id,
            'comment_user_id': comment_user_id,
            'submit': submit
        }, function (data) {
            if (data.status == 1) {
                alert(data.info);
                window.location.reload();
            } else {
                alert(data.info);
            }
        }, 'json');
    });

    // 主评论删除操作
    $('.delete-btn').click(function () {
        var comment_id = $(this).attr('data-id');
        $.post("<?php echo (URL); ?>User/delete_comment", {'comment_id': comment_id}, function (data) {
            if (data.state == 1) {
                alert(data.info);
                window.location.reload();
            } else {
                alert(data.info);
                window.location.reload();
            }
        }, 'json');
    });

    // 子评论删除操作
    $('.delete-btn-2').click(function () {
        var comment_id = $(this).attr('data-id');
        // alert(comment_id);
        $.post("<?php echo (URL); ?>User/delete_comment", {'comment_id': comment_id}, function (data) {
            if (data.state == 1) {
                alert(data.info);
                window.location.reload();
            } else {
                alert(data.info);
                window.location.reload();
            }
        }, 'json');
    });

    // 帖子加精操作
    $('.admin-boutique').click(function () {
        var post_id = $(this).attr('data-id');
        $.post("<?php echo (URL); ?>Circle/boutique", {'post_id': post_id}, function (data) {
            if (data.status == 1) {
                alert(data.info);
            } else {
                alert(data.info);
            }
        }, 'json');
    });
    // 帖子删除操作
    $('.admin-delete').click(function () {
        var post_id = $(this).attr('data-id');
        $.post("<?php echo (URL); ?>Circle/delete_post", {'post_id': post_id}, function (data) {
            if (data.status == 1) {
                alert(data.info);
                window.location.reload();
            } else {
                alert(data.info);
            }
        }, 'json');
    });


</script>
</body>
</html>