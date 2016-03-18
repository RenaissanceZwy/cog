<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller
{
	public function login()
	{
		$this -> display();
	}
	function handle()
	{
		
		$data['User_name'] = $_POST['username'];
		$data['User_password'] = $_POST['password'];

		$user=new \Home\Model\UserModel();
		$res = $user -> get_user($data);
		// var_dump($res);
		// return ;
		if($res)
		{
			// echo "登陆成功！！！";
			// 获取该用户的id
			$user=new \Home\Model\UserModel();
			$user_id=$user->get_userid($data);
			$user_headimg=$user->get_userimg($data);
			if($user_headimg){
				session('user_headimg',$user_headimg);
			}
			session('user_id',$user_id);
			session('username',$data['User_name']);
            if($user_id==1){
            	$this->redirect('/Home/Management/index');
            }else{
            	$this->redirect('/Home/Index/index');
            }
			
		}
		else
		{
			echo "登陆失败，请查正后再试！！！";
			$this -> redirect('Home/Login/main_login',Array('cat'=>3),3,'3秒后跳转至登陆页面！！！');
		}
	}

	function main_login(){
        $this->display();
	}

	function check_name(){
		$name=$_POST['name'];
		$user=D('User');
		$data['User_name']=$name;
		$res=$user->where($data)->select();
		if($res){
			echo 'true';
		}else{
			echo 'false';
		}
	}

	function check_pwd(){
		$pwd=$_POST['pwd'];
		$name=$_POST['name'];
		$user=D('User');
		$data['User_name']=$name;
		$data['User_password']=$pwd;
		$res=$user->where($data)->select();
		if($res){
			echo 'true';
		}else{
			echo 'false';
		}
	}

}
