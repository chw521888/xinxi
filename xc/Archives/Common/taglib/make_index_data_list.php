<?php
	//处理前台调用LIST，增加URL和当前栏目
	function make_index_data_list($list=array()){	
	   $return=array();
	   if(count($list)>0){
		  $now_arctype_id    = get_now_arctype_id();
		  $arctype_id_parent = get_arctype_id_parent($now_arctype_id);
		  foreach($list as $l){
			  if($l['is_part']!=-1){
				 $l['url']=U("Archives/IndexArctype/index",array("t_id"=>$l['id']));    
			  }else{
				  $l['url']=urldecode($l['url']);
			  }
			  $l['is_now']=0;
			  if($l['id']==$now_arctype_id){
				 $l['is_now']=1;
			  }
			  
			  $l['is_now_parent']=0;
			  if(is_array($arctype_id_parent) and in_array($l['id'],$arctype_id_parent)){
				 $l['is_now_parent']=1;
			  }
			  $return[]=$l;
		  }   
	   }
	   return $return;
	}