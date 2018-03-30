<?php
/**
文章分类  按照级别调用标签

$tag=array(
    'typeid'         => 栏目ID,
    'limit'          => 条数,默认10条
    'level'          => 级别，默认1
);

**/
function get_level_channel($tag){
	$typeid = $tag['typeid'] ? $tag['typeid'] : get_now_arctype_id();
	$limit    = $tag['limit'] ? $tag['limit'] : 10;
	$level    = $tag['level'] ? $tag['level'] : 1;
	
    //$return=S('get_level_channel_'.$typeid.'_'.$row);
	if($return==false){
	   $limit=$limit;
	   $m_arctype=M("Arctype");
	   $d_arctype=D("Archives/Arctype");
	   if($level>0){
		  $return=array();
		  $id_parent_array=get_arctype_id_parent($typeid);
		  $r_level=$level;
		  if(count($id_parent_array)>=$r_level){
			  $return=D("Archives/Arctype")->where("Arctype.reid='".$id_parent_array[$r_level]."' and Arctype.is_effect=1")->order("Arctype.sort asc,Arctype.id asc")->limit($limit)->select();  
		  }
	      $return=make_index_data_list($return);
	   }else{
		  $array  = array("type"=>'top','limit'=>$limit);
		  $return = get_channel($array); 
	   }
	   S('get_level_channel_'.$typeid.'_'.$row,$return);
	}
	return $return;
} 



