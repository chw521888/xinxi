<?php
include('function_wg.php');


//返回，模型所在的栏目列表,和模型栏目的ids
function arctype_channel_list($channeltype_list,$channeltype_id){
    $return=array(
	    'list' =>array(),
	    'ids'  =>array(),
	 );
	if(is_array($channeltype_list)){
	   foreach($channeltype_list as $key=>$cl){
		  if($cl['reid']==0){$in_array=array($key);}else{$in_array[count($in_array)]=$key;}
		  if($cl['channeltype_id']==$channeltype_id){
			  $return['ids'][]=$cl['id'];
			  for($i=0;$i<count($in_array);$i++){
				  $return['list'][]=$channeltype_list[$in_array[$i]];
			  }
			  $in_array=array();
		  }
	   }	
	}
	
	return $return;
}






//获得分类所在的模板
function get_arctype_template($arctype_id,$type=0){
	$arctype_id=make_number($arctype_id);
	//$return=S('get_arctype_template_'.$arctype_id.'_'.$type);
	if($return==false){
	   $arctype_template_info=M("Arctype")->field("id,template_index,template_list,template_article,is_part,url")->where("id='".$arctype_id."'")->find();
	   if($arctype_template_info['id']==""){return false;}
	   if($arctype_template_info['is_part']==-1){redirect($arctype_template_info['url']);}
	   if($arctype_template_info['is_part']==1){$return_array[0]='../'.C('FOLDER_TEMPLET_ARCHIVES_INDEX').$arctype_template_info['template_index'];}
	                                       else{$return_array[0]='../'.C('FOLDER_TEMPLET_ARCHIVES_LIST').$arctype_template_info['template_list'];}
	   $return_array[1]='../'.C('FOLDER_TEMPLET_ARCHIVES_ARTICLE').$arctype_template_info['template_article'];
	   $return="/".$return_array[$type];
       S('get_arctype_template_'.$arctype_id.'_'.$type,$return,60*60*24);
	}
	return $return;
}


