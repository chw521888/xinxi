<?php

//获取栏目ID的父级id的ARRAY
/**
  arctype_id   :分类id，支持多个用,隔开

**/
function get_arctype_id_son($arctype_id){
	  $arctype_id=make_number($arctype_id);
	  if($arctype_id==0){$arctype_id=get_now_arctype_id();}
	  $arctype_id_parent=S('get_arctype_id_son_'.$arctype_id);
	  if($arctype_id_parent==false){
		  $arctype_array=explode(',',$arctype_id);
		  $arctype_id_parent=array();
		  foreach($arctype_array as $aa){
		    $arctype_id_parent_aa=D("Archives/Arctype")->get_id_son($aa);
			$arctype_id_parent=$arctype_id_parent+$arctype_id_parent_aa;
		  }
		  S('get_arctype_id_son_'.$arctype_id,$arctype_id_parent);
	  }
	  return $arctype_id_parent;
}
