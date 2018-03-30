<?php


//获取系统管理员姓名
function show_admin_username($adm_id){
	$data['id'] = $adm_id;
	$adm = M('Admin')->where($data)->find();
	return $adm['login_name'];
	}



