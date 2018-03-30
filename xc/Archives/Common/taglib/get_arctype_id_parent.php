<?php

//获取栏目ID的父级id的ARRAY
function get_arctype_id_parent($arctype_id){
	  $arctype_id=make_number($arctype_id);
	  if($arctype_id==0){$arctype_id=get_now_arctype_id();}
	  //$arctype_id_parent=S('get_arctype_id_parent_'.$arctype_id);
	  if($arctype_id_parent==false){
		  $arctype_id_parent=D("Archives/Arctype")->get_id_parent($arctype_id);
		  $arctype_id_parent=array_reverse($arctype_id_parent);
		  S('get_arctype_id_parent_'.$arctype_id,$arctype_id_parent);
	  }
	  return $arctype_id_parent;
}
