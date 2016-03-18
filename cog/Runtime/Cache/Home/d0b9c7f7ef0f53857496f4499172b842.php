<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>我的资料</title>
    <link rel="stylesheet" href="<?php echo (HOME_CSS); ?>MyInfo/my-information.css">
    <link rel="stylesheet" href="<?php echo (HOME_CSS); ?>MyInfo/css/style.css">
</head>
<body>
<!--nav导航条信息1-->
<div class="nav-container">
    <img class="nav-logo" src="<?php echo (HOME_IMGS); ?>redLogo.png" title="logo">
    <img class="nav-caption" src="<?php echo (HOME_IMGS); ?>caption.png" title="发现另一个你！">
    <ul class="nav-bar">
        <li><a class="active" href="<?php echo (URL); ?>Index/index">首页</a></li>
        <li><a href="<?php echo (URL); ?>Circle/index">圈子</a></li>
        <li><a href="<?php echo (URL); ?>Game/index">游戏</a></li>
        <li><a href="<?php echo (URL); ?>MyCircle/index">我的圈子</a></li>
    </ul>
</div>

<?php if(is_array($res_user)): $i = 0; $__LIST__ = $res_user;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?><div class="user-container">
        <img src="/cog/<?php echo ($user["user_headimg"]); ?>" title="头像" class="avator">

        <p class="user-name"><?php echo ($user["user_name"]); ?></p>
        <img src="<?php echo (HOME_IMGS); ?>MyInfo/boy.png" class="gender-logo">

        <p class="fix-position"><?php echo ($user["user_addr"]); ?></p>

        <p class="circle-age">圈龄:0.5年</p>

        <p class="my-level">等级：<?php echo ($user["user_level"]); ?></p>

        <div class="attention">
            <span><a href="#">关注:99</a></span>
            <span><a href="#">被关注:100</a></span>
        </div>
        <!--关注列表-->
        <div class="subscribe">
            关注列表<br>
            <?php if(is_array($res_subscribe)): $i = 0; $__LIST__ = $res_subscribe;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i; if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$subscribe): $mod = ($i % 2 );++$i;?><span>
              <a href="<?php echo (URL); ?>MyInfo/visitor?user_id=<?php echo ($subscribe["user_id"]); ?>"><?php echo ($subscribe["user_name"]); ?></a> 
      
              <input type="button" class="cancel_subscribe" value="取消关注" data-id="<?php echo ($subscribe["user_id"]); ?>"/> </br>
              </span>
                    <!--       <ul class="guanzhuliebiao" style="width:100px;height:300px;border:1px solid yellow;">
                              <li>123</li>
                          </ul> --><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
        </div>

        <div class="subscribed">
            被关注列表<br>
            <?php if(is_array($res_subscribed)): $i = 0; $__LIST__ = $res_subscribed;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><span>
             <a href="<?php echo (URL); ?>MyInfo/visitor?user_id=<?php echo ($data["user_id"]); ?>"><?php echo ($data["user_name"]); ?></a> 
              <?php if($data['check_follow']){ ?>
              <input type="button" value="取消关注" data-id="<?php echo ($data["user_id"]); ?>" class="cancel_subscribe" /></br>
              <?php }else{ ?>
              <input type="button" value="关注" data-id="<?php echo ($data["user_id"]); ?>" class="btn_subscribe" /></br>
              <?php } ?>
            </span><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <hr size="3" width="78%" color="black">
        <div class=information>
            <div class="concerned-circle">关注的圈子：
                <?php if(is_array($res_follow)): $i = 0; $__LIST__ = $res_follow;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$follow): $mod = ($i % 2 );++$i;?><a href="<?php echo (URL); ?>Circle/circlesquare?circle_id=<?php echo ($follow["circle_id"]); ?>"><?php echo ($follow["circle_name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <div class="instruction">个人说明:&nbsp;&nbsp;<?php echo ($user["user_note"]); ?></div>
        </div>
        <a class="private-chat change" href="#">查看私聊</a>
        <a class="modify" href="#" >修改个人信息</a>
    </div><?php endforeach; endif; else: echo "" ;endif; ?>


<!--动态栏-->
<div class="actions-container">
    <!--动态栏的选择ul-->
    <ul class="actions-select">
        <li class="active2">动态</li>
        <li>发帖</li>
        <li>回复 <strong style="color: orange;"><?php echo ($mention); ?></strong></li>
        <li style="border-right: 1px solid black">我收藏的贴子</li>
    </ul>

    <!--动态-->
    <div class="tabcontent">
        <!--11111111111111111111111111111发帖-->
        <?php if(is_array($res_post)): $i = 0; $__LIST__ = $res_post;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$post): $mod = ($i % 2 );++$i;?><div class="send">
                <p class="font">发帖</p>

                <div class="note-content">
                    <p class="head">
                        <span style="margin-left:20px">帖名：<a
                                href="<?php echo (URL); ?>User/index/post_id=<?php echo ($post["post_id"]); ?>"><strong><?php echo ($post["post_title"]); ?></strong></a></span>
                        <span style="margin-left:250px ">圈子：<strong><a href="#"><?php echo ($post["circle_name"]); ?></a></strong></span>
                        <span style="margin-left:510px">游戏：<strong><?php echo ($post["post_game"]); ?></strong></span>
                        <span style="margin-left: 700px">时间：<strong><?php echo ($post["post_time"]); ?></strong></span>
                    </p>

                    <p class="note-subcontent"><?php echo ($post["post_content"]); ?></p>
                </div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
        <!-- 用户未读信息 -->
        <?php if(is_array($res_mention)): $i = 0; $__LIST__ = $res_mention;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$reply): $mod = ($i % 2 );++$i;?><div class="reply">
                <p class="font">回复</p>

                <div class="reply-note">
                    <p class="head">
                        <span style="margin-left:20px">
                            帖名：<a href="<?php echo (URL); ?>User/index/post_id=<?php echo ($post["post_id"]); ?>"><strong><?php echo ($reply["post_title"]); ?></strong></a>
                        </span>
                        <span style="left:259px ">
                            圈子：<a href="#"><strong><?php echo ($reply["circle_name"]); ?></strong></a>
                        </span>
                        <span style="margin-left:510px">游戏：<strong><?php echo ($reply["post_game"]); ?></strong>
                        </span>
                        <span style="margin-left: 700px">时间：<strong><?php echo ($reply["comment_time"]); ?></strong>
                        </span>
                    </p>

                    <p class="reply-note-subcontent"><a href="#">:<?php echo ($reply["user_name"]); ?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($reply["comment_content"]); ?>
                    </p>
                </div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>


    <!--2发帖-->
    <div class="tabcontent" style="display: none">
        <?php if(is_array($res_post)): $i = 0; $__LIST__ = $res_post;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$post): $mod = ($i % 2 );++$i;?><div class="send">
                <p class="font">发帖</p>

                <div class="note-content">
                    <p class="head">
                        <span style="margin-left:20px">帖名：<a
                                href="<?php echo (URL); ?>User/index/post_id=<?php echo ($post["post_id"]); ?>"><strong><?php echo ($post["post_title"]); ?></strong></a></span>
                        <span style="margin-left:250px ">圈子：<strong><a href="#"><?php echo ($post["circle_name"]); ?></a></strong></span>
                        <span style="margin-left:510px">游戏：<strong><?php echo ($post["post_game"]); ?></strong></span>
                        <span style="margin-left: 700px">时间：<strong><?php echo ($post["post_time"]); ?></strong></span>
                    </p>

                    <p class="note-subcontent"><?php echo ($post["post_content"]); ?></p>
                </div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>

    <!--3回复帖子-->
    <div class="tabcontent" style="display: none">
        <!-- 用户未读信息 -->
        <?php if(is_array($res_mention)): $i = 0; $__LIST__ = $res_mention;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$reply): $mod = ($i % 2 );++$i;?><div class="reply">
                <p class="font">回复</p>

                <div class="reply-note">
                    <p class="head">
                        <span style="margin-left:20px">
                            帖名：<a href="<?php echo (URL); ?>User/index/post_id=<?php echo ($post["post_id"]); ?>"><strong><?php echo ($reply["post_title"]); ?></strong></a>
                        </span>
                        <span style="left:259px ">
                            圈子：<a href="#"><strong><?php echo ($reply["circle_name"]); ?></strong></a>
                        </span>
                        <span style="margin-left:510px">游戏：<strong><?php echo ($reply["post_game"]); ?></strong>
                        </span>
                        <span style="margin-left: 700px">时间：<strong><?php echo ($reply["comment_time"]); ?></strong>
                        </span>
                    </p>

                    <p class="reply-note-subcontent"><a href="#">:<?php echo ($reply["user_name"]); ?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($reply["comment_content"]); ?>
                    </p>
                </div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
        <!--回复-->
        <!--<?php if(is_array($res_reply)): $i = 0; $__LIST__ = $res_reply;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$reply): $mod = ($i % 2 );++$i;?>-->
        <!--<div class="reply-note">-->
        <!--<p class="head">-->
        <!--<span>-->
        <!--<a href="<?php echo (URL); ?>User/index/post_id=<?php echo ($post["post_id"]); ?>"><?php echo ($reply["post_title"]); ?></a>-->
        <!--</span>-->
        <!--<span style="left:410px ">·<a href="#"><?php echo ($reply["circle_name"]); ?></a></span>-->
        <!--<span style="margin-left:610px">·<?php echo ($reply["post_game"]); ?></span>-->
        <!--<span style="margin-left: 800px"><?php echo ($reply["comment_time"]); ?></span>-->
        <!--</p>-->

        <!--<p class="reply-note-subcontent"><a href="#">:<?php echo ($reply["user_name"]); ?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($reply["comment_content"]); ?>-->
        <!--</p>-->
        <!--</div>-->
        <!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
    </div>


    <!--我收藏的帖子-->
    <div class="tabcontent" style="display: none">
        <?php if(is_array($res_collect)): $i = 0; $__LIST__ = $res_collect;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$collect): $mod = ($i % 2 );++$i; if(is_array($collect)): $i = 0; $__LIST__ = $collect;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><div class="fine-post">
                    <div class="post-left">
                        <div class="post-left-main">
                            <img class="post-headportrait" src="/cog/<?php echo ($data["user_headimg"]); ?>">

                            <p class="fine"><?php echo ($data["user_name"]); ?></p>
                        </div>
                    </div>
                    <div class="post-right">
                        <div class="post-game">
                            <p><a><?php echo ($data["circle_name"]); ?></a>-><a><?php echo ($data["post_game"]); ?></a>-><a><?php echo ($data["post_server"]); ?></a></p>
                        </div>
                        <div class="post-title">
                            <a href="<?php echo (URL); ?>User/index?post_id=<?php echo ($data["post_id"]); ?>"><?php echo ($data["post_title"]); ?></a>
                        </div>
                        <div class="post-content">
                            <p><?php echo ($data["post_content"]); ?></p>
                        </div>
                        <div class="post-postpic-main">
                            <!-- <div class="post-postpic">
                                <img class="post-postpic" src="<?php echo (HOME_IMGS); ?>MyInfo/headportrait.jpg">
                            </div>
                            <div class="post-postpic">
                                <img class="post-postpic" src="<?php echo (HOME_IMGS); ?>MyInfo/headportrait.jpg">
                            </div>
                            <div class="post-postpic">
                                <img class="post-postpic" src="<?php echo (HOME_IMGS); ?>MyInfo/headportrait.jpg">
                            </div> -->
                        </div>
                        <div class="fine-information">
                            <p class="fine-joinin">阅读：<a>888</a></p>

                            <p class="fine-lasttime">最后回复：<a><?php echo ($data["post_time"]); ?></a></p>
                        </div>
                    </div>
                </div><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>

    </div>
