<?php
namespace Archives\Model;
use Think\Model\ViewModel;

class ArctypeModel extends ViewModel{ 
    public $viewFields = array(
        'Arctype'                 =>  array('*','_type'=>'LEFT'),
        'ArctypeChannel'          =>  array('name'=>'channeltype_name','channel_table'=>'channeltype_channel_table', '_on'=>'Arctype.channeltype_id=ArctypeChannel.id')
    );

	//获得文章分类递归
	function get_recursive_list($where_sql="",$is_s=1){
		$recursive_list=S('recursive_list_'.$where_sql);
		if($recursive_list==false or $is_s!=1){
			if($where_sql!="")$where['_string'] = $where_sql;
			$db_recursive_list=D('Archives/Arctype')->where($where)->order("Arctype.sort asc, Arctype.id asc")->select();
			$recursive_list=array();
			$recursive_db_list=array();
			if(is_array($db_recursive_list)){
			  foreach($db_recursive_list as $drl){
			     $recursive_db_list[$drl['reid']][]=$drl; 
			  }
			  $recursive_list=$this->do_recursive_list($recursive_db_list);
			}
			S('recursive_list_'.$where_sql,$recursive_list);
		}
		return $recursive_list;
	}
	
	
	
	//防死循环递归操作
	function do_recursive_list($data,$top=0,$return_data=array(),$num_i=0,$level=0){
		if($num_i>100000){return $return_data;}
		
		for($lev = 0; $lev < $level * 2 - 1; $lev ++) {
		   $level_nbsp .= "　";
	    }
	    if ($level++) $level_nbsp .= " ┝ ";
		for($i=0;$i<count($data[$top]);$i++){
		  $data[$top][$i]['full_typename']=$level_nbsp.$data[$top][$i]['typename'];
		  $return_data[count($return_data)] = $data[$top][$i];
		  $num_i++;
		  if($data[$top][$i]['id']>0){
			  $return_data=$this->do_recursive_list($data,$data[$top][$i]['id'],$return_data,$num_i,$level);
		  }
		}
		return $return_data;
	}
	
	
	
	//获得ID的父级id ARRAY
	function get_id_parent($arctype_id,$recursive_list=array(),$return=array()){
	   $arctype_id=make_number($arctype_id);
	   $return[]=$arctype_id;
	   if($arctype_id>0){
	     if(count($recursive_list)==0){
		    $recursive_list=$this->get_recursive_list();   
	     }
		 foreach($recursive_list as $rl){
	        if($rl['id']==$arctype_id){
			   	//$return[]=$rl['reid'];
				$return=$this->get_id_parent($rl['reid'],$recursive_list,$return);
			}
		 }
		 
	   }
	   return $return;
    }
	
	
	
	

	//获得ID的子级id ARRAY
	function get_id_son($arctype_id,$recursive_list=array(),$return=array()){
	    $arctype_id=make_number($arctype_id);
	     $return[]=$arctype_id;
	     if(count($recursive_list)==0){
		    $recursive_list=$this->get_recursive_list();   
	     }		 
		 foreach($recursive_list as $rl){
	        if($rl['reid']==$arctype_id and $rl['is_effect']==1){
			    $return=$this->get_id_son($rl['id'],$recursive_list,$return);
			}
		 }
	   return $return;
    }
	
	
	

}

?>