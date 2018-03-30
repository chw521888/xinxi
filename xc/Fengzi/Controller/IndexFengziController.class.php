<?php
namespace Fengzi\Controller;
use Think\Controller;

class IndexFengziController extends \Common\Controller\CommonIndexController{
 
	function index(){
		$map = array();
		$keywords = I('get.keywords');
		if($keywords != ""){
			$where['Fengzi.id'] = $keywords;
			$where['user_name'] = array('like',"%$keywords%");
			$where['_logic']    = 'or';
			$map['_complex']    = $where;
			}
		C('listRows',20);
		$map['is_effect'] = 1;
		$this->_list(D('Fengzi/Fengzi'),$map);
		$user_id = $this->user_id;
		$f_info = M('Fengzi')->where('user_id='.$user_id)->find();
		$this->assign('id',(int)$f_info['id']);
		$this->display();
	}
 	function show(){
 		$id = I('get.id');
 		$map['id'] = $id;
 		$info = D('Fengzi/Fengzi')->where($map)->find();
 		$this->assign('info',$info);
 		$this->display();
 	}
 	

 	//给绘画赛投票
   function post_vote(){
		$fengzi_id   = I('post.fengzi_id','','make_number');
		$fengzi_info = D("Fengzi/Fengzi")->where("Fengzi.id=".$fengzi_id)->find();

		$m_fengzi = M('Fengzi');
		
		$lasttime = strtotime(date('Y-m-d 23:59:59'));
		$vote = $_COOKIE['fengzi_vote_array'];
		if($vote < 100){
			$value = (int)$vote + 1;
			setcookie("fengzi_vote_array",$value,$lasttime);
		}
		if($vote >= 100){$this->error("您的点赞机会已经用完!",AJAX);}

		$m_fengzi->where("id='".$fengzi_id."'")->setInc("num_vote");
		$m_fengzi->where("id='".$fengzi_id."'")->setInc("num_view");

	    $this->success('点赞成功',AJAX);
	   
   }

	function up(){
	$id = I('get.id');
	if($id != 0){
		$map['id'] = $id;
		$info = M('Fengzi')->where($map)->find();
		$this->assign('info',$info);
	}
	$this->display();
	}

	function shangchuan(){
		/*$images      = new \Think\Image(); 
		$image       = $_FILES["photo"]["tmp_name"][0]; 
		$images->open($image, "r");  

		$imgDir      = "upload/other/image";                   //保存地址
		$filename    = "/".md5(time().mt_rand(10,99)).".png"; //新图片名称
		$newFilePath = $imgDir.$filename;
		$images->thumb(800, 800)->save($newFilePath);//缩略图覆盖原图  */

		//电脑上传文件
		$image       = $_FILES["photo"]["tmp_name"][0];
		$fp          = fopen($image, "r");
		$file        = fread($fp, $_FILES["photo"]["size"][0]); //二进制数据流
		//保存地址
		$imgDir      = "upload/other/image";
		//要生成的图片名字
		$filename    = "/".md5(time().mt_rand(10,99)).".png"; //新图片名称
		$newFilePath = $imgDir.$filename;
		$data2       = $file;
		$newFile     = fopen($newFilePath,"w"); //打开文件准备写入
        fwrite($newFile,$data2); //写入二进制流到文件
        fclose($newFile); //关闭文件

		$image        = $_FILES["photo"]["tmp_name"][1];
		$fp           = fopen($image, "r");
		$file         = fread($fp, $_FILES["photo"]["size"][1]); //二进制数据流
		//要生成的图片名字
		$filename     = "/".md5(time().mt_rand(10,99)).".png"; //新图片名称
		$newFilePath2 = $imgDir.$filename;
		$data3        = $file;
		$newFile      = fopen($newFilePath2,"w"); //打开文件准备写入
        fwrite($newFile,$data3); //写入二进制流到文件

        fclose($newFile); //关闭文件

		$id = I('post.id');
		$data['title']      = I('post.title');
		$data['user_name']  = I('post.user_name');
		$data['user_phone'] = I('post.user_phone');
		$fz_info = M('Fengzi')->where(array('id'=>$id))->find();
		
		if($id > 0){
			if($fz_info['is_have_edit'] > 0){
			$this->error('您的修改机会已用完',AJAX);
			}
			if($fz_info['is_effect'] <= 0){
				$this->error('您的信息正在审核中',AJAX);
			}
			$data['id']           = $id;
			$data['pic_edit']     = "/".$newFilePath;
			$data['pic2_edit']    = "/".$newFilePath2;
			$data['is_have_edit'] = 1;
			$data['is_effect']    = 0;
			$data['time']         = time();
			M('Fengzi')->save($data);
		}else{
			$data['user_id']      = $this->user_id;
			$data['pic']          = "/".$newFilePath;
			$data['pic2']         = "/".$newFilePath2;
			$data['num_vote']     = 0;
			$data['num_view']     = 0;
			$data['is_have_edit'] = 0;
			$data['is_effect']    = 0;
			$data['time']         = time();
			M('Fengzi')->add($data);
		}
		$this->success('作品上传成功,待审核!',AJAX);
	}




}


?>