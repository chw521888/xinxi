<?php

//加载各个模块的自带模板函数
$tem_path=APP_ROOT_PATH.APP_PATH;
 $handle = opendir($tem_path);
 $taglib_fold=array();
 if($handle){
   while(($fold=readdir($handle))!==false){
	 $taglib_f=$tem_path.$fold."/Common/taglib/";
	 if(is_dir($taglib_f)){
	  $handle_tf=opendir($taglib_f);
	  if($handle_tf){
		  while(($taglib_file=readdir($handle_tf))!==false){
			 if(is_file($taglib_f.$taglib_file)){
				 include_once($taglib_f.$taglib_file);
		     } 
		  }
	   }
	 } 
   }
 }



