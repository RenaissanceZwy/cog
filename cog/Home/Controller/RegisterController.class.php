<?php
namespace Home\Controller;
use Think\Controller;
header('charset=utf-8');
class RegisterController extends Controller
{
	function register()
	{
		$this -> check();
		$this -> display();
	}

	function check()
	{
		$data['User_name'] = $_GET['name'];
		// echo $data['User_name'];
		// return ;
		//$data['User_name'] = zzz;
		$user = new \Home\Model\UserModel();
		$res = $user -> get_user($data);
		if($res){
			echo $res;
		}
		
		//return $res;
	}

	function mail_regist()
	{
		$data['User_name'] = $_POST['username'];
		$data['User_Email'] = $_POST['Email'];
		$data['User_reg_time'] = date('Y-m-d',time());
		$data['User_password'] = $_POST['password'];
		// if($_POST['password'] == $_POST['repwd'])
		// {
		// 	$data['User_password'] = $_POST['password'];
		// }
		// else
		// {

		// 	//redirect('{$Think.const.SITE_URL}Home/Register/register',3);
		// 	//redirect('/Register/register',3);
		// 	$this -> redirect('Home/Register/register',Array('cat'=>3),3,'3秒后跳转注册页面！！！');
		// 	return ;
		// }
		
		// print_r($data);
		// return ;

		$user = D("User");
		$res = $user -> regist($data);
		$user_id=$user->get_userid($data);
		// 及时更新follow表
		$follow=D('follow');
		$res_follow=$follow->insert_info($user_id);
		if($res && $res_follow)
		{
			session('username',$data['User_name']);
			// echo "<h2>注册成功！！！</h2>";
			$this -> redirect('Home/Information/information',Array('cat'=>3),3,'3 seconds after the automatic jump');
		}
		else
		{
			// echo "注册失败，请重试！！！";
			$this -> redirect('Home/Register/register',Array('cat'=>3),3,'Error occurred');
		}
	}

	function tele_regist()
	{
				$data['User_name'] = $_POST['username'];
		$data['User_tele'] = $_POST['teleNum'];
		if($_POST['password'] == $_POST['repwd'])
		{
			$data['User_password'] = $_POST['password'];
		}
		else
		{
			echo "<h2>注册失败，请保证两次输入的密码一致！！！</h2>";
			//redirect('{$Think.const.SITE_URL}Home/Register/register',3);
			$this -> redirect('Home/Register/register',Array('cat'=>3),3,'3秒后跳转注册页面！！！');
			return ;
		}
		
		// print_r($data);
		// return ;

		$user = D("User");
		$res = $user -> regist($data);
		if($res)
		{
			echo "注册成功！！！";
		}
		else
		{
			echo "注册失败，请重试！！！";
			$this -> redirect('Home/Register/register',Array('cat'=>3),3,'3秒后跳转注册页面！！！');
		}
	}
	//检验邮箱
	function check_mail(){
	 $mail=$_POST['mail'];
	 $user=D('User');
	 $data['User_mail']=$mail;
	 $res=$user->where($data)->select();
	 if($res){
	 echo 'true';
	}else{
	echo 'false';
	}}

}

