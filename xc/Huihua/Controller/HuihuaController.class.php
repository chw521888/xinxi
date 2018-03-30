<?php

namespace Huihua\Controller;

use Think\Controller;



class HuihuaController extends \AdminPublic\Controller\CategoryController{

	//实例化列表

	public function index(){
		$stage_array = array(0=>'---请选择---',1=>'第一阶段',2=>'第二阶段',3=>'第三阶段',4=>'总决赛');
		$this->assign('stage_array',$stage_array);
		$map=array();
		$id = I('get.id');
		if($id != ''){
			$map['id'] = $id;
		}
		$stage = (int)I('get.stage');
		if($stage != 0){
			$map['stage'] = $stage;
		}
		$this->_list(D('Huihua/Huihua'),$map);
		$this->display();

	}


	//修改图片

	function update(){
		$id = I('post.id');
		$is_effect = I('post.is_effect');
		$data	=  M('Huihua')->where("id=".$id)->find();
		$map['is_effect'] = $is_effect;
		if($is_effect == 1 and $data['pic_edit'] != ''){
			$map['pic'] = $data['pic_edit'];
			$map['pic_edit'] = "";
		}else{
			$map['pic_edit'] = "";
		}
		$map['num_view'] = I('post.num_view');
		$archives_id   =  M('Huihua')->where("id=".$id)->save($map);
		$is_hpf = I('post.is_hpf');
		$user_id = I('post.user_id');
		if($is_hpf == 1){
			M('User')->where('id='.$user_id)->save(array('is_hpf'=>1));
		}

		$this->success('成功',AJAX);

	}
	

	

	function set_effect(){
		$id = I('get.id');
		$ids = explode(',',$id);
		for ($i=0; $i < count($ids); $i++) {
			$info = M('Huihua')->where("id=".$ids[$i])->find();
			if($info['pic_edit'] != ''){
				$data['pic'] = $info['pic_edit'];
				$data['pic_edit'] = "";
			}else{
				$data['pic_edit'] = "";
			}
			$data['is_effect'] = 1;
			M('Huihua')->where("id=".$ids[$i])->save($data);
		}

		$this->success('成功',AJAX);
	}
	

}

?>