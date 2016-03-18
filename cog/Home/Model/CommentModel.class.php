<?php
namespace Home\Model;
use Think\Model;
class CommentModel extends Model{
	// 插入评论信息
	public function insert_info($data){
		$com=D('Comment');
		$res=$com->add($data);
        if($res){
           return 1;
        }else{
          return 0;
        }
	}

	// 获取评论信息
	public function get_info($post_id,$pid){
	    $com=D('Comment');
	    $data['post_id']=$post_id;
	    $data['comment_pid']=$pid;
		// $res=$com->where($data)->select();
		$sql="select cog_comment.*,User_name,User_headimg,User_level
		     from cog_comment,cog_user
		     where cog_comment.comment_user_id=cog_user.User_id and
		     cog_comment.post_id=$post_id and
		     cog_comment.comment_pid=$pid ";
        $res=$com->query($sql);
        if($res){
           return $res;
        }else{
          return 0;
        }
	}

	// 删除一条评论信息
	public function delete_comment($comment_id){
		$com=D('Comment');
		$data['comment_id']=$comment_id;
		$d['comment_pid']=$comment_id;
		$res=$com->where($data)->delete();
		$res_d=$com->where($d)->delete();
		if($res && $res_d){
			return 1;
		}else{
			return 0;
		}
	}

	// 删除所有的评论信息
	public function delete_all_comment($post_id){
        $com=D('Comment');
        $data['post_id']=$post_id;
		$res=$com->where($data)->delete();
		if($res){
			return 1;
		}else{
			return 0;
		}
	}

	// 获取在某个圈子回复用户的信息
	public function get_reply_info($comment_puser_id,$circle_id){
		$com=D('Comment');
		$sql="select cog_comment.*,post_title,User_name,User_headimg
		from cog_comment,cog_post,cog_user
		where cog_comment.comment_user_id=cog_user.User_id and
		cog_comment.post_id=cog_post.post_id and
		cog_comment.comment_puser_id=$comment_puser_id and
		cog_comment.post_circle_id=$circle_id";
		$res=$com->query($sql);
		if($res){
			return $res;
		}else{
			return false;
		}

	}

	// 获取所有回复用户的信息
	public function get_user_reply($comment_puser_id){
		$com=D('Comment');
		$sql="select cog_comment.*,post_title,User_name,circle_name,post_game
		      from cog_comment,cog_post,cog_user,cog_circle
		      where cog_comment.comment_user_id=cog_user.User_id and
		      cog_comment.post_id=cog_post.post_id and
		      cog_comment.post_circle_id=cog_circle.circle_id and 
		      cog_comment.comment_puser_id=$comment_puser_id and 
		      cog_comment.comment_view=1 
		      order by cog_comment.comment_time desc";
		$res=$com->query($sql);
		if($res){
			return $res;
		}else{
			return false;
		}

	}
    // 获取用户未读的信息
	public function get_mention($user_id){
        $comment=D('Comment');
        $sql="select cog_comment.*,post_title,User_name,circle_name,post_game
		      from cog_comment,cog_post,cog_user,cog_circle
		      where cog_comment.comment_user_id=cog_user.User_id and
		      cog_comment.post_id=cog_post.post_id and
		      cog_comment.post_circle_id=cog_circle.circle_id and 
		      cog_comment.comment_puser_id=$user_id and 
		      cog_comment.comment_view=0 
		      order by cog_comment.comment_time desc";
        $res=$comment->query($sql);
        if($res){
        	return $res;
        }else{
        	return false;
        }
	}

// 	进行已读操作
	public function set_view($comment_id){
       $comment=D('Comment');
       $sql="alter table cog_comment set comment_view=1 where comment_id=$comment_id";
        $res=$comment->query($sql);
        if($res){
        	return true;
        }else{
        	return false;
        }
	}
 }