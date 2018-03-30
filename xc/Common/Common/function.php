<?php
require 'function_table.php';
require 'function_index.php';





// 全站公共函数库
// 更改系统配置, 当更改数据库配置时为永久性修改， 修改配置文档中配置为临时修改
function conf($name,$value = false){
	if($value === false){
		return C($name);
	}
}

//检查权限
function check_auth($MODULE_NAME,$CONTROLLER_NAME="",$ACTION_NAME=""){
		$adm_session = es_session_get(md5(C("AUTH_KEY")));
        $auth = new \Think\Auth();
		$auth_q=$MODULE_NAME;
		if($CONTROLLER_NAME!=""){$auth_q='/'.$CONTROLLER_NAME;}
		if($ACTION_NAME!=""){$auth_q='/'.$ACTION_NAME;}
		return ($auth->check($auth_q,$adm_session['user_id']));	
}


//选择模板，如果第2个模板文件不存在返回第1个
function select_template($template1,$template2=""){
	$return_template=$template1;
	if($template2!="" and is_file(T($template2))){
		$return_template=$template2;
	}
	
	//echo T($template2;exit();
	
	return $return_template;
}









////后台日志记录
function save_log($msg,$status){
		$adm_session = es_session_get(md5(conf("AUTH_KEY")));
		$log_data['log_info'] = $msg;
		$log_data['log_time'] = time();
		$log_data['log_admin'] = intval($adm_session['user_id']);
		$log_data['log_ip']	= get_client_ip();
		$log_data['log_status'] = $status;	
		$log_data['module']	=	MODULE_NAME;
		$log_data['action'] = 	ACTION_NAME;
		M("Log")->add($log_data);
}



?>