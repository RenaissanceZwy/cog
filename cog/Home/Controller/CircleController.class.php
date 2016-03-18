<?php
namespace Home\Controller;
use Think\Controller;
use Think\fileUpload;
class CircleController extends Controller {
    // 圈子主页
    public function index(){

      // 显示最近浏览的圈子
      $follow=D('Follow');
      $res_recent=$follow->get_recent_view(session('user_id'));
      $this->assign('res_recent',$res_recent);
      // 显示最新创建的圈子
      $circle=D('Circle');
      $new_circle=$circle->get_new_circle();
      if($new_circle){
       $this->assign('new_circle',$new_circle);
      }

      // 获取热门圈子
     
      $circle=D('Circle');
      $res_hotCircle=$circle->get_hot_circle();
      if($res_hotCircle){
        $this->assign('res_hotCircle',$res_hotCircle);
      }else{
        // 显示最近创建的圈子
         $new_circle=$circle->get_new_circle();
         // var_dump($new_circle);
         $this->assign('res_hotCircle',$new_circle);
      }
      // var_dump($res_hotCircle);
      $this->display();
    }

    // 具体的圈子界面
    public function circlesquare(){
      $circle_id=$_GET['circle_id'];
      session('circle_id',$circle_id);

      // 进行圈子已读操作，用于最近浏览
      $follow=D('Follow');
      $follow->recent_view(session('user_id'),$circle_id);
      // 获取圈子的相关信息
      $circle=D('Circle');
      $res_circle=$circle->get_concrete_circle( session('circle_id'));
      $this->assign('circle_info',$res_circle);
      // var_dump($res_circle);
      
      //获取圈子的名字
      $circle_data['circle_id']=$circle_id;
      $circle_name=$circle->where($circle_data)->getField('circle_name');
      $this->assign('circle_name',$circle_name);

      // 判断用户是否关注这个圈子
      $follow=D('follow');
      $i=$follow->check_user_follow_circle(session('user_id'),session('circle_id'));
      // $res_follow_circle=$follow->get_follow_circle(session('user_id'));
      // if($res_follow_circle){
      //   if(strpos($res_follow_circle,'|')){
      //     $follow_circle=explode('|',$res_follow_circle);
      //     if(in_array(session('circle_id'),$follow_circle)){
      //       $i=1;
      //     }else{ $i=0;}
      //   }else{
      //     if(session('circle_id')==$res_follow_circle){
      //       $i=1;
      //     }else{ $i=0; }
      //   }
      // }else{ $i=0; }
      $this->assign('circle_follow_check',$i);

      // 获取这个圈子的游戏
       $res_circle_game=$circle->get_circle_game(session('circle_id'));
       if($res_circle_game){
         $this->assign('circle_id',session('circle_id'));
         $this->assign('circle_game',$res_circle_game);
       }

      // 获取用户信息
      $user=D('User');
      $res_user=$user->get_info(session('user_id'));
      if($res_user){
        // var_dump($res_user);
        $this->assign('user_info',$res_user);
      }

      // 获取属于这个圈子的所有帖子
       $post=new \Home\Model\PostModel();
      if(is_null($_GET['game_id'])){
        $res=$post->get_circle_post(session('circle_id'));
       	$this->assign('post',$res);
       }else if($_GET['game_id']){
        $res=$post->get_circle_game_post(session('circle_id'),$_GET['game_id']);
        $this->assign('post',$res);
       }
       // 判断帖子是否是登录用户所发布的
       $this->assign('user_id',session('user_id'));
       $monitor_id=$circle->get_circle_monitor(session('circle_id'));
       $this->assign('monitor_id',$monitor_id);


       //获取特定圈子精品贴信息
       $res_boutique=$post->get_boutique_post(4);
       if($res_boutique){
        $this->assign('boutique_post',$res_boutique);
        // var_dump($res_boutique);
       }
       
       // 获取特定圈子收藏帖子信息
       $user=D('User');
       $da['User_id']=session('user_id');
       $res_collect=$user->get_collect_post($da);
       if($res_collect){
          $split='|';
          if(strpos($res_collect,$split)){
            $res_collect=explode('|',$res_collect);
            foreach($res_collect as $k=>$v){
              $collect_post[]=$post->get_collect_post($v,session('circle_id'));
              // foreach($collect as $key=>$val){
              //   $key='post';
              //   $collect_post[]=array($key=>$val);
              // }
            }
          }else{
            $collect_post[]=$post->get_post($res_collect);
          }

       }
       $this->assign('collect_post',$collect_post);

       // 获取回复用户信息
       $comment=D('Comment');
       $res_reply=$comment->get_reply_info(session('user_id'),session('circle_id'));
       if($res_reply){
         $this->assign('res_reply',$res_reply);
       }

       
       $this->display();
    }


