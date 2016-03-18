<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller{
	public function index(){

    // 获取用户头像和id
    $user=D('User');
    $data['User_id']=session('user_id');
    $res_img=$user->get_userimg ($data);
    $this->assign('headimg',$res_img);
    //获取特定帖子的信息
    if(isset($_GET['post_id'])){
      $post_id=$_GET['post_id'];
    }else if(session('post_id')){
      $post_id=session('post_id');
    }
    $this->assign('post_id',$post_id);
    session('post_id',$post_id);
   

    // 将登录用户与发帖人进行判断
    $this->assign('user_id',session('user_id'));
    $circle=D('Circle');
    $monitor_id=$circle->get_circle_monitor(session('circle_id'));
    $this->assign('monitor_id',$monitor_id);
    // 获取帖子信息
    $post=new \Home\Model\PostModel();
    $res_post=$post->get_post($post_id);
       if($res_post){
        $this->assign('post',$res_post);
        // var_dump($res_post);
       }

    
		// 获取评论信息
		
		$result=$this->getlist($post_id);
		// var_dump($result);
        // 循环输出评论信息
    foreach($result as $key=>$value){
        if(is_array($value)) {
            foreach($value as $v){
               $data[]=$v;
            }

        }else echo'出现错误';
    }
    $this->assign('data',$data);
	   $this->display();
	}

	// 使用无限极分类技术获取评论列表
	public function getlist($post_id=1,$pid=0,&$result=array()){
        $com=new \Home\Model\CommentModel();
        $res=$com->get_info($post_id,$pid); //获取父评论
        if(!$res){
          return array();
        }else{
        	foreach($res as $key=>$value){
        	   $result[]=array($key=>$value);
               $this->getlist($post_id,$value['comment_id'],$result);//递归调用函数
        	}
            
        }
        return $result;
	}

  // 发表评论
	public function comment(){
		//判断是评论操作还是回复操作
    // $this->success('进入到函数来了');
		if($_POST['submit']=='评论'){
           $data['comment_pid']=0;
           $data['comment_puser_id']=0;
           $data['comment_puser_name']=null;
           $data['comment_view']=0;
           $data['comment_content']=$_POST['comment'];
		}else if($_POST['submit']=='回复'){
           $data['comment_pid']=$_POST['comment_id'];
           $data['comment_puser_id']=$_POST['comment_user_id'];
           // 获取用户名
           $user=D('User');
           $user_id['User_id']=$_POST['comment_user_id'];
           $data['comment_puser_name']=$user->where($user_id)->getField('User_name');
           $data['comment_content']=$_POST['reply'];
           $data['comment_view']=0;
           // $this->success('进入到这里来了');
           // $info['status']=1;
           // $this->ajaxReturn($info);
		}
		$data['post_circle_id']=session('circle_id');
		$data['post_id']=session('post_id');
		$data['comment_time']=date("Y-m-d h:i:s",time());
		$data['comment_user_id']=session('user_id');
    session('post_id',$_POST['post_id']);
		// 实例化comment类并插入数据
		$com=new \Home\Model\CommentModel();
		$res=$com->insert_info($data);
		if($res){
          $da['status']=1;
          $da['info']='评论成功';
          $this->ajaxReturn($da,'',1);
          // $this->success();
		}else{
            $da['status']=0;
          $da['info']='评论失败';
          $this->ajaxReturn($da,'',0);
          // $this->error();
		}
	}

  // 删除评论
  public function delete_comment(){
    $comment_id=$_POST['comment_id'];
    $comment=new \Home\Model\CommentModel();
    $res=$comment->delete_comment($comment_id);
    if($res){
        $da['state']=1;
          $da['info']='评论删除成功';
          $this->ajaxReturn($da,'',1);
    }else{
       $da['state']=0;
          $da['info']='评论删除成功';
          $this->ajaxReturn($da,'',0);
    }
  }

  // 帖子收藏操作
  public function collect_post(){
    $post_id=$_POST['post_id'];
    $da['User_id']=session('user_id');
    $user=D('User');
    $res=$user->collect($da,$post_id);
    if($res){
       $data['status']=1;
      $data['info']='收藏成功';
      $this->ajaxReturn($data,'',1);
    }else{
      $data['status']=0;
      $data['info']='收藏失败';
      $this->ajaxReturn($data,'',0);
    }
   
  }

  // 获取收藏的帖子信息
  public function get_collect_post(){
    $user=D('User');
    $da['User_id']=session('user_id');
    $res=$user->get_collect_post($da);
    var_dump($res);
  }

  // 获取用户是否有信息
  public function get_mention(){
    $user_id=session('user_id');
    $comment=D('comment');
    $data['comment_puser_id']=$user_id;
    $data['comment_view']=0;
    $res=$comment->where($data)->select();
    if($res){
      return $res;
    }else{
      return false;
    }
  }

}
