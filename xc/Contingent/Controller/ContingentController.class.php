<?php
namespace Contingent\Controller;
use Think\Controller;

class ContingentController extends \AdminPublic\Controller\CategoryController{

  function index(){
	  $location_list=M('Location')->where('location_id=0')->select();
	  foreach($location_list as $key=>$lc){
		  $location_list[$key]['value'] = M('Location')->where("location_id=".$lc['id'])->select();
		  }
	  $this->assign("location_list",$location_list);
	  
	  $location_id = I('request.location_id');
	  $keywords = I('request.keywords');
	  if($location_id != ""){
		  $map['location_id'] = $location_id;
		  }
	  if($keywords != ""){
		$map['_string'] = "name like '%".$keywords."%'";
		}
	  $this->_list(D('Contingent'),$map);
	  $this->display();  
  }

	//新增页面
	function add(){
		$location_list=M('Location')->where('location_id=0')->select();
		foreach($location_list as $key=>$lc){
			$location_list[$key]['value'] = M('Location')->where("location_id=".$lc['id'])->select();
			}
		$this->assign("location_list",$location_list);
		parent::add();
	}
	
	
	//修改页面
	function edit(){
		$location_list=M('Location')->where('location_id=0')->select();
		foreach($location_list as $key=>$lc){
			$location_list[$key]['value'] = M('Location')->where("location_id=".$lc['id'])->select();
			}
		$this->assign("location_list",$location_list);
		parent::edit();
	}
	
	
	
	//插入操作
	function insert(){
		$data=M("Contingent")->create();
		$data['time']=time();
		$cg_id = M('Contingent')->add($data);
		//$this->redirect('Contingent/Contingent/add',array('location_id'=>$data['location_id']));
		$this->success('成功',U('Contingent/Contingent/add',array('location_id'=>$data['location_id'])));
		//parent::insert('',$data);
	}
	//修改操作
	function update(){
		$data=M("Contingent")->create();
		parent::update('',$data);
	}
	
	function foreverdelete(){
		$id = I('request.id');
		M("Contingent")->where("id =".$id)->delete();
		$this->success('删除成功',AJAX);
		}
	
}
?>