    // 帖子信息存储
    public function post(){
    	// 获取前台传递出来的帖子信息
    	$data['post_circle_id']=session('circle_id');
    	$data['post_user']=session('user_id');
    	$data['post_title']=$_POST['title-input'];
    	$data['post_content']=$_POST['text-input'];
    	$data['post_game']=$_POST['post_game'];
    	$data['post_time']=date('y-m-d H:i:s',time());
    	$data['post_server']=$_POST['post_server'];

    	//上传帖子图片到服务器
    	// $upload=new fileUpload('MyFile1','cog/Public/imgs/post-imgs');//实例化上传类
    	// $res=$upload->uploadFile();
    	// if($res){
     //          $data['post_img']=$res;
    	// }else{
     //        $this->error("图片上传失败");
    	// }

        // 调用post类并进行实例化
        $post=new \Home\Model\PostModel();
        $res=$post->insert_info($data);
        if($res){
        	$data['status']=1;
        $data['info']='帖子发布成功';
        $this->ajaxReturn($data,'',1);
        }else{
        	$data['status']=0;
        $data['info']='帖子发布失败成功';
        $this->ajaxReturn($data,'',0);
        }

    }

    public function post_img(){
    	$upload=new fileUpload('MyFile1','./cog/Public/imgs/post-imgs');//实例化上传类
    	$res=$upload->uploadFile();
    	if($res){
              
    	}else{
            $this->error("$error");
    	}

    }

    // 删除帖子
    public function delete_post(){
    	$post_id=$_POST['post_id'];
    	$post=new \Home\Model\PostModel();
    	$res=$post->delete_post($post_id);
        if($res){
            $data['status']=1;
            $data['info']='删除帖子成功';
            $this->ajaxReturn($data,'',1);
        }else{
        	$data['status']=0;
          $data['info']='删除帖子失败';
          $this->ajaxReturn($data,'',0);
        }
    	
    }

    // 对帖子进行加精操作
    public function boutique(){
        $post_id=$_POST['post_id'];
        $post=D('Post');
        $res=$post->boutique($post_id);
        if($res){
            $data['status']=1;
            $data['info']='帖子加精成功';
            $this->ajaxReturn($data,'',1);
        }else{
           $data['status']=0;
            $data['info']='帖子加精失败';
            $this->ajaxReturn($data,'',0);
        }
    }

    // 对圈子进行关注操作
    public function follow_circle(){
      $circle_id=$_POST['circle_id'];
      //将信息存储在用户关注表里
      $follow=D('Follow');
      $res=$follow->follow_circle(session('user_id'),$circle_id);
      // 将信息存储在圈子表里
      $circle=D('Circle');
      $res_circle=$circle->insert_circle_followers($circle_id,session('user_id'));
      if($res){
        $data['status']=1;
         $data['info']='关注成功';
        $this->ajaxReturn($data,'',1);
        // echo $data['info'];
      }else{
        $data['status']=0;
        $data['info']='关注失败';
        $this->ajaxReturn($data,'',0);
      }
    }

    // 对圈子进行取消关注操作
    public function cancel_follow_circle(){
      $circle_id=$_POST['circle_id'];
      // 更新用户关注表的信息
      $follow=D('Follow');
      $res=$follow->cancel_follow_circle(session('user_id'),$circle_id);
      // 更新圈子表的信息
      $circle=D('Circle');
      $res_circle=$circle->update_circle_followers($circle_id,session('user_id'));
      if($res){
        $data['status']=1;
        $data['info']='取消关注成功';
        $this->ajaxReturn($data,'',1);
        //  echo $data['info'];
        // echo $res;
      }else{
        $data['status']=0;
        $data['info']='取消关注失败';
        $this->ajaxReturn($data,'',0);
        // echo $data['info'];
        // echo $res;
      }

    }

    public function test(){
    $post=D('Post');
    $res=$post->boutique(14);
     if($res){
      echo 1;

     }else{
      echo 0;
     }
     
    }
}