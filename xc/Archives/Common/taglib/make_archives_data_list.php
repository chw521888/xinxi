<?php
	/**
	处理文章list
	自动加url   图片不存在加暂无图片
	
	**/
	function make_archives_data_list($list=array()){	
	   $return=array();
	   if(count($list)>0){
		  foreach($list as $l){
			  if($l['url']==""){
			     $l['url']=U("Archives/IndexArchives/index",array("a_id"=>$l['id'])); 
			  }
			   $web_root_path=str_replace($_SERVER['DOCUMENT_ROOT'],'',APP_ROOT_PATH);
			   if($web_root_path=="/"){$web_root_path='';}
			   if($l['pic']==""){$l['pic']="/".$web_root_path."template/Common/Common/images/no_pic.gif";}  
			  
			  $return[]=$l;
		  }   
	   }
	   return $return;
	}