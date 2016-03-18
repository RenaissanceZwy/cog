<?php 
namespace Home\Model;
use Think\Model;
class UserModel extends Model
{
	function get_user($data)
	{
		$user = D("User");

		$res = $user -> where($data) -> select();
		if($res)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function regist($data)
	{
		$user = D("User");
		$res = $user -> add($data);
		if($res)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function information($name,$data)
	{
		$user = D("User");
		$res = $user -> where($name) -> save($data);
		if($res)
		{
			return true;
		}
		else
		{
			return false;
		}

	}


    // 获取用户收藏信息
    public function get_info($user_id){
    	$user=D('User');
    	$data['User_id']=$user_id;
    	$res=$user->where($data)->select();
    	if($res){
    		return $res;
    	}else{
    		return 0;
    	}
    }
	//获取用户id
	public function get_userid ($data){
		$user = D("User");
		$res = $user -> where($data) -> getField('User_id');
		if($res)
		{
			return $res;
		}
		else
		{
			return false;
		}

	}

	//获取用户头像
	public function get_userimg ($data){
		$user = D("User");
		$res = $user -> where($data) -> getField('User_headimg');
		if($res)
		{
			return $res;
		}
		else
		{
			return false;
		}

	}

	// 进行收藏操作
	public function collect($da,$post_id){
         $user = D("User");
         // 获取用户现有的收藏信息
         $result=$user->get_collect_post($da);
         $split='|';
         if($result){
         	// 判断用户是否已经收藏此帖子
         	$result=explode($split,$result);
         	$i=0;
         	foreach($result as $k=>$v){
         		if($v==$post_id){
         			$i++;
         		}
         	}
         	$result=implode($split,$result);
         	if($i==0){
         		$result=$result.$split.$post_id;
         	}else{
         		$result=$result;
         	}
         	
         }else{
           $result=$post_id;
         }
         
        $data['User_collect']=$result;
		$res = $user -> where($da) -> save($data);
		if($res)
		{
			return true;
		}
		else
		{
			return false;
		}
	}  

	// 获取用户收藏信息
	public function get_collect_post($da){
		$user = D("User");
		$res = $user -> where($da) -> getField('User_collect');
		if($res)
		{
		
			return $res;
		}
		else
		{
			return false;
		}
   
	}
	// 获取所有的用户
	public function get_all_user(){
		$user=D('User');
		$res=$user->select();
		if($res){
			return $res;
		}else{
			return false;
		}
	}

	// 删除用户
	public function delete_user($user_id){
      $user=D('User');
      $data['User_id']=$user_id;
      $res=$user->where($data)->delete();
      if($res){
      	return true;
      }else{
      	return false;
      }

	}

}
