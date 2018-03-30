<?php

namespace Dati\Controller;

use Think\Controller;



class DatiController extends \AdminPublic\Controller\CategoryController{

	//实例化列表

	public function index(){

		$map=array();
		$this->_list(M('Dati'),$map);

		$this->display();	

	}
	

}

?>