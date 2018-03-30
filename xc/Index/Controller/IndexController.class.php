<?php
namespace Index\Controller;
use Think\Controller;

class IndexController extends CommonController {

	function dati(){
		$this->assign('data',array(2,6,10,14,18,22,26,30,34,38,42,46,50,54,58,62,66,70,74,78,82,86,90,94,98,102));
		for ($i=0; $i < 72; $i++) {
			if($i % 2 == 0){
				$list[$i] = jisuan(10,0);
			}else{
				$list[$i] = jisuan(10,1);
			}
		}
		$this->assign('list',$list);
		//$this->display();
	}



     public function index(){
	   $data_list=S('data_list');
	   if($data_list==false){
		 $data_list = M('Show')->where('stage=2 and num_vote_show <> 0')->order('num_vote_show desc')->limit(6)->select();
		   S('data_list',$data_list,60*60*24);
	   }
		 $this->assign('data_list',$data_list);
	     $map['stage'] = 0;
	 	 $info_list = D('Contingent/Show')->where($map)->limit(10)->select();
	     $this->assign('info_list',$info_list);

		$map['stage'] = 0;
		$map['is_child'] = 0;
		$cr_list = D('Contingent/Show')->where($map)->select();
		$this->assign('cr_list',$cr_list);
		$map['is_child'] = 1;
		$et_list = D('Contingent/Show')->where($map)->select();
		$this->assign('et_list',$et_list);
		//建立一个顶级总决赛城市
		$cr_info = M('Location')->where('id=68')->find();
		$this->assign('cr_info',$cr_info);
		$et_info = M('Location')->where('id=69')->find();
		$this->assign('et_info',$et_info);
		$this->display();
    }
	
     public function index2(){
	   $data_list=S('data_list');
	   if($data_list==false){
		 $data_list = M('Show')->where('stage=2 and num_vote_show <> 0')->order('num_vote_show desc')->limit(6)->select();
		   S('data_list',$data_list,60*60*24);
	   }
		 $this->assign('data_list',$data_list);
	     $map['stage'] = 0;
	 	 $info_list = D('Contingent/Show')->where($map)->limit(10)->select();
	     $this->assign('info_list',$info_list);
		$this->display();
    }
	public function index_show(){
	   $id = I('request.id');
	   $info = M('Show')->where('id='.$id)->find();
	   $info2 = M('Contingent')->where('id='.$info['contingent_id'])->find();
	   $this->assign('info',$info);
	   $this->assign('info2',$info2);
	   $this->display();
	}

	function insert_bm(){
		$data = M('Message')->create();
		$data['time'] = time();
		$data_id = M('Message')->add($data);
		if($data_id > 0){
			$this->success('报名成功，等待我们与您联系',AJAX);
		}
	}
	
	function share_set(){
		$user_info = M('User')->where('id='.$this->user_id)->find();
		if($user_info['vote2'] == 0){
			M('User')->where('id='.$this->user_id)->setInc('vote2');
			M('User')->where('id='.$this->user_id)->setInc('vote',2);
			M('User')->where('id='.$this->user_id)->setInc('e_vote2');
			M('User')->where('id='.$this->user_id)->setInc('e_vote',2);
		}
		$this->success('OK',AJAX);
	}


	function send_code(){
		$phone = I('post.phone');
		$rand_code   = rand(111111,999999);
		$content = "验证码为:".$rand_code.",切勿将验证码泄露给他人【心系健康家庭秀】";

		if($phone == ""){ return false; }
		ob_start();
		$sns   = new \Common\ORG\Util\Sns();
		$sns->sendsns($phone,$content);
		ob_end_clean();
        S($phone.'s',$rand_code,5*60);
		$this->success('发送成功!',AJAX);
    }

}