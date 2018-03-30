<?php

/**

幻灯片标签

$tag=array(
    'category_id'         => 分类id，默认全部
    'limit'               => 数量,默认10个
);


**/
function get_ad_images($tag){
	$category_id = $tag['category_id'] ? $tag['category_id'] : 0;
	$limit       = $tag['limit'] ? $tag['limit'] : 10;
	
	$now_date=date('Ymd');
    $return=S('get_ad_images_'.$category_id.'_'.$now_date);
	if($return==false){
	   $d_arctype=D("AdImages/AdImages");
	   $map['AdImages.is_effect']=1;
	   $map['AdImages.is_system']=0;
	   if($category_id>0){$map['AdImages.category_id']=$category_id;}
	   $return=D("AdImages/AdImages")->where($map)->order("AdImages.sort asc,AdImages.id desc")->limit($limit)->select();
	   S('get_ad_images_'.$category_id.'_'.$now_date,$return,60*60*24);
	}
	return $return;
} 



