<?php
//获得当前分类详细
function get_arctype_info($arctype_id){
   $arctype_info=S('get_arctype_info_'.$arctype_id);
   if($arctype_info==false){
	   $arctype_list=D("Archives/Arctype")->where("Arctype.id='".$arctype_id."' and Arctype.is_effect=1")->select();
	   $arctype_list=make_index_data_list($arctype_list);
	   $arctype_info=$arctype_list[0];
	   S('get_arctype_info_'.$arctype_id,$arctype_info);
   }
   return $arctype_info;
}