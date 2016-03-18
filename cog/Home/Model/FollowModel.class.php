<?php
namespace Home\Model;
use Think\Model;
class FollowModel extends Model{
	// 更新关注信息
	public function update_info($user_id,$data){
		$follow=D('Follow');
		$res=$follow->where($user_id)->save($data);
		if($res){
          return 1;
		}else{
          return 0;
		}
	}

	// 获取用户关注圈子id
	public function get_follow_circle($user_id){
		$follow=D('follow');
		$data['user_id']=$user_id;
		$res=$follow->where($data)->getField('follow_circle_id');
        if($res){
        	return $res;
        }else{
        	return 0;
        }
	}
	//判断用户是否关注某个圈子
	public function check_user_follow_circle($user_id,$circle_id){
        $follow=D('follow');
      $res_follow_circle=$follow->get_follow_circle($user_id);
      if($res_follow_circle){
        if(strpos($res_follow_circle,'|')){
          $follow_circle=explode('|',$res_follow_circle);
          if(in_array($circle_id,$follow_circle)){
            $i=1;
          }else{ $i=0;}
        }else{
          if($circle_id==$res_follow_circle){
            $i=1;
          }else{ $i=0; }
        }
      }else{ $i=0; }

      return $i;
	}
	// 进行关注圈子操作
	public function follow_circle($user_id,$circle_id){
        $follow=D('Follow');
        $data['user_id']=$user_id;
        $follow_circle=$follow->where($data)->getField('follow_circle_id');
        if($follow_circle){
            // 判断是否已关注这个圈子
            $i=$follow->check_user_follow_circle($user_id,$circle_id);
            if($i){
                $follow_circle=$follow_circle;
            }else{
            	$follow_circle=$follow_circle.'|'.$circle_id;
            }
            
        }else{
        	$follow_circle=$circle_id;
        }
        $follow_circle_id['follow_circle_id']=$follow_circle;
		$res=$follow->where($data)->save($follow_circle_id);
		if($res){
          return 1;
		}else{
          return 0;
		}
	}

	// 进行取消关注圈子操作
	public function cancel_follow_circle($user_id,$circle_id){
		$follow=D('Follow');
        $data['user_id']=$user_id;
        $follow_circle=$follow->where($data)->getField('follow_circle_id');
        if($follow_circle){
          if(strpos($follow_circle,'|')){
          	$follow_circle=explode('|',$follow_circle);
             foreach($follow_circle as $k=>$v){
            if(in_array($v,array($circle_id))){
                unset($follow_circle[$k]);
            }
          }}else{
          	if($follow_circle==$circle_id){
          		$follow_circle=null;
          	}else{
          		$follow_circle=$follow_circle;
          	}
          	
          }
        
	   }else{
	   	  $follow_circle=null;
	   }

        // if($follow_circle){
        	
        // 	if(strpos($follow_circle,'|')){
        // 		$follow_circle=explode('|',$follow_circle);
        // 		foreach($follow_circle as $k=>$v){
        // 			if(in_array($v,array($circle_id))){
        // 				unset($follow_circle[$k]);
        // 			}
        // 		}
              
        // 	}else{
        // 		if($follow_circle==$circle_id){
        // 			$follow_circle=null;
        // 		}else{
        // 			$follow_circle=$follow_circle;
        // 		}
        // 	}
        // }
        // return $follow_circle;
	   
	   if(count($follow_circle)>1){
	   	$f['follow_circle_id']=implode('|',$follow_circle);
	   }else{
	   	$f['follow_circle_id']=implode('|',$follow_circle);
	   }
	     $res=$follow->where($data)->save($f);
	    // $sql="update cog_follow set 'follow_circle_id'=".$follow_circle." where 'user_id'=".$user_id;
	    // $res=$follow->execute($sql);
	   if($res){
	   	return $f;
	   }else{
	   	return 0;
	   }
	}

  // 用户注册时更新follow表中的数据
  public function insert_info($user_id){
    $follow=D('Follow');
    $data['user_id']=$user_id;
    $data['follow_id']=0;
    $data['followed_id']=0;
    $data['follow_circle_id']=0;
    $res=$follow->add($data);
    if($res){
      return 1;
    }else{
      return 0;
    }
  }
  // 获取用户关注的圈子id及圈子信息
  public function get_follow_circle_info($user_id){
    $follow=D('Follow');
    $data['user_id']=$user_id;
    $res=$follow->where($data)->getField('follow_circle_id');
    $res=explode('|', $res);
    $circle=D('Circle');
    foreach($res as $k=>$v){
      $res_circle=$circle->get_circle_info($v);
      $result[]=$res_circle;
    }
    if($result){
      return $result;
    }else{
      return false;
    }
  }

