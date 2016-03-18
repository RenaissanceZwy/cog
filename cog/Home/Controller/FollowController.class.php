<?php
namespace Home\Controller;
use Think\Controller;
class FollowController extends Controller {
    public function index(){
        $user=D('User');
        // 输出所有用户的连接
        // $result=$user->getField('user_id',true);
        // foreach($result as $k=>$v){
        //     $id[]=array('user'=>$v);
        // }
        // var_dump($id);
        // $this->assign('user',$id);
        //输出登录用户信息
        $data['user_id']=session('user_id');
        $res=$user->where($data)->getField('user_name');
        $this->assign('user_name',$res);
         $this->assign('userid',session('user_id'));
       $this->display();
    }
    // 显示登录界面
    public function login(){
        $this->display();
    }
    // 登录操作
    public function login_pro(){
        $user=D('User');
        $data['user_name']=$_POST['username'];
        $data['user_password']=$_POST['password'];
        $res=$user->where($data)->getField('user_id');
        if($res){
            session('user_id',$res);
            $this->redirect('index');
        }else{
            $this->error();
        }
    }
    // 进行关注 取消关注操作
    public function follow(){
        $data['user_id']=1;
        $d['follow_id']=$_POST['user_id'];
        $dat['user_id']=$_POST['user_id'];
        $da['followed_id']=session('user_id');
        $user=D('Follow');
        $res=$user->where($data)->save($d);
        $result=$user->where($dat)->save($da);
    }
    // 取消关注操作
    public function follow_cancel(){
        $userid=$_GET['userid'];
        $data['user_id']=session('user_id');
        $follow=D('Follow');
        $result=$follow->where($data)->getField('follow_id');
        $result=explode('|',$result);
        foreach($result as $k=>$v){
            if(in_array($v,array($userid))){
                unset($result[$k]);
            }
        }
        if(count($result)>1){
            $result=implode('|',$result);
        }else if(count($result)==1){
            $result=$result[0];
        }else if(count($result)==0){
            $result='';
        }
        //修改用户关注信息
        $res['follow_id']=$result;
        $follow->where($data)->save($res);
        // 修改被关注者用户的信息
    }
    // 登录用户自己的主页
    public function self(){
        // 输出所有用户的连接
         $user=D('User');
        $result=$user->getField('user_id',true);
        foreach($result as $k=>$v){
            $id[]=array('user'=>$v);
        }
        // var_dump($id);
        $this->assign('user',$id);
        
        //输出登录用户信息
        $data['user_id']=session('user_id');
        $res=$user->where($data)->getField('user_name');
        $this->assign('user_name',$res);
        $this->assign('user_id',session('user_id'));
        // 输出用户关注信息
        $follow=D('Follow');
        $data['user_id']=session('user_id');
        $res_follow=$follow->where($data)->getField('follow_id',true);
        $res_followed=$follow->where($data)->getField('followed_id',true);
        $follow_res=explode('|',$res_follow[0]);
        $follow_result=array();
        foreach($follow_res as $k=>$v){
           $follow_result[]=array('user_id'=>$v);
        }
        $this->assign('follow_result',$follow_result);
        // var_dump($res_followed);
        $this->display();
    }
    // 进入别人的主页
    public function stranger(){
         // 输出所有用户的连接
         $user=D('User');
        $result=$user->getField('user_id',true);
        foreach($result as $k=>$v){
            $id[]=array('user'=>$v);
        }
        // var_dump($id);
        $this->assign('user',$id);
        echo I('userid');//获取重定向传来的数据

        $this->display();
    }
    public function entrance(){
        $userid=$_GET['userid'];
        if($userid==session('user_id')){
            $this->redirect('/Home/Follow/self');
        }else{
            $this->redirect('/Home/Follow/stranger',array('userid'=>$userid));
        }
    }

   
}