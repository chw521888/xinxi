<?php

namespace Huaxu\Controller;

use Think\Controller;



class HuaxuController extends \AdminPublic\Controller\CategoryController{

	//实例化列表

	public function index(){

		$map=array();
		$this->_list(M('Huaxu'),$map);

		$this->display();	

	}


	//修改

	public function edit(){

		$id = I('request.id');
		$info=M('Huaxu')->where(" id=".$id." ")->find();
		

		$this->assign("info",$info);

		$this->display();

	}


    //插入图片

	function insert(){

		$data=M('Huaxu')->create();
		$data['time']=strtotime($data['time']);
		parent::insert(array('title'=>'不能为空'),$data);

	}

	//修改图片

	function update(){

		$map           =  M('Huaxu')->create();

	    $this->before_check_empty(array('title'=>'标题'),$map);

		$id            =  I('request.id');

		$map['time']   =  strtotime($map['time']);

		$archives_id   =  M('Huaxu')->where("id=".$id)->save($map);


		$this->success('成功',AJAX);

	}

	

	

}

?>