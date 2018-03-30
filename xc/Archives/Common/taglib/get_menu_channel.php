<?php

/**

获得底部或底部导航的分类

$tag=array(
    'limit'            => 条数,默认10条
    'menu'             =>0为顶部导航1为底部导航，默认为0
);


**/
function get_menu_channel($tag){
	$limit  = $tag['limit'] ? $tag['limit'] : 10;
	$menu   = $tag['menu'] ? $tag['menu'] : 0;
	
    //$return=S('get_menu_channel_'.$limit.'_'.$menu);
	if($return==false){
	   $d_arctype=D("Archives/Arctype");
	   $map['Arctype.is_effect']=1;
	   if($menu==1){
		  $map['is_menu_foot']=1;   
	   }else{
		  $map['is_menu_top']=1;   
	   }
	   $return=$d_arctype->where($map)->order("Arctype.sort asc,Arctype.id asc")->limit($limit)->select();
	   $return=make_index_data_list($return);
	   S('get_menu_channel_'.$limit.'_'.$menu,$return,60*60*24);
	}
	return $return;
} 



