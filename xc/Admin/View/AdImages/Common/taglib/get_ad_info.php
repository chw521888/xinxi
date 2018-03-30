<?php

/**

幻灯片标签

$id 幻灯片id


**/
function get_ad_info($id){
	$id          = $id ? $id : 0;
    $return=S('get_ad_info_'.$id);
	$id=make_number($id);
	if($id==0){return array();}
	if($return==false){
	   $d_arctype=D("AdImages/AdImages");
	   $map['AdImages.id']=$id;
	   $return=D("AdImages/AdImages")->where($map)->order("AdImages.sort asc,AdImages.id desc")->limit($limit)->find();
	   S('get_ad_info_'.$id,$return);
	}
	return $return;
} 



