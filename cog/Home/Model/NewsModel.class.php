<?php 
namespace Home\Model;
use Think\Model;
class NewsModel extends Model
{
	public function insert_info($data){
      $news=D('News');
      $res=$news->add($data);
      if($res){
      	return true;
      }else{
      	return false;
      }
	}

	// 获取新闻信息
	public function get_info($num=10){
	  $news=D('News');
	  $res=$news->order('news_id desc')->limit($num)->select();
	  if($res){
	  	return $res;
	  }else{
	  	return false;
	  }

	}

	// 删除新闻
    public function delete_news($news_id){
      $news=D('News');
      $data['news_id']=$news_id;
      $res=$news->where($data)->delete();
      if($res){
      	return true;
      }else{
      	return false;
      }

    }

  // 筛选新闻
    public function filtrate_news($condition){
      $news=D('News');
      switch ($condition) {
        case '按时间':
          $res=$news->order('news_time desc')->select();
          break;
        case '按热度':
         $res=$news->order('news_view desc')->select();
          break;
        
      }
      
      if($res){
        return true;
      }else{
        return false;
      }
    }

    // 获取新闻
    public function get_news($news_id){
      $news=D('News');
      $data['news_id']=$news_id;
      $res=$news->where($data)->select();
      $path='./cog/news/'.$res[0]['news_filename'];
    if(!file_exists($path)){
      exit();
    }
    $fp=fopen($path,'a+');
    $content=fread($fp,filesize($path));
    fclose($fp);
    $res[0]['news_content']=$content;
      if($res){
        return $res;
      }else{
        return false;
      }
    }

    public function get_hot_news($num=3){
      $news=D('News');
      $sql="select news_id,news_title,news_img
            from cog_news
            order by news_view desc
            limit ".$num;
      $res=$news->query($sql);
      return $res;
    }

}
