<?php
namespace Admin\Model;
use Think\Model\ViewModel;

class LogModel extends ViewModel {
	
	public $viewFields = array(
     'Log'                  =>  array('*','_type'=>'LEFT'),
     'Admin'                =>  array('chinese_name'=>'admin_chinese_name', '_on'=>'Log.log_admin=Admin.id'),
   );
	
}


?>