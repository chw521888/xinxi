<?php

//获取真实路径
function get_real_path(){
	
	return APP_ROOT_PATH;

}


/*ajax返回*/
function ajax_return($data){
	
		header("Content-Type:text/html; charset=utf-8");
        echo(json_encode($data));
        exit;	
}


//检查数字是否合法
function check_number($number){
     if(is_numeric($number) and $number>0){
	  return true;	 
	 }else{
	 return false;	 
	}
}




//转换thinkphp表
function get_thinkphp_tablie($tablie){
	$daxie=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
	$xiaoxie=array('_a','_b','_c','_d','_e','_f','_g','_h','_i','_j','_k','_l','_m','_n','_o','_p','_q','_r','_s','_t','_u','_v','_w','_x','_y','_z');
	$new_tablie=str_replace($daxie,$xiaoxie,$tablie);
	$new_tablie=C('DB_PREFIX').$new_tablie;
	$new_tablie=str_replace('__','_',$new_tablie);
	return $new_tablie;
}


//获得表注释
function get_table_comment($tablie){
	$return=F('TABLE_COMMENT_'.$tablie);
	if($return==false){
	   $tablie_info = M()->query("Select TABLE_COMMENT from INFORMATION_SCHEMA.TABLES Where table_name = '".$tablie."'");
	   if($tablie_info[0]['TABLE_COMMENT'] and $tablie_info[0]['TABLE_COMMENT']==''){
	       $return=$tablie;	
	     }else{
		    $return=$tablie_info[0]['TABLE_COMMENT'];	
	   }
	   F('TABLE_COMMENT_'.$tablie,$return);
	}
	return $return;
}







//数字处理，空和非数字返回0
function make_number($number){
    	if($number=="" or !is_numeric($number)){
		  return 0;	
		}else{
		  return $number;
		}
}








function isMobile(){
    $detect   = new \Common\ORG\Util\MobileDetect\MobileDetect();					// 实例化检查类
	if($detect->isMobile()==true){
	   if($detect->isTablet()==false){
		   return true;	 
	   }  
	}
    return false;
}