</div>


<!--查看私信-->
<div class="tabcontent1">
    <p class="tabcontent1-p">返回>></p>

    <div class="sixin">
        <img src="images/touxiang.png">

        <div class="clear-float"></div>
        <p class="sixin-p1"><a href="">私信人id</a></p>

        <div class="clear-float"></div>
        <p class="sixin-p2">私信人ID 私信您:</p>

        <div class="clear-float"></div>
        <div class="sixin-neirong">
            私信内容
        </div>
        <p class="sixin-p3" id="siliao">点击回复→</p>

        <p class="sixin-p3">时间：2015年12月25日15:18</p>
    </div>
</div>


<div>
    <!--<div id="siliao" class="tigger">私聊</div>-->
    <div class="main">
        <h2>To 私信人id</h2>
        <input type="button" value="关闭" href="javascript:void(0)" id="close" class="closeBtn">
        <textarea rows="10" cols="49" placeholder="在这里输入内容">输入私信内容</textarea>
        <input type="button" value="发送" name="send" class="send1">
    </div>
</div>

<script src="<?php echo (HOME_JS); ?>MyInfo/jquery.js"></script>
<script>
    $(".actions-select  li").click(function () {
        var index = $(this).index();
        $('.tabcontent').eq(index).show().siblings('.tabcontent').hide();
        $(this).addClass("active2").siblings().removeClass("active2");
    });

    $(".change").click(function () {
        $('.tabcontent1').show();
        $('.actions-container').hide();
        $(this).addClass("active2");
        $(".tabcontent1-p").removeClass("active2");
    });

    $(".tabcontent1-p").click(function () {
        $('.actions-container').show();
        $('.tabcontent1').hide();
        $(this).addClass("active2");
        $(".change").removeClass("active2");
    });

