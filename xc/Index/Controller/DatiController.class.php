<?php
namespace Index\Controller;
use Think\Controller;

class DatiController extends CommonController {

	public function index(){
		$id = I('request.id');
		if($id == ''){
			$result = "false";
			$filedata='""';
			$history_answer_data="[]";
		}else{
			$filedata = array();
			$result = "true";
			$data = M('Dati')->where('id='.$id)->find();
			$filedata = $data['file4'];
			$history_answer_data=$data['file1'];
			
		}
		$user_id = 1;//$this->user_id;
		$map['user_id'] = $user_id;
		$list = M('Dati')->where($map)->order('id desc')->limit(5)->select();
		$this->assign('list',$list);
		$this->assign('result',$result);
		$this->assign('filedata',htmlspecialchars_decode($filedata));
		$this->assign('history_answer_data',htmlspecialchars_decode($history_answer_data));
		$this->display();
	}
	
	//插入

	function insert(){
		$file1 = I('post.file1');
		$file2 = I('post.file2');
		$file3 = I('post.file3');
		$file4 = I('post.file4');

		$data['user_id'] = $this->user_id;
		$data['file1']   = $file1;
		$data['file2']   = $file2;
		$data['file3']   = $file3;
		$data['file4']   = $file4;
		$data['time']    = time();
		M('Dati')->add($data);
		$user_info = M('User')->where('id='.$this->user_id)->find();
		if($user_info['vote1'] == 0){
			M('User')->where('id='.$this->user_id)->setInc('vote1');
			M('User')->where('id='.$this->user_id)->setInc('vote',2);
			M('User')->where('id='.$this->user_id)->setInc('e_vote1');
			M('User')->where('id='.$this->user_id)->setInc('e_vote',2);
		}
		$this->success('OK',AJAX);

	}

}