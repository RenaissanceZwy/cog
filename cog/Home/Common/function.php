<?php
// 圈子复选框获取游戏名
   function get_game(){
    $circle_name=$_POST['circle_name'];
    $circle=D('Circle');
    $res_game=$circle->get_game($circle_name);
    if($res_game){
      $data['state']=1;
     // 出现中文乱码的情况啦
      // 获取到的结果是二维数组,需要用urlencode
      foreach($res_game as $k=>$v){
        foreach ($v as $key => $value) {
         $res[]=urlencode($value);
        }
      }
      $res_game=urldecode(json_encode($res));
      $data['info']=$res_game;
      $this->ajaxReturn($data,'',1);
    }else{
      $data['state']=0;
      $data['info']=$res_game;
      $this->ajaxReturn($data,'',0);
    }
  }

    // 获取用户是否有信息
  function get_mention(){
    $user_id=session('user_id');
    $comment=D('Comment');
    $res=$comment->get_mention($user_id);
    if($res){
      return $res;
    }else{
      return false;
    }
  }


 function test(){
  echo 2;
 }
   
