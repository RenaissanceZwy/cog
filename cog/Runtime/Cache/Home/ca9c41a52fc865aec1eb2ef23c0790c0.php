<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="<?php echo (HOME_CSS); ?>circle/circlesquare.css"/>
    <title>圈子</title>
</head>
<body>
<!--浮动框-->
<div class="lowright">
    <div class="lowlattice">
        <p id="lowlattice-post" class="tigger">发帖</p>
    </div>
    <div id="back-to-top">
        <a href="#top">顶部</a>
    </div>
 </div>

<!--nav导航条信息1-->
<div class="nav-container">
    <img class="nav-logo" src="<?php echo (HOME_IMGS); ?>redLogo.png" title="logo">
    <img class="nav-caption" src="<?php echo (HOME_IMGS); ?>caption.png" title="发现另一个你！">
    <ul class="nav-bar">
        <li><a  href="<?php echo (URL); ?>Index/index">首页</a></li>
        <li><a href="<?php echo (URL); ?>Circle/index">圈子</a></li>
        <li><a href="<?php echo (URL); ?>Game/index">游戏</a></li>
        <li><a href="<?php echo (URL); ?>MyCircle/index">我的圈子</a></li>
    </ul>
    <form action="" class="nav-form">
        <input class="nav-form-search" type="text" placeholder="搜索附近的圈子">
        <input class="nav-form-submit" style="background: url('<?php echo (HOME_IMGS); ?>search.png') no-repeat center" type="submit" value="">
    </form>
</div>

<?php if(is_array($circle_info)): $i = 0; $__LIST__ = $circle_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$circle): $mod = ($i % 2 );++$i;?><div class="circle">
    <div class="circle-main">
        <img class="circle-headportrait" src="/cog/<?php echo ($circle["circle_img"]); ?>">
        <div class="circle-information">
            <div class="circle-information-title">
                <a class="circle-name" href=""><?php echo ($circle["circle_name"]); ?></a>
                <div class="circle-information-location">
                    <img class="circle-information-location-img" src="<?php echo (HOME_IMGS); ?>circle/position-pic.png">
                    <a class="circle-information-location-word" href=""><?php echo ($circle["circle_location"]); ?></a>
                </div>
                <input type="hidden" class="circle_id" value="<?php echo ($circle["circle_id"]); ?>">
                <?php if($circle_follow_check==0){ ?>
                <a class="button" id="follow_circle_btn">+关注</a>
                <?php }else { ?>
                 <a class="button" id="cancel_follow_circle_btn">-取消关注</a>
                 <?php } ?>
            </div>
            <div class="circle-description">
                <p class="circle-people">关注人数：<a href="">暂时无法提供</a></p>
                <p class="circle-post">帖子数：<?php echo ($circle["circle_post_num"]); ?></p>
            </div>
        </div>
    </div>
