<?php
/**
获取文章列表标签

$tag=array(
    'a_id'       => 文章id，默认当前文章
    'where'       => 条件，默认空
	
);
**/
function get_article_info($tag){
	
	$a_id     = $tag['a_id'] ? $tag['a_id'] : 0;
	$where    = $tag['where'] ? $tag['where'] : '';
	
	$a_id     = make_number($a_id); 
    $return=S('get_article_info_'.$a_id);
	if($return==false){
		$map['id']=$a_id;
		$map['is_effect']=1;
		$map['is_delete']=0;
		 $map['Archives.end_time']=array(array('eq',0),array('egt',time()), 'or') ;
		if($where!=""){$map['_string']=$map;}
		$archives_info=D("Archives/Archives")->where($map)->find();
		if($archives_info['id']>0){
		   $channeltype_info=M('ArctypeChannel')->getById($archives_info['channeltype_id']);
		   
		   $expand_info=M('Archives'.ucfirst($channeltype_info['channel_table']))->where("archives_id='".$a_id."'")->find();
		   if(is_array($expand_info)){
		     unset($expand_info['id']);
		     unset($expand_info['archives_id']);
		     $return=$archives_info+$expand_info;
		   }else{
			 $return=$archives_info;  
		   }
	    }
	   S('get_article_info_'.$a_id,$return);
	}
	return $return;
} 



