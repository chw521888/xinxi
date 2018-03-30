<?php
namespace Admin\Controller;
use Think\Controller;

class LogController extends CommonController{
	public function index(){
		parent::index();
	}
	
	//删除
	public function foreverdelete(){
		$category_name=$this->getActionName();
		$department_id=I('request.id');
		if($department_id==""){$this->error('参数错误!',AJAX);}
		M('Log')->where("id in (".$department_id.")")->delete();
		$this->success('成功',AJAX);
	}
	
	
}
?>