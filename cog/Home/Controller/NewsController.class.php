<?php
namespace Home\Controller;
use Think\Controller;
class NewsController extends Controller {
   
   
   public function index(){

    $news=D('News');
    $news_id=$_GET['news_id'];
    $data['news_id']=$news_id;
    $d['news_view']=$news->where($data)->getField('news_view')+1;
    $news->where($data)->save($d);
    $res_news=$news->get_news($news_id);
    $this->assign('res_news',$res_news);

    // 获取热门新闻
    $res_hot=$news->get_hot_news();
    $this->assign('res_hot',$res_hot);
    $this->display();
   }
}