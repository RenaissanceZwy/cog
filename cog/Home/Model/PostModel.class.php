<?php
namespace Home\Model;
use \Think\Model;
class PostModel extends Model{
	// 将帖子信息插入数据库
	public function insert_info($data){
		$post=D('Post');
		$res=$post->add($data);
		if($res){
			return 1;
		}else{
			return 0;
		}

	}
    // 获取所有的帖子的信息
	public function get_info(){
		$post=D('Post');
		$sql="select * from cog_post order by post_time desc";
		$res=$post->query($sql);
		if($res){
			return $res;
		}else{
			return 0;
		}
	}
	//删除某条帖子
	public function delete_post($post_id){
		// 删除评论
		$com=new \Home\Model\CommentModel();
		$res_com=$com->delete_all_comment($post_id);
		// 删除帖子信息
		$post=D('Post');
		$data['post_id']=$post_id;
		$post_img=$post->where($data)->getField('post_img');
		if($post_img){
			unlink($post_img);
		}
		$res=$post->where($data)->delete();
        if($res){
        	return 1;
        }else{
        	return 0;
        }
	}

	//获取某个用户的帖子
	public function get_user_post($user_id){
		$post=D('Post');
		$sql="select cog_post.* ,circle_name
		      from cog_post,cog_circle 
		      where cog_post.post_circle_id=cog_circle.circle_id and
		      cog_post.post_user=$user_id 
		      order by cog_post.post_time desc";
		$res=$post->query($sql);
		if($res){
			return $res;

		}else{
			return 0;
		}
	}

	//获取某个帖子
	public function get_post($post_id){
		$post=D('Post');
		$data['post_id']=$post_id;
		$res=$post->where($data)->select();
		if($res){
			return $res;

		}else{
			return 0;
		}
	}

	// 获取某个特定的圈子的收藏帖子
	public function get_collect_post($post_id,$circle_id){
		$post=D('Post');
		$data['post_circle_id']=$circle_id;
		$data['post_id']=$post_id;
		$sql="select post_title,post_content,post_id,post_user,post_time,post_game,post_server,post_title,post_content,post_boutique,User_headimg,User_name 
		from cog_post ,cog_user
		where cog_post.post_user=cog_user.User_id and
		cog_post.post_id=$post_id and 
		cog_post.post_circle_id=$circle_id 
		order by post_time desc";
		$res=$post->query($sql);
		if($res){
			return $res;
		}else{
			return 0;
		}
	}

	// 对帖子进行加精操作
	public function boutique($post_id){
		$post=D('Post');
		$data['post_id']=$post_id;
		$da['post_boutique']=1;
		$res=$post->where($data)->save($da);
		if($post->where($data)->getField('post_boutique')==1){
			return 1;
		}else{
				if($res){
				return 1;
			}else{
				return 0;
			}
		}
		
	}

    //获取精品贴子信息
    public function get_boutique_post($circle_id){
    	$post=D('Post');
    	$data['post_circle_id']=$circle_id;
    	$data['post_boutique']=1;
		$sql="select post_title,post_content,post_id,post_user,post_time,post_game,post_server,post_title,post_content,post_boutique,User_headimg,User_name 
		from cog_post ,cog_user
		where cog_post.post_user=cog_user.User_id and
		cog_post.post_boutique=1 and 
		cog_post.post_circle_id=$circle_id 
		order by post_time desc";
		$res=$post->query($sql);
		if($res){
			return $res;
		}else{
			return 0;
		}
    }

   // 获取某个圈子的帖子
    public function get_circle_post($circle_id){
    	$post=D('Post');
    	$data['post_circle_id']=$circle_id;
    	$res=$post->where($data)->select();
    	if($res){
    		$sql="select post_title,post_content,post_id,post_user,post_time,post_game,post_server,post_title,post_content,post_boutique,User_headimg,User_name
    	 from cog_post ,cog_user
    	 where cog_post.post_user = cog_user.User_id and 
         cog_post.post_circle_id=$circle_id 
         order by cog_post.post_time desc";
    	$res=$post->query($sql);
        }else{
    	$res=false;
        }
    	
    	if($res){
    		return $res;
    	}else{
    		return 0;
    	}
    }

