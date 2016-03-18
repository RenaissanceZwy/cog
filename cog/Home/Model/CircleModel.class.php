<?php 
namespace Home\Model;
use Think\Model;
class CircleModel extends Model
{
	// 插入圈子信息
	public function insert_info($data){
		$circle=D('Circle');
		$res=$circle->add($data);
		if($res){
			return 1;
		}else{
			return 0;
		}
	}

	// 获取最新圈子
	public function get_new_circle(){
		$circle=D('Circle');
		$sql="select * from cog_circle order by circle_time desc limit 4";
		$res=$circle->query($sql);
		if($res){
			return $res;
		}else{
			return 0;
		}
	}

	// // 获取某个特定圈子的信息
	// public function get_concrete_circle($circle_id){
	// 	$circle=D('Circle');
	// 	$data['circle_id']=$circle_id;
	// 	$sql="select circle_id,circle_followers,circle_name,circle_game_id,circle_location,circle_describe,circle_time,circle_img,count(post_id) as post_num
	// 	from cog_post,cog_circle
	// 	where cog_circle.circle_id=$circle_id and 
	// 	cog_post.post_circle_id=$circle_id";
	// 	$res=$circle->query($sql);
	// 	if($res){
	// 		return $res;
	// 	}else{
	// 		return 0;
	// 	}
	// }

	// 获取某个特定圈子的信息
	public function get_concrete_circle($circle_id){
		$circle=D('Circle');
		$post=D('Post');
		$data['circle_id']=$circle_id;
		$post_num=$post->get_circle_post($circle_id);
		$num['circle_post_num']=count($post_num)-1;
		$circle->where($data)->save($num);
        
		$res=$circle->where($data)->select();
		if($res){
			return $res;
		}else{
			return 0;
		}
	}

	// 获取所有圈子的信息
	public function get_all_circle(){
		$circle=D('Circle');
		$res=$circle->select();
		if($res){
			return $res;
		}else{
			return 0;
		}
	}

	// 进行删除圈子操作
	public function circle_delete($circle_id){
		$circle=D('Circle');
		$data['circle_id']=$circle_id;
		$res=$circle->where($data)->delete();
		if($res){
			return 1;
		}else{
			return 0;
		}
	}
	// 获取圈子的管理员
	public function get_circle_monitor($circle_id){
		$circle=D('Circle');
		$data['circle_id']=$circle_id;
		$res=$circle->where($data)->getField('circle_monitor_id');
		if($res){
			return $res;
		}else{
			return false;
		}
	}
	
	// 修改圈子的信息界面


	// 获取圈子的等级排行
	public function get_circle_rank($circle_id){
		$circle=D('Circle');
		$user=D('User');
		$data['circle_id']=$circle_id;
		$res=$circle->where($data)->getField('circle_followers');
		if($res){
			$res=explode('|',$res);
			foreach($res as $k=>$v){
				$data_user['User_id']=$v;
				$res_user[]=$user->where($data_user)->select();
			}
			return $res_user;
		}else{
			return 0;
		}

	}

	// 更新圈子被关注者的信息
	public function insert_circle_followers($circle_id,$user_id){
		$circle=D('Circle');
		$data['circle_id']=$circle_id;
		$res=$circle->where($data)->getField('circle_followers');
	    if($res){
	    	$res_followers=explode('|',$res);
	    	// 判断该用户是否已经关注该圈子
	    	if(!in_array($user_id,$res_followers)){
	    		$res_followers=implode('|',$res_followers);
	    		$res_followers=$res_followers.'|'.$user_id;
                // 将被关注用户id插入圈子表中
	    	}else{
	    		$res_followers=implode('|',$res_followers);
	    	}
	    }else{
            $res_followers=$user_id;
	    }
	    $followers['circle_followers']=$res_followers;
	    $res_insert=$circle->where($data)->save($followers);
		if($res_insert){
			return $res_followers;
		}else{
			return false;
		}
	}

    // 删除取消关注用户的id
	public function update_circle_followers($circle_id,$user_id){
		$circle=D('Circle');
		$data['circle_id']=$circle_id;
		$res=$circle->where($data)->getField('circle_followers');
		if($res){
			$res_followers=explode('|',$res);
			foreach($res_followers as $k=>$v){
				if($v==$user_id){
					unset($res_followers[$k]);
				}
			}
			$res_followers=implode('|',$res_followers);

		}else{
			$res_followers=null;
		}
        $followers['circle_followers']=$res_followers;
		$res_save=$circle->where($data)->save($followers);
		if($res_save){
			return true;
		}else{
			return false;
		}


	}

	// 获取这个圈子的相关游戏
	public function get_circle_game($circle_id){
		$circle=D('Circle');
		$data['circle_id']=$circle_id;
		$res=$circle->where($data)->getField('circle_game_id');
		if($res){
            $res=explode('|',$res);
            foreach($res as $k=>$v){
                 $k='game_id';
                 $result[]=array($k=>$v);
            }
            return $result;
		}else{
			return false;
		}
	}

	public function get_game($circle_name){
		$circle=D('Circle');
		$data['circle_name']=$circle_name;
		$res=$circle->where($data)->getField('circle_game_id');
		if($res){
            $res=explode('|',$res);
            foreach($res as $k=>$v){
                 $k='game_id';
                 $result[]=array($k=>$v);
            }
            return $result;
		}else{
			return false;
		}
	}

	// 获取某个圈子的信息
	public function get_circle_info($circle_id){
		$circle=D('Circle');
		$data['circle_id']=$circle_id;
		$res=$circle->where($data)->find();
		if($res){
			return $res;
		}else{
			return false;
		}

	}

	// 获取热门圈子
	public function get_hot_circle(){
		$circle=D('Circle');
		$time=date('Y-m-d ',time());
		$time_s=$time.''.'00:00:00';
		$time_e=$time.''.'24:00:00';
		$sql="select post_circle_id ,circle_name,circle_location,count(post_circle_id) as num,circle_img
		      from cog_post,cog_circle
		      where cog_post.post_time >= '$time_s' and cog_post.post_time <='$time_e' and
		            cog_post.post_circle_id=cog_circle.circle_id
		      group by post_circle_id
		      order by num desc
		      ";
        $res=$circle->query($sql);
       
        if($res){
        	return $res;
        }else{
        	return false;
        }
	}

	// 获取附近的圈子
	public function get_neighbor_circle($zone){
		  $circle=D('Circle');
       $sql="select *
            from cog_circle
            where circle_location like '%$zone%' ";
       $res=$circle->query($sql);
      return $res;
	}

}