</script>


<!--弹窗js-->
<script src="<?php echo (HOME_JS); ?>MyInfo/jquery-1.4.2.min.js"></script>
<script src="<?php echo (HOME_JS); ?>MyInfo/popup_layer.js"></script>
<script>
    $(document).ready(function () {

        var t9 = new PopupLayer({
            trigger: "#siliao",
            popupBlk: ".main",
            closeBtn: "#close",
            useOverlay: true,
            useFx: true,
            offsets: {
                x: 0,
                y: -41
            }
        });
        t9.doEffects = function (way) {
            if (way == "open") {
                this.popupLayer.css({opacity: 0.3}).show(300, function () {
                    this.popupLayer.animate({
                        left: ($(document).width() - this.popupLayer.width()) / 2,
                        top: (document.documentElement.clientHeight - this.popupLayer.height()) / 2 + $(document).scrollTop(),
                        opacity: 0.8
                    }, 300, function () {
                        this.popupLayer.css("opacity", 1)
                    }.binding(this));
                }.binding(this));
            }
            else {
                this.popupLayer.animate({
                    left: this.trigger.offset().left,
                    top: this.trigger.offset().top,
                    opacity: 0.1
                }, {
                    duration: 200, complete: function () {
                        this.popupLayer.css("opacity", 1);
                        this.popupLayer.hide()
                    }.binding(this)
                });
            }
        }
    });
</script>

<!--  赵文奕的js -->

<script src="<?php echo (HOME_JS); ?>MyInfo/jquery.js"></script>
  <script src="<?php echo (HOME_JS); ?>MyInfo/jquery.form.js"></script>

  <script type="text/javascript">
  $('.cancel_subscribe').click(function(){
    var follow_id=$(this).attr('data-id');
    $.post("<?php echo (URL); ?>MyInfo/cancel_subscribe",{"follow_id":follow_id},function(data){
      if(data.state==1){
          alert('取消关注成功');
          window.location.reload();
      }else{
        alert(data.info);

      }

    },'json');
    

  });
  $('.btn_subscribe').click(function(){
    var follow_id=$(this).attr('data-id');
    $.post("<?php echo (URL); ?>MyInfo/subscribe",{"follow_id":follow_id},function(data){
      if(data.state==1){
          alert('关注成功');
          window.location.reload();
      }else{
        alert(data.info);

      }

    },'json');
    

  });
  </script>

</body>
</html>