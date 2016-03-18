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
    
    <form id="form1"  enctype="multipart/form-data">
       <!--  <form id="form1" action="<?php echo (URL); ?>Test/upload" method="post" enctype="multipart/form-data"> -->
        <input type="file" id="file" name="file" >
        <input type="text" id="name" name="name">
        <input type="submit" value="上传" id="submit">
    </form>
	
    <script type="text/javascript" src="<?php echo (HOME_JS); ?>test/jquery.form.js"></script>
<script src="<?php echo (HOME_JS); ?>circle/jquery.js"> </script>
    <script type="text/javascript" src="<?php echo (HOME_JS); ?>test/jquery.form.js"></script>
    <script type="text/javascript">
      $('#submit').click(function(){
        var formdata=new FormData($('#form1'));
        var name=$('#name').val();
        $.ajax({
         type:'POST',
         url:"<?php echo (URL); ?>Test/upload",
         
        dataType:"json",  
        contentType: false,            
        processData: false,
        success:function(data,textStatus){
            if(data==true){
                alert(1);
            }
            
        }
        });
     

      });
    </script>
</body>
</html>