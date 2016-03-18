<?php
namespace Home\Controller;
use Think\Controller;
class MyCircleController extends Controller {

   public function index(){
   	// 获取用户关注的圈子id 
   	$follow=D('Follow');
   	$res_follow_circle=$follow->get_follow_circle(session('user_id'));
   	if($res_follow_circle){
   		// 将获取出来的字符串拆分为数组
       	$follow_circle=explode('|',$res_follow_circle);
        //获取用户关注的圈子名字
        foreach($follow_circle as $k=>$v){
        	$circle=D('circle');
        	$circle_info=$circle->get_concrete_circle($v);
        	$concrete_circle_info[]=$circle_info;
        }
        // 将用户关注的圈子信息输出;
        $this->assign('concrete_circle_info',$concrete_circle_info);
   	}
    // 将用户关注的所有的圈子都输出出来
     

   	// 将筛选后的帖子输出
   	$res_circle_post=$this->get_circle_post();
   	if($res_circle_post){
   		// print_r($res_circle_post);
   		$this->assign('circle_post',$res_circle_post);
   	}else{
      $post=D('Post');
     $res_circle_post=$post->get_info();
     $this->assign('circle_post',$res_circle_post);
    }
   
   	$this->assign('username',session('username'));
    $this->assign('userid',session('user_id'));
   	$this->assign('userimg',session('user_headimg'));
   	$this->display();
   }
    
    public function get_circle_post(){
    	$post=D('Post');
    	$circle_id=$_POST['circle'];
      if($circle_id){
        $res=$post->get_circle_post($circle_id);
        if($res){
          return $res;
        }else{
          return  null;
        }
      }
    	
    }


}