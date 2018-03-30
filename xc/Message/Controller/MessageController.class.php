<?php
namespace Message\Controller;
use Think\Controller;

class MessageController extends \AdminPublic\Controller\CategoryController{
     
	 public function index(){
		$this->_list(M('Message'));
		$this->display();
    }
	
}