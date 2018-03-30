<?php

namespace Fengzi\Controller;

use Think\Controller;



class FengziController extends \AdminPublic\Controller\CategoryController{

	//实例化列表

	public function index(){
		$map=array();
		$id = I('get.id');
		if($id != ''){
			$map['id'] = $id;
		}
		$this->_list(M('Fengzi'),$map);
		$this->display();
	}

	//修改图片

	function update(){
		$id        = I('post.id');
		$is_effect = I('post.is_effect');
		$data      =  M('Fengzi')->where("id=".$id)->find();
		$map['is_effect'] = $is_effect;
		if($is_effect == 1 and $data['pic_edit'] != '' and $data['pic2_edit'] != ''){
			$map['pic']       = $data['pic_edit'];
			$map['pic2']      = $data['pic2_edit'];
			$map['pic_edit']  = "";
			$map['pic2_edit'] = "";
		}else{
			$map['pic_edit']  = "";
			$map['pic2_edit'] = "";
		}
		$map['num_view'] = I('post.num_view');
		$archives_id     =  M('Fengzi')->where("id=".$id)->save($map);


		$this->success('成功',AJAX);

	}

	function set_effect(){
		$id = I('get.id');
		$ids = explode(',',$id);
		for ($i=0; $i < count($ids); $i++) {
			$info = M('Fengzi')->where("id=".$ids[$i])->find();
			if($info['pic_edit'] != ''){
				$data['pic']       = $info['pic_edit'];
				$data['pic2']      = $info['pic2_edit'];
				$data['pic_edit']  = "";
				$data['pic2_edit'] = "";
			}else{
				$data['pic_edit']  = "";
				$data['pic2_edit'] = "";
			}
			$data['is_effect'] = 1;
			M('Fengzi')->where("id=".$ids[$i])->save($data);
		}

		$this->success('成功',AJAX);
	}

	

}

?>