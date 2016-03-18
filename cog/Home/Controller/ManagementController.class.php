<?php
namespace Home\Controller;
use Think\Controller;
use Think\fileUpload;
class ManagementController extends Controller {
   
   public function index(){
    // 帖子管理
    // 显示帖子
    // 进行帖子筛选操作
    if(session('post_filtrate')){
      $res_post=session('post_filtrate');
    }else{
      $res_post=$this->post();
    }
    
    
    $this->assign('post',$res_post);
    
    // 获取所有的圈子
    $circle=D('Circle');
    $res_circle=$circle->get_all_circle();
    $this->assign('res_circle',$res_circle);

    // 新闻管理
     $news=D('News');
     $res_news=$news->get_info();
     $this->assign('res_news',$res_news);
     // 用户管理
     $user=D('User');
     $res_user=$user->get_all_user();
     $this->assign('res_user',$res_user);
    // 圈子管理
    $res_circle=$this->circle_management();
    if($res_circle){
      $this->assign('res_circle',$res_circle);
    }
    
   	$this->assign('username',session('username'));
    $this->assign('userid',session('user_id'));
   	$this->assign('userimg',session('user_headimg'));
   	$this->display();
   }

   // 创建圈子
   public function create_circle(){
    $data['circle_name']=$_POST['circle_name'];
    $data['circle_location']=$_POST['province'].$_POST['city'].$_POST['area'];
    // $data['circle_game_id']=$_POST['circle_game'];
    $data['circle_describe']=$_POST['circle_describe'];
    $data['circle_post_num']=0;
    $data['circle_time']=date('Y-m-d h-m-s',time());

    //上传帖子图片到服务器
  $upload=new fileUpload('MyFile','cog/Public/imgs/circle-upload');//实例化上传类
  $res=$upload->uploadFile();
  if($res){
          $data['circle_img']=$res;
  }else{
        $this->error("图片上传失败");
  }

  //实例化circle类
  $circle=new \Home\Model\CircleModel();
  $res=$circle->insert_info($data);
  if($res){
         $this->success();
  }else{
        $this->error();
  }
   }

   // 圈子管理
   public function circle_management(){
    // 获取所有的圈子信息
    $circle=D('Circle');
    $res=$circle->get_all_circle();
    if($res){
      return $res;
    }else{
      echo 0;
    }
   }
   // 进行删除圈子操作
   public function circle_delete(){
    $circle_id=$_GET['circle_id'];
    $circle=D('Circle');
    $res=$circle->circle_delete($circle_id);
    if($res){
      $this->success();
    }else{
      $this->error();
    }
  }

  // 进行修改管理员操作
  public function change_admin(){
    $circle_id=$_GET['circle_id'];
    $circle_monitor_id=$_GET['circle_monitor_id'];
    $circle=D('Circle');
    $res=$circle->change_admin($circle_id,$circle_monitor_id);
    if($res){
      $this->success();
    }else{
      $this->error();
    }
  }

  //显示所有帖子
  public function post(){
    $post=D('Post');
    $res=$post->get_info();
    if($res){
      return $res;
    }else{
      return null;
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
   // 新闻发布操作
    public function release_news(){
      $title=$_POST['title'];
      $content=$_POST['editor'];
      $time=date('Y-m-d-h-m-s',time());
      $upload=new fileUpload('MyFile','cog/Public/imgs/news');//实例化上传类
      $res_img=$upload->uploadFile();

      // 将内容存到文件里面
      $filepath="./cog/news/".$time.".txt";
      $newsfile=fopen($filepath, "w") or die("unable to open file");
      fwrite($newsfile, $content);
      fclose($newsfile);

    
      
      // 将新闻的信息插入到数据库里面
      $data['news_title']=$title;
      $data['news_filename']=$time.".txt";
      $data['news_time']=$time;
      $data['news_view']=0;
      $data['news_img']=$res_img;
      $news=D('News');
      $res=$news->insert_info($data);
      if($res){
        // $data['state']=1;
        // $data['info']='新闻创建成功';
        // $this->ajaxReturn($data,'',1);
        $this->success();
      }else{
        //  $data['state']=0;
        // $data['info']='新闻创建失败';
        // $this->ajaxReturn($data,'',0);
        $this->error();
      }

    }
    // 上传图片操作
    public function upload_img(){
      // $title=$_POST['formdata'];
      // $content=$_POST['content'];
      // $upload=new fileUpload('MyFile','cog/Public/imgs/news');//实例化上传类
      // $res=$upload->uploadFile();
     // echo 'success';
      
    }

    // 进行删除新闻操作
    public function delete_news(){
       $news_id=$_POST['news_id'];
      $news=D('News');
      $res=$news->delete_news($news_id);
      if($res){
         $data['state']=1;
        $data['info']='新闻删除成功';
        $this->ajaxReturn($data,'',1);
      }else{
        $data['state']=0;
        $data['info']='新闻删除失败';
        $this->ajaxReturn($data,'',0);
      }
    }

    // 进行筛选新闻操作
    public function filtrate_news(){
      $condition=$_POST['condition'];
      $news=D('News');
      $res=$news->filtrate_news($condition);
      if($res){
         $data['state']=1;
        $data['info']='新闻筛选成功';
        $this->ajaxReturn($data,'',1);
      }else{
        $data['state']=0;
        $data['info']='新闻筛选失败';
        $this->ajaxReturn($data,'',0);
      }
    }

    // 删除用户操作
    public function delete_user(){
      $user_id=$_POST['user_id'];
      $user=D('User');
      $res=$user->delete_user($user_id);
       if($res){
         $data['state']=1;
        $data['info']='用户删除成功';
        $this->ajaxReturn($data,'',1);
      }else{
        $data['state']=0;
        $data['info']='用户删除失败';
        $this->ajaxReturn($data,'',0);
      }
    }

    // 进行帖子筛选操作
    public function post_filtrate(){
      $circle_name=$_POST['circle_name'];
      $circle_game=$_POST['circle_game'];
      $condition=$_POST['condition'];
      $post=D('Post');
      switch ($condition) {
        case '按时间':
           $res=$post->post_filtrate_time($circle_name,$circle_game);
          break;
        case '按热度':
          $res=$post->post_filtrate_hot($circle_name,$circle_game);
          break;
       
      }
     
      if($res){
        // session('post_filtrate',$res);
          $data['post']=$res;
          $data['state']=1;
          $data['info']='筛选成功';
        $this->ajaxReturn($data,'',1);
      }else{
          $data['state']=0;
          $data['info']='筛选失败';
         $this->ajaxReturn($data,'',0);
      }
    }

    function show_post(){
      $post=D('Post');
      $res=$post->get_info();
      if($res){
        // session('post_filtrate',$res);
          $data['post']=$res;
          $data['state']=1;
          $data['info']='筛选成功';
        $this->ajaxReturn($data,'',1);
      }else{
          $data['state']=0;
          $data['info']='显示失败';
         $this->ajaxReturn($data,'',0);
      }
    }


}