</div><?php endforeach; endif; else: echo "" ;endif; ?>
<div id="select">
    <ul class="select-main">
        <li><a href="<?php echo (URL); ?>Circle/circlesquare?circle_id=<?php echo ($circle_id); ?>">查看全部</a></li>
        <?php if(is_array($circle_game)): $i = 0; $__LIST__ = $circle_game;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$game): $mod = ($i % 2 );++$i;?><li><a href="<?php echo (URL); ?>Circle/circlesquare?game_id=<?php echo ($game["game_id"]); ?>&circle_id=<?php echo ($circle_id); ?>"><?php echo ($game["game_id"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        <li><a  id="getmore">更多游戏>></a></li>
    </ul>
</div>
<div id="select-more">
</div>
<div id="circlesquare">
    <div class="circlesquare-main">
        <div class="circlesquare-left">
            <div class="circlesquare-user">
                <?php if(is_array($user_info)): $i = 0; $__LIST__ = $user_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?><img class="user-headportrait" src="/cog/<?php echo ($user["user_headimg"]); ?>">
                <a class="user-name" href=""><?php echo ($user["user_name"]); ?></a>
                <a class="user-grade" href="">等级：<?php echo ($user["user_id"]); ?></a>
                <p class="user-autograph"><?php echo ($user["user_note"]); ?></p><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <ul class="circlesquare-bar">
                <li class="active"><a>帖子</a></li>
                <li><a>精品</a></li>
                <li><a>@我</a></li>
                <!-- <li><a>回复</a></li> -->
                <li><a>收藏</a></li>
                <!-- <li><a>私信</a></li> -->
                <li><a>等级排行</a></li>
            </ul>
        </div>
        <div class="circlesquare-center">
            <!-- 帖子显示界面 -->
            <div class="conter-main">
                <?php if(is_array($post)): $i = 0; $__LIST__ = $post;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><div class="conter-post">
                    <div class="post-left">
                        <div class="post-left-main">
                            <img class="post-headportrait" src="/cog/<?php echo ($data["user_headimg"]); ?>">
                            <img class="post-discussion" src="<?php echo (HOME_IMGS); ?>circle/discussion.png">
                            <p class="post-joinin"><?php echo ($data["user_name"]); ?></p>
                            <img class="post-lastpost" src="<?php echo (HOME_IMGS); ?>circle/lastpost.png">
                            <p class="post-lasttime"><?php echo ($data["post_time"]); ?></p>
                        </div>
                    </div>
                    <div class="post-right">
                        <div class="post-game">
                            <p><a><?php echo ($data["post_game"]); ?></a>-><a><?php echo ($data["post_server"]); ?></a></p>
                            <input type="hidden" class="post_id" value="<?php echo ($data["post_id"]); ?>">
                            <!-- 判断是否是管理员 -->
                            <?php if($monitor_id==$user_id){ ?>
                           <!--  <a href="<?php echo (URL); ?>Circle/boutique?post_id=<?php echo ($data["post_id"]); ?>"> -->
                            <p class="post-admin-boutique">加精</p>
                            <!-- </a>  -->
                            <?php } ?>
                           <!--  判断是否是管理员或者是登录用户 -->
                            <?php if($data['post_user']==$user_id || $monitor_id==$user_id){ ?>
               <!--  <a href="/cog/index.php/Home/Circle/delete_post?post_id=<?php echo ($data["post_id"]); ?>"><p class="post-admin-delete">删除</p></a> -->
               <p class="post-admin-delete">删除</p>
                            <?php }?>
                        </div>
                        <div class="post-title">
                            <a href="/cog/index.php/Home/User/index?post_id=<?php echo ($data["post_id"]); ?>"><?php echo ($data["post_title"]); ?></a>
                        </div>
                        <div class="post-content">
                            <p>1<?php echo ($data["post_content"]); ?></p>
                        </div>
                        <div class="post-postpic-main">
                      <!--   <div class="post-postpic">
                            <img class="post-postpic" src="<?php echo (HOME_IMGS); ?>circle/headportrait.jpg">
                        </div>
                        <div class="post-postpic">
                            <img class="post-postpic" src="<?php echo (HOME_IMGS); ?>circle/headportrait.jpg">
                        </div>
                        <div class="post-postpic">
                            <img class="post-postpic" src="<?php echo (HOME_IMGS); ?>circle/headportrait.jpg">
                        </div> -->
                        </div>
                    </div>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <div class="conter-main" style="display: none">
               <!--  这里是精品页面 -->
                <?php if(is_array($boutique_post)): $i = 0; $__LIST__ = $boutique_post;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$post): $mod = ($i % 2 );++$i;?><div class="center-fine">
                    <div class="post-left">
                        <div class="post-left-main">
                            <img class="post-headportrait" src="/cog/<?php echo ($post["user_headimg"]); ?>">
                            <p class="fine"><?php echo ($post["user_name"]); ?></p>
                        </div>
                    </div>
                    <div class="post-right">
                        <div class="post-game">
                            <p><a><?php echo ($post["post_game"]); ?></a>-><a><?php echo ($post["post_server"]); ?></a></p>
                             <input type="hidden" class="post_id" value="<?php echo ($post["post_id"]); ?>">
                            <!-- 判断是否是管理员 -->
                            <?php if($monitor_id==$user_id){ ?>
                            <!-- <a href="<?php echo (URL); ?>Circle/boutique?post_id=<?php echo ($post["post_id"]); ?>"> -->
                            <p class="post-admin-boutique">加精</p>
                            <!-- </a>  -->
                            <?php } ?>
                           <!--  判断是否是管理员或者是登录用户 -->
                            <?php if($data['post_user']==$user_id || $monitor_id==$user_id){ ?>
                <!-- <a href="/cog/index.php/Home/Circle/delete_post?post_id=<?php echo ($post["post_id"]); ?>"> --><p class="post-admin-delete">删除</p><!-- </a> -->
                            <?php }?>
                        </div>
                        <div class="post-title">
                            <a href="<?php echo (URL); ?>User/index?post_id=<?php echo ($post["post_id"]); ?>"><?php echo ($post["post_title"]); ?></a>
                        </div>
                        <div class="post-content">
                            <p><?php echo ($post["post_content"]); ?></p>
                        </div>
                        <div class="post-postpic-main">
                        <!-- <div class="post-postpic">
                            <img class="post-postpic" src="<?php echo (HOME_IMGS); ?>circle/headportrait.jpg">
                        </div>
                        <div class="post-postpic">
                            <img class="post-postpic" src="<?php echo (HOME_IMGS); ?>circle/headportrait.jpg">
                        </div>
                        <div class="post-postpic">
                            <img class="post-postpic" src="<?php echo (HOME_IMGS); ?>circle/headportrait.jpg">
                        </div> -->
                        </div>
                        <div class="fine-information">
                            <p class="fine-joinin">阅读：<a>888</a></p>
                            <p class="fine-lasttime">最后回复：<a><?php echo ($post["post_time"]); ?></a></p>
                        </div>
                    </div>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <div class="conter-main" style="display: none">
                <!-- 这是@我界面 -->
                <div class="mention">
                    <div class="mention-left">
                        <div class="mention-left-main">
                            <img class="mention-headportrait" src="<?php echo (HOME_IMGS); ?>circle/headportrait.jpg">
                            <p class="mention-name">这里是发帖人ID</p>
                        </div>
                    </div>
                    <div class="mention-right">
                        <div class="mention-title">
                            <a>@我的帖子标题</a>
                        </div>
                        <div class="mention-content">
                            <a>这里是@我是的内容</a>
                        </div>
                        <div class="mention-mention">
                            <p><a href="">发消息人的ID</a>在该帖子中提到我<a class="reply">点击查看</a></p>
                        </div>
                        <div class="mention-information">
                            <div class="mention-time">
                                <p>时间：<a>2016-01-14</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 回复循环输出 -->
                <?php if(is_array($res_reply)): $i = 0; $__LIST__ = $res_reply;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$reply): $mod = ($i % 2 );++$i;?><div class="tellme">
                    <div class="tellme-left">
                        <div class="tellme-left-main">
                            <img class="tellme-headportrait" src="/cog/<?php echo ($reply["user_headimg"]); ?>">
                            <a class="tellme-name">这里是发帖人ID</a>
                        </div>
                    </div>
                    <div class="tellme-right">
                        <div class="tellme-title">
                            <a><?php echo ($reply["post_title"]); ?></a>
                        </div>
                        <div class="tellme-tell">
                            <p><a href=""><?php echo ($reply["user_name"]); ?></a>在该帖子中回复我<a class="reply" href="<?php echo (URL); ?>User/index?post_id=<?php echo ($reply["post_id"]); ?>">点击查看</a></p>
                        </div>
                        <div class="tellme-content">
                            <a><?php echo ($reply["comment_content"]); ?></a>
                        </div>
                        <div class="tellme-information">
                            <div class="tellme-time">
                                <p>时间：<a><?php echo ($reply["comment_time"]); ?></a></p>
                            </div>
                        </div>
                    </div>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <!-- <div class="conter-main" style="display: none">
                这是回复界面
                <div class="tellme">
                    <div class="tellme-left">
                        <div class="tellme-left-main">
                            <img class="tellme-headportrait" src="<?php echo (HOME_IMGS); ?>circle/headportrait.jpg">
                            <a class="tellme-name">这里是发帖人ID</a>
                        </div>
                    </div>
                    <div class="tellme-right">
                        <div class="tellme-title">
                            <a>这里是回复我的主题</a>
                        </div>
                        <div class="tellme-tell">
                            <p><a href="">发消息人的ID</a>在该帖子中回复我<a class="reply">点击查看</a></p>
                        </div>
                        <div class="tellme-content">
                            <a>这里是回复我的内容</a>
                        </div>
                        <div class="tellme-information">
                            <div class="tellme-time">
                                <p>时间：<a>2016-01-14</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="conter-main" style="display: none">
                <!-- 这是收藏界面 -->
                <?php if(is_array($collect_post)): $i = 0; $__LIST__ = $collect_post;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$post): $mod = ($i % 2 );++$i; if(is_array($post)): $i = 0; $__LIST__ = $post;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><div class="conter-post">
                    <div class="post-left">
                        <div class="post-left-main">
                            <img class="post-headportrait" src="/cog/<?php echo ($data["user_headimg"]); ?>">
                            <img class="post-discussion" src="<?php echo (HOME_IMGS); ?>circle/discussion.png">
                            <p class="post-joinin"><?php echo ($data["user_name"]); ?></p>
                            <img class="post-lastpost" src="<?php echo (HOME_IMGS); ?>circle/lastpost.png">
                            <p class="post-lasttime"><?php echo ($data["post_time"]); ?></p>
                        </div>
                    </div>
                    <div class="post-right">
                        <div class="post-title">
                            <a href=""><?php echo ($data["post_title"]); ?></a>
                        </div>
                        <div class="post-content">
                            <p style="height: auto"><?php echo ($data["post_content"]); ?></p>
                        </div>
                        <div class="post-postpic-main">
                        <!-- <div class="post-postpic">
                            <img class="post-postpic" src="<?php echo (HOME_IMGS); ?>circle/headportrait.jpg">
                        </div>
                        <div class="post-postpic">
                            <img class="post-postpic" src="<?php echo (HOME_IMGS); ?>circle/headportrait.jpg">
                        </div>
                        <div class="post-postpic">
                            <img class="post-postpic" src="<?php echo (HOME_IMGS); ?>circle/headportrait.jpg">
                        </div> -->
                        </div>
                        <div class="fine-information">
                            <p class="fine-joinin">阅读：<a>888</a></p>
                            <p class="fine-lasttime">最后回复：<a><?php echo ($data["post_time"]); ?></a></p>
                        </div>
                    </div>
                </div><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <!-- <div class="conter-main" style="display: none">
                这是私信界面
                <div class="dm">
                    <div class="dm-left">
                        <div class="dm-left-main">
                            <img class="dm-headportrait" src="<?php echo (HOME_IMGS); ?>circle/headportrait.jpg">
                            <a class="dm-time">这里是私信我人的ID</a>
                        </div>
                    </div>
                    <div class="dm-right">
                        <div class="dm-content">
                            <p>这里是私信我的内容</p>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="conter-main" style="display: none">
                <!-- 这是等级排行界面 -->
                <div class="graderank-title">
                    <p>圈内等级排行</p>
                </div>
                <div class="graderank-content">
                    <table>
                        <tr>
                            <th>头像ID</th>
                            <th>等级</th>
                            <th>排名</th>
                            <th>上下浮动</th>
                        </tr>
                        <tr>
                            <td>赏花人</td><td>66</td><td>1</td><td>-</td>
                        </tr>
                        <tr>
                            <td>赏花人</td><td>66</td><td>1</td><td>-</td>
                        </tr>
                        <tr>
                            <td>赏花人</td><td>66</td><td>1</td><td>-</td>
                        </tr>
                        <tr>
                            <td>赏花人</td><td>66</td><td>1</td><td>-</td>
                        </tr>
                        <tr>
                            <td>赏花人</td><td>66</td><td>1</td><td>-</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="gray" class="blk"></div>
