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
    <div id="msg"></div>
      
    <input id="btn" type="hidden" value="测试"  />   
	
    <script type="text/javascript" src="<?php echo (HOME_JS); ?>test/jquery.form.js"></script>
<script src="<?php echo (HOME_JS); ?>circle/jquery.js"> </script>
    <script type="text/javascript" src="<?php echo (HOME_JS); ?>test/jquery.form.js"></script>
    <script type="text/javascript">
     $(function(){ 
     $("#btn").bind("click",{btn:$("#btn")},function(evdata){  

     $.ajax({  
    type:"POST",  
    dataType:"json",  
    url:"<?php echo (URL); ?>Test/test",  
    timeout:80000,  //ajax请求超时时间80秒  
    data:{time:"80"}, //40秒后无论结果服务器都返回数据  
    success:function(data,textStatus){  
     //从服务器得到数据，显示数据并继续查询  
     if(data.success=="1"){  
      $("#msg").append("<br>[有数据]"+data.text);  
      evdata.data.btn.click();  
     }  
     //未从服务器得到数据，继续查询  
     if(data.success=="0"){  
     // $("#msg").append("<br>[无数据]");  
     evdata.data.btn.click();  
     }  
    },  
    //Ajax请求超时，继续查询  
    error:function(XMLHttpRequest,textStatus,errorThrown){  
      if(textStatus=="timeout"){  
       $("#msg").append("<br>[超时]");  
       evdata.data.btn.click();  
      }  
    }  
   });  
 });  

}); 
     $(document).ready(function(){
       $('#btn').click();
     });
    </script>
</body>
</html>