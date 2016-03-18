<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="<?php echo (HOME_CSS); ?>news/news.css" rel="stylesheet">

    <script type="text/javascript" src="live_js/jquery-1.7.2.js"></script>
    <script type="text/javascript" src="live_js/jquery.sinaEmotion.js"></script>

    <title>新闻</title>
</head>
<body>

<!--nav导航条信息1-->
<div class="nav-container">
    <img class="nav-logo" src="<?php echo (HOME_IMGS); ?>redLogo.png" title="logo">
    <img class="nav-caption" src="<?php echo (HOME_IMGS); ?>caption.png" title="发现另一个你！">
    <ul class="nav-bar">
        <li><a href="<?php echo (URL); ?>Index/index">首页</a></li>
        <li><a href="<?php echo (URL); ?>Circle/index">圈子</a></li>
        <li><a class="active" href="<?php echo (URL); ?>Game/index">游戏</a></li>
        <li><a href="<?php echo (URL); ?>MyCircle/index">我的圈子</a></li>
    </ul>
    <form action="" class="nav-form">
        <input class="nav-form-search" type="text" placeholder="搜索附近的圈子">
        <input class="nav-form-submit" style="background: url('<?php echo (HOME_IMGS); ?>search.png') no-repeat center"
               type="submit" value="">
    </form>
</div>


<p  class="leader"><a  href="">首页</a>>><a href="" >新闻</a>>><a href="">游戏类别</a></p>
<!--页面主体-->
<?php if(is_array($res_news)): $i = 0; $__LIST__ = $res_news;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$news): $mod = ($i % 2 );++$i;?><div class="main">
    <div class="main-game">
        <p class="main-game-p"><?php echo ($news["news_title"]); ?></p>
        <div class="main-game-content">
            <p class="main-game-content-p1">来源:游戏盒子&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;浏览次数:<?php echo ($news["news_view"]); ?></p>
            <div class="main-game-content-text">
                <?php echo ($news["news_content"]); ?>
            </div>
            <div class="main-game-content-img">
                <img src="/cog/<?php echo ($news["news_img"]); ?>" height="200" width="200">
            </div>

            <div class="button">
                <input name="buton" type="submit" value="赞" class="button1">
                <input name="buton" type="submit" value="踩" class="button2">
            </div>
        </div>
    </div>
    <div class="main-news">
        <!-- <div class="main-news1">

        </div>
        <div class="main-news2">
            <p class="main-news2-p">热门新闻</p>
        </div> -->
        <h2> 热门新闻</h2>
        <?php if(is_array($res_hot)): $i = 0; $__LIST__ = $res_hot;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hot): $mod = ($i % 2 );++$i;?><div class="main-news3">
            <a href="<?php echo (URL); ?>News/index?news_id=<?php echo ($hot["news_id"]); ?>">
            <img src="/cog/<?php echo ($hot["news_img"]); ?>" width="300px" height="200px">
            </a>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div><?php endforeach; endif; else: echo "" ;endif; ?>
</body>
</html>