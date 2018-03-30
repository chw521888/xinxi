<?php
namespace Huihua\Controller;
use Think\Controller;

class IndexHuihuaController extends \Common\Controller\CommonIndexController{
 
	function index(){
		//获取当前执行场次stage
		$huihua_type = C('HUIHUA_TYPE');
		if($huihua_type == 7){ $stage_num = 4; }
		if($huihua_type == 5){ $stage_num = 3; }
		if($huihua_type == 3){ $stage_num = 2; }
		if($huihua_type == 1){ $stage_num = 1; }
		$map = array();
		$keywords = I('get.keywords');
		if($keywords != ""){
			$where['Huihua.id'] = $keywords;
			$where['user_name'] = array('like',"%$keywords%");
			$where['_logic']    = 'or';
			$map['_complex']    = $where;
		}
		$stage = I('get.stage');
		if($stage != ""){
			$map['stage'] = $stage;
		}else{
			$map['stage'] = $stage_num;
			$stage = $stage_num;
		}
		C('listRows',20);
		$map['is_effect'] = 1;
		$this->_list(D('Huihua/Huihua'),$map);
		//获取用户是否上传了作品
		$user_id = $this->user_id;
		$f_map['stage'] = $stage_num;
		$f_map['user_id'] = $user_id;
		$f_info = M('Huihua')->where($f_map)->find();
		$this->assign('id',(int)$f_info['id']);
		$this->assign('stage',$stage);
		$this->assign('huihua_type',$huihua_type);
		$this->assign('stage_num',$stage_num);
		$this->display();
	}
 	function show(){
 		$id = I('get.id');
 		$map['id'] = $id;
 		$info = D('Huihua/Huihua')->where($map)->find();
 		$this->assign('info',$info);
 		$this->display();
 	}


 	//给绘画赛投票
   function post_vote(){
		$type        = I('post.type','','make_number');
		$huihua_id   = I('post.huihua_id','','make_number');
		$huihua_info = D("Huihua/Huihua")->where("Huihua.id=".$huihua_id)->find();
		$now_stage   = C('HUIHUA_TYPE');
		if($huihua_info['stage'] == 1){$stage = 1;}
		if($huihua_info['stage'] == 2){$stage = 3;}
		if($huihua_info['stage'] == 3){$stage = 5;}
		if($huihua_info['stage'] == 4){$stage = 7;}
		if($now_stage != $stage){$this->error("无法投票!",AJAX);}

		$m_user = M('User');
		$m_huihua = M('Huihua');
		
		if($type == 1){
			$user = $m_user->where("id=".$this->user_id)->find();
			$vote = $user['e_vote'];
			if($vote <= 0){$this->error("您的微端投票机会已经用完!",AJAX);}

			$m_user->where("id=".$this->user_id)->setDec('e_vote');
		}else{
			$lasttime = strtotime(date('Y-m-d 23:59:59'));
			$vote = $_COOKIE['e_vote_array'];
			if($vote < 2){
				$value = (int)$vote + 1;
				setcookie("e_vote_array",$value,$lasttime);
			}
			if($vote >= 2){$this->error("您的PC端投票机会已经用完!",AJAX);}
		}

		$m_huihua->where("id='".$huihua_id."'")->setInc("num_vote");
		$m_huihua->where("id='".$huihua_id."'")->setInc("num_view");

	    $this->success('投票成功',AJAX);
	   
   }


   	function up(){
	$id = I('get.id');
	if($id != 0){
		$map['id'] = $id;
		$info = M('Huihua')->where($map)->find();
		$this->assign('info',$info);
	}
	$this->display();
	}

	function shangchuan(){
		$image      = new \Think\Image(); 
		$img        = $_FILES["photo"]["tmp_name"][0]; 
		$images->open($img);  

		$imgDir      = "upload/other/image";                   //保存地址
		$filename    = "/".md5(time().mt_rand(10,99)).".png"; //新图片名称
		$newFilePath = $imgDir.$filename;                     
		$image->thumb(300, 300)->save($newFilePath);//缩略图覆盖原图  


	/*	//电脑上传文件
        $image = $_FILES["photo"]["tmp_name"][0];
        $fp = fopen($image, "r");
        $file = fread($fp, $_FILES["photo"]["size"][0]); //二进制数据流
        //保存地址
        $imgDir = "upload/other/image";
        //要生成的图片名字
        $filename = "/".md5(time().mt_rand(10,99)).".png"; //新图片名称
        $newFilePath = $imgDir.$filename;
        $data2 = $file;
        $newFile = fopen($newFilePath,"w"); //打开文件准备写入
        fwrite($newFile,$data2); //写入二进制流到文件
        fclose($newFile); //关闭文件
*/
		$id = I('post.id');
		$stage = I('post.stage');
		$data['title']      = I('post.title');
		$data['user_name']  = I('post.user_name');
		$data['user_phone'] = I('post.user_phone');

		if($id > 0){
			$hh_info = M('Huihua')->where(array('id'=>$id,'stage'=>$stage))->find();
			if($hh_info['is_have_edit'] > 0){
			$this->error('您的修改机会已用完',AJAX);
			}
			if($hh_info['is_effect'] <= 0){
				$this->error('您的信息正在审核中',AJAX);
			}
			$data['pic_edit']     = "/".$newFilePath;
			$data['is_have_edit'] = 1;
			$data['is_effect']    = 0;
			$data['time']         = time();
			M('Huihua')->where(array('id'=>$id))->save($data);
		}else{
			$data['stage']        = $stage;
			$data['user_id']      = $this->user_id;
			$data['pic']          = "/".$newFilePath;
			$data['num_vote']     = 0;
			$data['num_view']     = 0;
			$data['is_have_edit'] = 0;
			$data['is_effect']    = 0;
			$data['time']         = time();
			M('Huihua')->add($data);
		}
		$this->success('作品上传成功,待审核!',AJAX);
	}


}
?>