<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
   
    // public function index()
    // {
    // 	$this->display('Login:login');
    	
    // }

   public function index(){
     // 判断是否有新的消息

    // 获取新闻信息
    $news=D('News');
    $res_news=$news->get_info(3);
    foreach ($res_news as $key => $value) {
      $path='./cog/news/'.$value['news_filename'];
      $newsfile=fopen($path,'r');
      $content=fread($newsfile,filesize($path));
      $res_news[$key]['news_filename']=$content;
      fclose($newsfile);
    }
    // var_dump($res_news);
    $this->assign('res_news',$res_news);
    
    // 获取用户关注的圈子的id
      $follow=D('Follow');
      $circle_id=$follow->get_follow_circle(session('user_id'));
      $circle_id=explode('|',$circle_id);
      $circle=D('Circle');
      foreach($circle_id as $k=>$v){
        if($v){
          $circle_res[]=$circle->get_concrete_circle($v);
        }
        
      }
      $this->assign('circle_follow',$circle_res);
    
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
    // 获取热门帖子
    $post=D('Post');
    $res_post=$post->get_hotPost();
    // var_dump($res_post);  
    $this->assign('res_post',$res_post);

    // 获取新闻
    $news=D('News');
    $res_news=$news->get_info();
    $this->assign('res_news',$res_news);
    // var_dump($res_news);

    // 获取附近的圈子
    $zone=cookie('zone');
    $res_neighbor=$circle->get_neighbor_circle($zone);
    $this->assign('res_neighbor',$res_neighbor);
    echo $zone;
    // var_dump($res_neighbor);


    $this->assign('username',session('username'));
    $this->assign('userid',session('user_id'));
   	$this->assign('userimg',session('user_headimg'));
   	$this->display();
   }
   public function get_neighbor_circle(){
    // 获取附近的圈子
    $zone=$_POST['zone'];
    cookie('zone',$zone);
    $data['state']=1;
    $this->ajaxReturn($data,'',1);
   }


}