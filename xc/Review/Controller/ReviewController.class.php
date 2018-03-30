<?php

namespace Review\Controller;

use Think\Controller;



class ReviewController extends \AdminPublic\Controller\CategoryController{

	//实例化列表

	public function index(){

		$map=array();
		$this->_list(M('Review'),$map);

		$this->display();	

	}


	//修改

	public function edit(){

		$id = I('request.id');
		$info=M('Review')->where(" id=".$id." ")->find();
		

		$this->assign("info",$info);

		$this->display();

	}


    //插入图片

	function insert(){

		$data=M('Review')->create();
		$data['time']=strtotime($data['time']);
		parent::insert(array('title'=>'不能为空'),$data);

	}

	//修改图片

	function update(){

		$map           =  M('Review')->create();

	    $this->before_check_empty(array('title'=>'标题'),$map);

		$id            =  I('request.id');

		$map['time']   =  strtotime($map['time']);

		$archives_id   =  M('Review')->where("id=".$id)->save($map);


		$this->success('成功',AJAX);

	}

	

	

}

?>