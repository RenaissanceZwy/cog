<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html  onselectstart="return false">
<head lang="en">
    <meta charset="UTF-8">
    <title>游戏圈子-首页</title>
    <link rel="icon" href="../../../Public/images/icon.ico" >
    <style>
    </style>
</head>
<body>
	<select id="circle">
        <?php if(is_array($res_circle)): $i = 0; $__LIST__ = $res_circle;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$circle): $mod = ($i % 2 );++$i;?><option><?php echo ($circle["circle_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
    </select >
    <select id="game">
    </select>
    <script type="text/javascript" src="<?php echo (HOME_JS); ?>test/jquery.js"></script>
    <script type="text/javascript" src="<?php echo (HOME_JS); ?>test/jquery.form.js"></script>
    <script type="text/javascript">
          $('#circle').bind('change',function(){
            var circle_name=$(this).val();
            $.post("<?php echo (URL); ?>Test/get_game",{'circle_name':circle_name},function(data){
                
                if(data.state==1){
                    var game=eval("("+data.info+")");
                    $("#game").children().remove();
                    $.each(game,function(k,v){
                      var option = document.createElement("option");
                      option.innerHTML=v;
                      $("#game").append(option);
                      // $("#game").innerHTML="<option>"+v+"</option>";
                    });
                     
                }else{
                     alert(data.info);
                }
            },'json');
          });
    </script>
</body>
</html>