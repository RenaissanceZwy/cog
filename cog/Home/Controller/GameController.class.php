<?php
namespace Home\Controller;
use Think\Controller;
class GameController extends Controller {
   
  
   public function index(){
   	$this->assign('username',session('username'));
    $this->assign('userid',session('user_id'));
   	$this->assign('userimg',session('user_headimg'));
   	$this->display();
   }
}