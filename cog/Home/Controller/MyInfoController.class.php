<?php
namespace Home\Controller;
use Think\Controller;
class MyInfoController extends Controller {
   public function index(){
    $user_id=session('user_id');
   // 获取用户的信息
    $user=D('User');
    $res_user=$user->get_info($user_id);
    if($res_user){
      // print_r($res_user);
      $this->assign('res_user',$res_user);
    }

    // 获取用户关注的圈子信息
    $follow=D('Follow');
    $res_follow=$follow->get_follow_circle_info($user_id);
    if($res_follow){
      // print_r($res_follow);
      $this->assign('res_follow',$res_follow);
    }

    // 获取用户的帖子信息
    $post=D('Post');
    $res_post=$post->get_user_post($user_id);
    if($res_post){
      // print_r($res_post);
      $this->assign('res_post',$res_post);
    }
    // 获取回复用户信息
      $comment=D('Comment');
       $res_reply=$comment->get_user_reply($user_id);
       if($res_reply){
       // print_r($res_reply);
         $this->assign('res_reply',$res_reply);
       }
    // 获取回复用户的未读信息
     $res_mention=get_mention();
     $mention=count($res_mention);
     $this->assign('mention',$mention);
     $this->assign('res_mention',$res_mention);

    // 获取用户收藏帖子的信息
    $post=D('Post');
    $res_collect=$post->get_user_collect($user_id);
    if($res_collect){
      // print_r($res_collect);
      $this->assign('res_collect',$res_collect);
    }

    // 获取用户关注的人
    $follow=D('Follow');
    $res_subscribe=$follow->get_follow_id($user_id);
    if($res_subscribe){
      // print_r($res_subscribe);
      $this->assign('res_subscribe',$res_subscribe);
    }

    // 获取用户被关注的信息
    $res_subscribed=$follow->get_followed_id($user_id);
    if($res_subscribed){
      // print_r($res_subscribed);
      // 判断自己是否关注此用户
      foreach($res_subscribed as $k=>$v){
          foreach($v as $key=>$val){
             $check_follow=$follow->check_follow($user_id,$val['user_id']);
             $result_subscribed[]=array(
              'user_id'=>$val['user_id'],
              'user_name'=>$val['user_name'],
              'check_follow'=>$check_follow
              );
          }
          
         }
      // print_r($result_subscribed);
      $this->assign('res_subscribed',$result_subscribed);
    }

    

   	$this->display();
   }

    public function visitor(){
       $user_id=$_GET['user_id'];
   // 获取用户的信息
    $user=D('User');
    $res_user=$user->get_info($user_id);
    if($res_user){
      // print_r($res_user);
      $this->assign('res_user',$res_user);
    }

    // 获取用户关注的圈子信息
    $follow=D('Follow');
    $res_follow=$follow->get_follow_circle_info($user_id);
    if($res_follow){
      // print_r($res_follow);
      $this->assign('res_follow',$res_follow);
    }

    // 获取用户的帖子信息
    $post=D('Post');
    $res_post=$post->get_user_post($user_id);
    if($res_post){
      // print_r($res_post);
      $this->assign('res_post',$res_post);
    }
    // 获取回复用户信息
      $comment=D('Comment');
       $res_reply=$comment->get_user_reply($user_id);
       if($res_reply){
       // print_r($res_reply);
         $this->assign('res_reply',$res_reply);
       }
    // 获取回复用户的未读信息
     $res_mention=get_mention();
     $mention=count($res_mention);
     $this->assign('mention',$mention);
     $this->assign('res_mention',$res_mention);

    // 获取用户收藏帖子的信息
    $post=D('Post');
    $res_collect=$post->get_user_collect($user_id);
    if($res_collect){
      // print_r($res_collect);
      $this->assign('res_collect',$res_collect);
    }

    // 获取用户关注的人
    $follow=D('Follow');
    $res_subscribe=$follow->get_follow_id($user_id);
    if($res_subscribe){
      // print_r($res_subscribe);
      $this->assign('res_subscribe',$res_subscribe);
    }

    // 获取用户被关注的信息
    $res_subscribed=$follow->get_followed_id($user_id);
    if($res_subscribed){
      // print_r($res_subscribed);
      // 判断自己是否关注此用户
      foreach($res_subscribed as $k=>$v){
          foreach($v as $key=>$val){
             $check_follow=$follow->check_follow($user_id,$val['user_id']);
             $result_subscribed[]=array(
              'user_id'=>$val['user_id'],
              'user_name'=>$val['user_name'],
              'check_follow'=>$check_follow
              );
          }
          
         }
      // print_r($result_subscribed);
      $this->assign('res_subscribed',$result_subscribed);
    }

    

    $this->display();

    }


   // 进行取消关注操作
   public function cancel_subscribe(){
    $follow=D('Follow');
    $follow_id=$_POST['follow_id'];
    $res=$follow->cancel_subscribe(session('user_id'),$follow_id);
    if($res){
      $data['state']=1;
      $this->ajaxReturn($data,'',1);
    }else{
      $data['state']=0;
      $data['info']='error';
      $this->ajaxReturn($data,'',0);
    }
   }

   // 进行关注操作
   public function subscribe(){
    $follow=D('Follow');
    $follow_id=$_POST['follow_id'];
    $res=$follow->subscribe(session('user_id'),$follow_id);
   if($res){
      $data['state']=1;
      $this->ajaxReturn($data,'',1);
    }else{
      $data['state']=0;
      $data['info']='error';
      $this->ajaxReturn($data,'',0);
    }
    // print_r($res);
    // $this->display();
   }

   // 进行已读操作
   public function set_view(){
    $comment=D('Comment');
    $sql="alter table cog_comment set comment_view=1 where comment_id=$comment_id";
    $res=$comment->query($sql);
        if($res){
          return true;
        }else{
          return false;
        }
   }

   
}