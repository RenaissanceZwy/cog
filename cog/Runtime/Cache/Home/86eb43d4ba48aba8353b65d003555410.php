<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="<?php echo (HOME_CSS); ?>circle/circle.css" rel="stylesheet">
    <title>圈子页面</title>
</head>
<body>

<!--nav导航条信息1-->
<div class="nav-container">
    <img class="nav-logo" src="<?php echo (HOME_IMGS); ?>redLogo.png" title="logo">
    <img class="nav-caption" src="<?php echo (HOME_IMGS); ?>caption.png" title="发现另一个你！">
    <ul class="nav-bar">
        <li><a  href="<?php echo (URL); ?>Index/index">首页</a></li>
        <li><a class="active" href="<?php echo (URL); ?>Circle/index">圈子</a></li>
        <li><a href="<?php echo (URL); ?>Game/index">游戏</a></li>
        <li><a href="<?php echo (URL); ?>MyCircle/index">我的圈子</a></li>
    </ul>
    <form action="" class="nav-form">
        <input class="nav-form-search" type="text" placeholder="搜索附近的圈子">
        <input class="nav-form-submit" style="background: url('<?php echo (HOME_IMGS); ?>search.png') no-repeat center" type="submit" value="">
    </form>
</div>

<!--页面主体-->

    <!--最近浏览-->
    <div class="main-recent" >
        <h3>最近浏览</h3>
        <a class="main-recent-p1">查看更多>></a>
        <?php if(is_array($res_recent)): $i = 0; $__LIST__ = $res_recent;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$recent): $mod = ($i % 2 );++$i; if(is_array($recent)): $i = 0; $__LIST__ = $recent;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$view): $mod = ($i % 2 );++$i;?><div class="main-recent-circle">
            <a href="<?php echo (URL); ?>Circle/circlesquare?circle_id=<?php echo ($view["circle_id"]); ?>"><img src="/cog/<?php echo ($view["circle_img"]); ?>"></a>
          <span>
            <a href=""><p class="main-recent-p2">帖子数：<?php echo ($view["post_num"]); ?></p></a>
            <p class="main-recent-p3"><?php echo ($view["circle_name"]); ?></p>
          </span>
        </div><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
    </div>


<!--最新圈子-->
    <div class="main-new">
        <h3>最新圈子</h3>
        <p class="main-new-p1">查看更多>></p>
        <div class="clear"></div>
        <?php if(is_array($new_circle)): $i = 0; $__LIST__ = $new_circle;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><div class="main-new-circle">
            <a href="<?php echo (URL); ?>Circle/circlesquare?circle_id=<?php echo ($data["circle_id"]); ?>"><img src="/cog/<?php echo ($data["circle_img"]); ?>"></a>
          <span>
            <a  class="main-new-p2" href="#">帖子数：<?php echo ($data["circle_post_num"]); ?></a>
            <p class="main-new-p3"><!-- 关注：1000 --><?php echo ($data["circle_name"]); ?></p>
          </span>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>

<!--热门圈子-->
    <div class="main-hot">
        <h3>热门圈子</h3>
        <p class="main-hot-p1">查看更多>></p>
        <?php if(is_array($res_hotCircle)): $i = 0; $__LIST__ = $res_hotCircle;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$circle): $mod = ($i % 2 );++$i;?><div class="main-hot-circle">
            <a href="<?php echo (URL); ?>Circle/circlesquare?circle_id=<?php echo ($circle["post_circle_id"]); ?>"><img src="/cog/<?php echo ($circle["circle_img"]); ?>"></a>
          <span>
            <a href=""><p class="main-hot-p2">帖子数：1000</p></a>
            <p class="main-hot-p3"><?php echo ($circle["circle_name"]); ?></p>
          </span>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>



<script src="<?php echo (HOME_JS); ?>/jquery.js"></script>
<script>
    //查看更多最近浏览
    $(".main-recent-p1").click(function(){
        var str =$(this).html();
        if(str[0]=='查'){
            $(".main-recent").css("height","auto");
            $(this).html("&lt;&lt;返回");
        }else{
            $(".main-recent").css("height",250);
            $(this).html("查看更多&gt;&gt;");
        }
    });

    //查看更多最新圈子
    $(".main-new-p1").click(function(){
        var str =$(this).html();
        if(str[0]=='查'){
            $(".main-new").css("height","auto");
            $(this).html("&lt;&lt;返回");
        }else{
            $(".main-new").css("height",250);
            $(this).html("查看更多&gt;&gt;");
        }
    });
    //查看更多热门圈子
    $(".main-hot-p1").click(function(){
        var str =$(this).html();
        if(str[0]=='查'){
            $(".main-hot").css("height","auto");
            $(this).html("&lt;&lt;返回");
        }else{
            $(".main-hot").css("height",250);
            $(this).html("查看更多&gt;&gt;");
        }
    });



</script>
</body>
</html>