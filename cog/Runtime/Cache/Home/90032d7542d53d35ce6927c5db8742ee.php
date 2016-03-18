<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="<?php echo (HOME_CSS); ?>MyCircle/mycircle.css"/>
    <title>我的圈子</title>
</head>
<body>


<!--浮动框-->
<div class="lowright">
    <div id="back-to-top" style="background: url('<?php echo (HOME_IMGS); ?>/blackTop.gif')" ></div>
</div>



<!--nav导航条信息1-->
<div class="nav-container">
    <img class="nav-logo" src="<?php echo (HOME_IMGS); ?>redLogo.png" title="logo">
    <img class="nav-caption" src="<?php echo (HOME_IMGS); ?>caption.png" title="发现另一个你！">
    <ul class="nav-bar">
        <li><a href="<?php echo (URL); ?>Index/index">首页</a></li>
        <li><a href="<?php echo (URL); ?>Circle/index">圈子</a></li>
        <li><a  href="<?php echo (URL); ?>Game/index">游戏</a></li>
        <li><a class="active" href="<?php echo (URL); ?>MyCircle/index">我的圈子</a></li>
    </ul>
    <form action="" class="nav-form">
        <input class="nav-form-search" type="text" placeholder="搜索附近的圈子">
        <input class="nav-form-submit" style="background: url('<?php echo (HOME_IMGS); ?>search.png') no-repeat center"
               type="submit" value="">
    </form>
</div>

<!--圈子选择部分-->
<div class="circle-select-main">
    <div class="circle-select">
        <div class="circle-select-title">
            <p>请选择圈子</p>
        </div>
        <form class="circle-select-circle" action="<?php echo (URL); ?>MyCircle/index" method="post">
            <?php if(is_array($concrete_circle_info)): $i = 0; $__LIST__ = $concrete_circle_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$circle): $mod = ($i % 2 );++$i; if(is_array($circle)): $i = 0; $__LIST__ = $circle;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$circle_info): $mod = ($i % 2 );++$i;?><label><input class="circle-check"  name="circle" type="checkbox" value="<?php echo ($circle_info["circle_id"]); ?>" /><a><?php echo ($circle_info["circle_name"]); ?></a></label>
           <!--  <label><input name="circle" type="checkbox" value="" /><a>南湖校区</a></label>
            <label><input name="circle" type="checkbox" value="" /><a>鉴湖校区</a></label>
            <label><input name="circle" type="checkbox" value="" /><a>狮城名居</a></label> --><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
            <input class="circle-select-submit" type="submit" value="筛选">
        </form>
        
    </div>
</div>


<!--帖子部分-->
<div class="post-main">
    <?php if(is_array($circle_post)): $i = 0; $__LIST__ = $circle_post;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$post): $mod = ($i % 2 );++$i;?><div class="post-main-post">
    <div class="post-left">
        <div class="post-left-main">
            <img class="post-headportrait" src="<?php echo (HOME_IMGS); ?>MyCircle/headportrait.jpg">
            <img class="post-discussion" src="<?php echo (HOME_IMGS); ?>MyCircle/discussion.png">
            <p class="post-joinin">这里是参与人数</p>
            <img class="post-lastpost" src="<?php echo (HOME_IMGS); ?>MyCircle/lastpost.png">
            <p class="post-lasttime"><?php echo ($post["post_time"]); ?></p>
        </div>
    </div>
    <div class="post-right">
        <div class="post-game">
            <p><a>升升公寓</a>-><a><?php echo ($post["post_game"]); ?></a>-><a><?php echo ($post["post_server"]); ?></a></p>
            <!-- 判断用户的权限 -->
            <?php if($userid==1){ ?>
            <p class="post-admin-boutique">加精</p>
            <?php } if($userid==$post['user'] | $user_id==1){ ?>
            <p class="post-admin-delete">删除</p>
            <?php } ?>
        </div>
        <div class="post-title">
            <a href="/cog/index.php/Home/User/index?post_id=<?php echo ($post["post_id"]); ?>"><?php echo ($post["post_title"]); ?></a>
        </div>
        <div class="post-content">
            <p><?php echo ($post["post_content"]); ?></p>
        </div>
        <div class="post-postpic-main">
            <!-- <div class="post-postpic">
                <img class="post-postpic" src="<?php echo (HOME_IMGS); ?>MyCircle/headportrait.jpg">
            </div>
            <div class="post-postpic">
                <img class="post-postpic" src="<?php echo (HOME_IMGS); ?>MyCircle/headportrait.jpg">
            </div>
            <div class="post-postpic">
                <img class="post-postpic" src="<?php echo (HOME_IMGS); ?>MyCircle/headportrait.jpg">
            </div> -->
        </div>
    </div>
   </div><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
<script src="<?php echo (HOME_JS); ?>/jquery.js"></script>
<script>
    //返回顶部
    $("#back-to-top").hover(function(){
        $(this).css("background-position","0 81px");
    },function(){
        $(this).css("background-position","0 0");
    }).click(function(){
        $("body").scrollTop(0);
    });
    $(".circle-check").click(function(){
        if($(this).prop("checked")){
            $(this).siblings("a").css("color","orange");
        }else {
            $(this).siblings("a").css("color","black");
        }
    });
</script>
</body>
</html>