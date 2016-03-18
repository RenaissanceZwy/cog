<?php
namespace Home\Controller;
use Think\Controller;
use Think\fileUpload;
class TestController extends Controller{
	public function index(){
     $test=D('Test');
     $data['state']=0;
     $res=$test->where($data)->find();
     echo $res['content'];
    $this->display();
  }
  
  // 进行复选框测试
  public function select(){
    // 获取所有的圈子的名字
    $circle=D('Circle');
    $res_circle=$circle->get_all_circle();
    $this->assign('res_circle',$res_circle);
    $this->display();
  }
  public function get_game(){
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

  public function test(){
    if(empty($_POST['time']))
      exit();  
    set_time_limit(0);//无限请求超时时间  
    $i=0;  
    while (true){  
     //sleep(1);  
     usleep(500000);//0.5秒  
     $i++;  
     //若得到数据则马上返回数据给客服端，并结束本次请求  
     $test=D('Test');
     $data['state']=0;
     $res=$test->where($data)->find();
     if($res){  
      $arr=array('success'=>"1",'name'=>'xiaocai','text'=>$res['content']);  
      echo json_encode($arr);  
      $d['state']=1;
      $result=$test->where($data)->save($d);
      exit();  
     }  
     //服务器($_POST['time']*0.5)秒后告诉客服端无数据  
     if($i==$_POST['time']){  
      $arr=array('success'=>"0",'name'=>'xiaocai','text'=>'0');  
      echo json_encode($arr);  
      exit();  
     }  
    } 
  }

  public function test_pre(){
    if(empty($_POST['time']))
      exit();  
    set_time_limit(0);//无限请求超时时间  
    $i=0;  
    while (true){  
     //sleep(1);  
     usleep(500000);//0.5秒  
     $i++;  
     //若得到数据则马上返回数据给客服端，并结束本次请求  
     $rand=rand(1,999);  
     if($rand<=15){  
      $arr=array('success'=>"1",'name'=>'xiaocai','text'=>$rand);  
      echo json_encode($arr);  
      exit();  
     }  
     //服务器($_POST['time']*0.5)秒后告诉客服端无数据  
     if($i==$_POST['time']){  
      $arr=array('success'=>"0",'name'=>'xiaocai','text'=>$rand);  
      echo json_encode($arr);  
      exit();  
     }  
    } 
  }

   public function upload(){
      $name=$_POST['name'];
      $formdata=$_FILES["file"]['filename'];
      $upload=new fileUpload($_FILES["file"],'cog/Public/imgs/post-imgs');//实例化上传类
      $res=$upload->uploadFile();
      $news=D('News');
      $data['news_id']=12;
      $d['news_title']=$formdata;
      $news->where($data)->save($d);
      if($res){
         echo 1;
            
      }else{
         echo 0;
      }
    }

    public function post(){
       test();
       $this->display();
    }


}
