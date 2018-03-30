<?php

/**
获得网页位置
$tag=array(
    'position_array'  =>  array(),
	'gap'             =>  '>',
	'index_name'      =>  '首页',
 );
**/
function get_position($position_array=array()){
	$position_array  =  $tag['position_array'] ? $tag['position_array'] : '';
	$gap             =  $tag['gap'] ? $tag['gap'] : '>';
	$index_name      =  $tag['index_name'] ? $tag['index_name'] : '首页';
    $url='http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"]; 
  
  
   //文章栏目列表
   if(!is_array($position_array) or count($position_array)<=0){
	 $return=S('get_position_'.$url."_".$gap."_".$index_name);
	 if($return==false){
	   $return="<a href='/'>".$index_name."</a>";
       if(CONTROLLER_NAME=='IndexArctype' or CONTROLLER_NAME=='IndexArchives'){
	      $now_arctype_id    = get_now_arctype_id();
	      $arctype_id_parent = get_arctype_id_parent($now_arctype_id);
	      if(is_array($arctype_id_parent) and count($arctype_id_parent)>1){
	         $arctype_list=get_channel(array('typeid'=>implode(',',$arctype_id_parent)));
		     foreach($arctype_list as $al){
			    $return.= $gap."<a href='".$al['url']."'>".$al['typename']."</a>";;
		     }
	      }
       }
	   S('get_position_'.$url."_".$gap."_".$index_name,$return,60*60*24);
	 }
	 return $return;
   }else{
	   
	   
   }
   
} 



