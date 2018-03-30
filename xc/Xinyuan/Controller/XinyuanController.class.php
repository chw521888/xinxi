<?php
namespace Xinyuan\Controller;
use Think\Controller;

class XinyuanController extends \AdminPublic\Controller\CategoryController{
     
	 public function index(){
		$this->_list(M('Xinyuan'));
		$this->display();
    }
	function insert(){
	$data = M('Xinyuan')->create();
	$data['time'] = strtotime($data['time']);
	parent::insert('',$data);
	}
}