<?php
namespace Home\Controller;
use Think\Controller;
use Think\fileUpload;
header('Access-Control-Allow-Origin: *');
class CreateCircleController extends Controller {

   public function index(){
   	$this->display();
   }

   public function create_circle(){
   	$data['circle_name']=$_POST['circle_name'];
   	$data['circle_location']=$_POST['circle_location'];
   	$data['circle_game_id']=$_POST['circle_game'];
   	$data['circle_describe']=$_POST['circle_describe'];
    $data['circle_time']=date('Y-m-d h-m-s',time());

    //上传帖子图片到服务器
	$upload=new fileUpload('MyFile1',"cog/Public/imgs/circle-upload");//实例化上传类
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
}