  // 获取用户关注的人
  public function get_follow_id($user_id){
    $follow=D('Follow');
    $data['user_id']=$user_id;
    $res=$follow->where($data)->getField('follow_id');
    $res=explode('|',$res);
    foreach($res as $k=>$v){
      $user=D('User');
      $result[]=$user->get_info($v);
    }

    if($result){
      return $result;
    }else{
      return false;
    }
  }

  // 进行取消关注用户操作
  public function cancel_subscribe($user_id,$follow_id){
    $follow=D('Follow');
    $data['user_id']=$user_id;
    $res=$follow->where($data)->getField('follow_id');
    $res=explode('|',$res);
    if($res){
      foreach($res as $k=>$v){
        if(in_array($v, array($follow_id))){
          unset($res[$k]);
        }
      }
    }
    $res=implode('|',$res);
    $da['follow_id']=$res;
    $result=$follow->where($data)->save($da);

    $data_followed['user_id']=$follow_id;
    $res_followed=$follow->where($data_follow)->getField('followed_id');
    $res_followed=explode('|',$res_followed);
    if($res_followed){
      foreach($res_followed as $k=>$v){
        if(in_array($v, array($follow_id))){
          unset($res_followed[$k]);
        }
      }
    }
    $res_followed=implode('|',$res_followed);
    $da_followed['followed_id']=$res_followed;
    $result_followed=$follow->where($data_followed)->save($da_followed);

    if($result && $result_followed){
      return true;
    }else{
      return false;
    }

  }


  // 获取用户被关注信息
  public function get_followed_id($user_id){
    $follow=D('Follow');
    $data['user_id']=$user_id;
    $res=$follow->where($data)->getField('followed_id');
    $res=explode('|', $res);
    foreach($res as $k=>$v){
        $user=D('User');
        $result[]=$user->get_info($v);
      }
    if($result){

      return $result;
    }else{
      return false;
    }
  }

  // 进行关注用户操作
  public function subscribe($user_id,$follow_id){
    $follow=D('Follow');
    $data['user_id']=$user_id;
    $da['user_id']=$follow_id;
    $res=$follow->where($data)->getField('follow_id');
    $res_follow=$follow->where($da)->getField('follow_id');
    $i=0;
    $j=0;
    if(!$res){
      $follow_id=$follow_id;
    }else{
      // 判断用户是否已经关注此用户
      $res=explode('|', $res);
      foreach($res as $k=>$v){
        if($v==$follow_id){
          $i++;
        }
      }
      $res=implode('|',$res);
      if($i==0){

        $follow_id=$res.'|'.$follow_id;
      }else{
        $follow_id=$res;
      }
      
    }
    $d['follow_id']=$follow_id;
    $update=$follow->where($data)->save($d);
    // 及时更新关注用户信息
    if(!$res_follow){
      $followed_id=$user_id;
    }else{
      $res_follow=explode('|', $res_follow);
      foreach($res_follow as $k=>$v){
        if($v==$user_id){
          $j++;
        }
      }
      $res_follow=implode('|', $res_follow);
      if($j==0){
        $followed_id=$res_follow.'|'.$user_id;
      }else{
        $followed_id=$res_follow;
      }
    }
    $data_follow['followed_id']=$followed_id;
    $res_update2=$follow->where($da)->save($data_follow);
    if( $res_update2 &&  $update){
      return 1;
    }else{
      return  1;
    }
  }

  // 判断用户是否已关注此用户
  public function check_follow($user_id,$follow_id){
    $follow=D('Follow');
    $data['user_id']=$user_id;
    $res=$follow->where($data)->getField('follow_id');
    
    if($res){
      $i=0;
      $res=explode('|',$res);
      foreach($res as $k=>$v){
        if($v==$follow_id){
           $i++;
        }
      }
      if(!$i){
        return 0;
      }else{
        return true;
      }
    }else{
      return 0;
    }
  }

  // 最近浏览操作
  public function recent_view($user_id,$circle_id){
    $follow=D('Follow');
    $data['user_id']=$user_id;
    $res=$follow->where($data)->getField('follow_recent_view');

    if($res){
      // 判断用户是否已浏览次圈子
      $res=explode('|',$res);
      foreach ($res as $key => $value) {
        
          if($value==$circle_id){
            unset($res[$key]);
          }
       
      }
      $res=implode('|', $res);
      $d['follow_recent_view']=$circle_id.'|'.$res;
    }else{
      $d['follow_recent_view']=$circle_id;
    }
    $result=$follow->where($data)->save($d);
    if($result){
      return true;
    }else{
      return false;
    }

  }

  // 获取最近浏览
  public function get_recent_view($user_id){
    $follow=D('Follow');
    $circle=D('Circle');
    $data['user_id']=$user_id;
    $res=$follow->where($data)->getField('follow_recent_view');
    $res=explode('|',$res);
    $result=array();
    foreach($res as $k=>$v){
      if($v){
        $result[$k]=$circle->get_concrete_circle($v);
      }
      
    }
    return $result;
  }


}