<div class="main">
    <div id="close" class="closeBtn">
        <img src="<?php echo (HOME_IMGS); ?>circle/close.png" 	onmousemove="this.src='<?php echo (HOME_IMGS); ?>circle/close3.png'" onmouseout="this.src='<?php echo (HOME_IMGS); ?>circle/close.png'">
    </div>
   <!--  <form class="form-groups" action="<?php echo (URL); ?>Circle/post" method="post" enctype="multipart/form-data"> -->
    <form class="form-groups">
        <div class="postnote-select">
            <div class="select-modules">
                <p>圈子</p>
                <select class="post_circle_id">
                    <option><?php echo ($circle_name); ?></option>
                </select>
            </div>
            <div class="select-modules" >
                <p>游戏</p>
                <select class="post_game" id="circle">
                    <!-- 输出属于这个圈子的游戏 -->
                    <?php if(is_array($circle_game)): $i = 0; $__LIST__ = $circle_game;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$game): $mod = ($i % 2 );++$i;?><option><?php echo ($game["game_id"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
            <div class="select-modules"  >
                <p>区服</p>
                <select class="post_server" id="game">

                </select>
            </div>
        </div>
        <div class="select-main">
            <div class="select-title">
                <p>标题</p>
            </div>
            <input type="text" name="title-input" class="title-input"/>
        </div>
        <div class="postnote-content">
            <div class="postnote-content-title">
                <p>内容</p>
            </div>
            <textarea name="text-input"  class="text-input" cols="80" rows="5"></textarea>
        </div>
    
    <div class="postnote-post">
        <input type="submit" value="发帖" class="submit">
    </div>
   </form>
</div>
<script type="text/javascript" src="<?php echo (HOME_JS); ?>test/select.js"></script>
<script type="text/javascript" src="<?php echo (HOME_JS); ?>test/jquery.form.js"></script>
<script src="<?php echo (HOME_JS); ?>circle/jquery.js"> </script>
<script type="text/javascript" src="<?php echo (HOME_JS); ?>circle/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="<?php echo (HOME_JS); ?>circle/popup_layer.js"></script>
<script>
    $(document).ready(function() {
        var t9 = new PopupLayer({
            trigger: "#lowlattice-post",
            popupBlk: ".main",
            closeBtn: "#close",
            useOverlay: true,
            useFx: true,
            offsets: {
                x: -650,
                y: -150
            }
        });
        t9.doEffects = function (way) {
            if (way == "open") {
                this.popupLayer.css({opacity: 0.3}).show(300, function () {
                    this.popupLayer.animate({
                        left: ($(document.body).width() - this.popupLayer.width()) / 2,
                        top: (document.documentElement.clientHeight - this.popupLayer.height()) / 2 + $(document).scrollTop(),
                        opacity: 0.8
                    }, 300, function () {
                        this.popupLayer.css("opacity", 1)
                    }.binding(this));
                }.binding(this));
            }
            else {
                this.popupLayer.animate({
                    right: this.trigger.offset().left,
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
    $("#lowlattice-post").click(function(){
        $("#postnote").show();
    });
    $("#getmore").click(function(){
        var str = $(this).html();
        if(str[0]=='更'){
            $(this).html("&lt;&lt;返回");
            $("#select-more").show();
        }else{
            $(this).html("更多游戏&gt;&gt;");
            $("#select-more").hide();
        }
    });
    $(function(){
        //当滚动条的位置处于距顶部100像素以下时，跳转链接出现，否则消失
        $(function () {
            $(window).scroll(function(){
                if ($(window).scrollTop()>100){
                    $("#back-to-top").fadeIn(1500);
                }
                else
                {
                    $("#back-to-top").fadeOut(1500);
                }
            });

            //当点击跳转链接后，回到页面顶部位置

            $("#back-to-top").click(function(){
                $('body,html').animate({scrollTop:0},1000);
                return false;
            });
        });
    });
    $(document).ready(function () {
        $('.circlesquare-bar li').click(function () {
            var index = $(this).index();
            $('.conter-main').eq(index).show(100).siblings('.conter-main').hide();
        });});
    $(".circlesquare-bar li").click(function(){
        $(this).addClass("active");
        $(this).siblings().removeClass("active");
    });
    $(window).scroll(function () {
        var scrollTop = $(this).scrollTop();
        var scrollHeight = $(document).height();
        var windowHeight = $(this).height();
        if (scrollTop + windowHeight == scrollHeight) {

            //此处是滚动条到底部时候触发的事件，在这里写要加载的数据，或者是拉动滚动条的操作

var page = Number($(".conter-main").attr('currentpage')) + 1;
redgiftList(page);
$(".conter-main").attr('currentpage', page + 1);

        }
    });


    // 赵文奕的js


    // 发布帖子
    $('.submit').click(function(){
             var circle=$('.post_circle_id').find('option:selected').text();
             var game=$('.post_game').find('option:selected').text();
             var server=$('.post_server').find('option:selected').text();
             var title=$('.title-input').val();
             var text=$('.text-input').val();
             $.post("<?php echo (URL); ?>Circle/post",{'post_circle_id':circle,'post_game':game,'post_server':server,'title-input':title,'text-input':text},function(data){
                     window.location.reload();
             },'json');

    });
    // 进行删除帖子操作
    $('.post-admin-delete').click(function(){
        var post_id=$('.post_id').val();
        // alert(post_id);
        $.post("<?php echo (URL); ?>Circle/delete_post",{'post_id':post_id},function(data){
            if(data.status==1){
                alert(data.info);
                window.location.reload();
              }else{
                alert(data.info);
              }
        },'json');
    });
    
    // 进行帖子加精操作
    $('.post-admin-boutique').click(function(){
        var post_id=$('.post_id').val();
        $.post("<?php echo (URL); ?>Circle/boutique",{'post_id':post_id},function(data){
             if(data.status==1){
                alert(data.info);
                window.location.reload();
              }else{
                alert(data.info);
              }
        },'json');
    });

    // 进行关注圈子操作
   $('#follow_circle_btn').click(function(){
        var circle_id=$('.circle_id').val();
        $.post("<?php echo (URL); ?>Circle/follow_circle",{'circle_id':circle_id},function(data){
              if(data.status==1){
                alert(data.info);
                window.location.reload();
              }else{
                alert(data.info);
              }
        },'json');
    });

    //进行取消关注圈子操作
    $('#cancel_follow_circle_btn').click(function(){
        var circle_id=$('.circle_id').val();
        $.post('<?php echo (URL); ?>Circle/cancel_follow_circle',{'circle_id':circle_id},function(data){
            if(data.status==1){
                alert(data.info);
                window.location.reload();
            }else{
                alert(data.info);
            }
            // alert(1);
        },'json');
    });

    // 进行游戏筛选操作
</script>
</body>
</html>