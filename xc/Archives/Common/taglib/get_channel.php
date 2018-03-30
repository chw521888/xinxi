<?php

/**

文章分类标签

$tag=array(
    'typeid'         => 栏目ID,
    'reid'           => 上级栏目ID,
    'limit'            => 条数,默认10条,
    'type'           => type:son表示下级栏目,self表示同级栏目,top顶级栏目
);


**/
function get_channel($tag){
	$typeid = $tag['typeid'] ? $tag['typeid'] : '';
	$reid   = $tag['reid'] ? $tag['reid'] : 0;
	$limit  = $tag['limit'] ? $tag['limit'] : 10;
	$type   = $tag['type'] ? $tag['type'] : 'son';
	$reid   = $tag['reid'] ? $tag['reid'] : 0;
	
    $return=S('get_channel_'.$typeid.'_'.$reid.'_'.$row.'_'.$type);
	if($return==false){
	   $m_arctype=M("Arctype");
	   $d_arctype=D("Archives/Arctype");
	   $map['Arctype.is_effect']=1;
	   if($typeid!=""){$map['Arctype.id']=array('in',$typeid);}
	   if($reid>0){$map['Arctype.reid']=$reid;}
	   if($type=='self'){
		   $arctype_info=$m_arctype->where($map)->find();
		   $return=D("Archives/Arctype")->where("reid='".$arctype_info['reid']."' and Arctype.is_effect=1")->order("Arctype.sort asc,Arctype.id asc")->limit($limit)->select();
	   }
	   else if($type=='top'){
		   $return=D("Archives/Arctype")->where("Arctype.reid=0 and Arctype.is_effect=1")->order("Arctype.sort asc,Arctype.id asc")->limit($limit)->select();
	   }
	   else{
		   $return=D("Archives/Arctype")->where($map)->order("Arctype.sort asc,Arctype.id asc")->limit($limit)->select();
	   }
	   $return=make_index_data_list($return);
	   S('get_channel_'.$typeid.'_'.$reid.'_'.$row.'_'.$type,$return);
	}
	return $return;
} 



