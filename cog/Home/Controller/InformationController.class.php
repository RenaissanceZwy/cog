<?php
namespace Home\Controller;
use Think\Controller;
use Think\fileUpload;
class InformationController extends Controller
{
	function information()
	{   
		$this -> assign('username',session('username'));
		$this -> display();
	}
	function information_add()
	{
		$data['User_sex'] = $_POST['radio'];
		$data['User_note'] = $_POST['note'];

		$time['year'] = $_POST['select_year'];
		$time['month'] = $_POST['select_month'];
		$time['day'] = $_POST['select_day'];
		$data['User_birth'] = $time['year']."-".$time['month']."=".$time['day'];

		$addr['province'] = $_POST['province'];
		$addr['city'] = $_POST['city'];
		$addr['area'] = $_POST['area'];
		$data['User_addr'] = $addr['province'].$addr['city'].$addr['area'];
		$name['User_name'] = session('username');

		//上传帖子图片到服务器
    	$upload=new fileUpload('MyFile','cog/Public/imgs/user-headimg');//实例化上传类
    	$res=$upload->uploadFile();
    	if($res){
              $data['User_headimg']=$res;
    	}else{
            $this->error("图片上传失败");
    	}

		$user= D("User");
		$res = $user -> information($name,$data);
		if($res)
		{
			$user=new \Home\Model\UserModel();
			$user_id=$user->get_userid($name);
			$user_headimg=$user->get_userimg($name);
			if($user_headimg){
				session('user_headimg',$user_headimg);
			}
			session('user_id',$user_id);

			$this->success("信息更新成功！",U('Index/index')) ;
		}
		else
		{
			$this->error("信息更新失败！！！") ;
		}
	}



}