    // 获取属于某个圈子的某个游戏的帖子
    public function get_circle_game_post($circle_id,$game){
    	$post=D('Post');
    	$data['post_circle_id']=$circle_id;
    	$data['post_game']=$game;
    	$sql="select post_title,post_content,post_id,post_user,post_time,post_game,post_server,post_title,post_content,post_boutique,User_headimg,User_name 
		from cog_post ,cog_user
		where cog_post.post_user=cog_user.User_id and
		cog_post.post_game='$game' and 
		cog_post.post_circle_id=$circle_id 
		order by post_time desc";
    	$res=$post->query($sql);
    	if($res){
    		return $res;
    	}else{
    		return false;
    	}
    }

     // 按照时间筛选
    public function post_filtrate_time($circle_name,$game){
    	$post=D('Post');
    	$data['post_circle_name']=$circle_name;
    	$data['post_game']=$game;
    	$sql="select post_title,post_content,post_id,post_user,post_time,post_game,post_server,post_title,post_content,post_boutique,User_headimg,User_name 
		from cog_post ,cog_user,cog_circle
		where cog_post.post_user=cog_user.User_id and
		cog_post.post_circle_id=cog_circle.circle_id and
		cog_post.post_game='$game' and 
		cog_circle.circle_name='$circle_name'
		order by post_time desc";
    	$res=$post->query($sql);
    	if($res){
    		return $res;
    	}else{
    		return false;
    	}
    }
    // 按照热度筛选
    public function post_filtrate_hot($circle_name,$game){
    	$post=D('Post');
    	$data['post_circle_name']=$circle_name;
    	$data['post_game']=$game;
    	$sql="select post_title,post_content,post_id,post_user,post_time,post_game,post_server,post_title,post_content,post_boutique,User_headimg,User_name 
		from cog_post ,cog_user,cog_circle
		where cog_post.post_user=cog_user.User_id and
		cog_post.post_circle_id=cog_circle.circle_id and
		cog_post.post_game='$game' and 
		cog_circle.circle_name='$circle_name'
		order by post_view desc";
    	$res=$post->query($sql);
    	if($res){
    		return $res;
    	}else{
    		return false;
    	}
    }

     public function get_circle_post_test($circle_id){
    	$post=D('Post');
		$sql="select circle_id,circle_followers,circle_name,circle_game_id,circle_location,circle_describe,circle_time,circle_img,count(post_id) as post_num
		from cog_post,cog_circle
		where cog_circle.circle_id=$circle_id and 
		cog_post.post_circle_id=$circle_id";
		$res=$post->query($sql);
		if($res){
			return $res;
		}else{
			return 0;
		}
    }

    // 获取某个用户收藏帖子的信息
    public function get_user_collect($user_id){
    	$post=D('Post');
    	$user=D('User');
    	$data['User_id']=$user_id;
    	$res_collect=$user->get_collect_post($data);
    	$res_collect=explode('|',$res_collect);
    	if($res_collect[0]){
    	foreach($res_collect as $k=>$v){
    		$sql="select cog_post.* ,User_id,User_name,User_headimg,circle_name
    		      from cog_user,cog_post,cog_circle
    		      where cog_user.User_id=cog_post.post_user
    		      and cog_post.post_id=$v
    		      and cog_circle.circle_id=cog_post.post_circle_id";
    		$res[]=$post->query($sql);
    	}
    }
    	if($res){
    		return $res;
    	}else{
    		return false;
    	}
    }
    
    // 获取热门帖子
    public function get_hotPost(){
    	$post=D('Post');
    	// 判断评论数
    	$sql="select cog_post.post_id,circle_name,post_time,post_title,post_content,count(cog_comment.post_id) as num
    	      from cog_post,cog_comment,cog_circle
    	      where cog_post.post_id=cog_comment.post_id and
    	            cog_post.post_circle_id=cog_circle.circle_id
    	      group by  cog_comment.post_id
    	      order by num desc
    	 ";
    	$res=$post->query($sql);
    	if($res){
    		return $res;
    	}else{
    		return false;
    	}
    }
}