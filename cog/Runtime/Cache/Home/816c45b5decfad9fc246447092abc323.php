<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="<?php echo (HOME_CSS); ?>game/game.css" rel="stylesheet">
    <title>游戏界面</title>
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


<!--页面主体-->
<div class="main">
    <h3>所有游戏</h3>
    <input name="search" type="text" placeholder="输入要搜索的游戏">
    <button class="main-p1">搜索</button>
    <div class="main-game">
        <a href=""><img src="<?php echo (HOME_IMGS); ?>bgImage.png"></a>
            <span>
                <a href=""><p class="main-game-p">游戏名称</p></a>
                <p class="main-game-p1">圈子数：100</p>
            </span>
    </div>

</div>
</body>
</html>