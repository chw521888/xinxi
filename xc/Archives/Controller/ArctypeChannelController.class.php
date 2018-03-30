<?php
namespace Archives\Controller;
use Think\Controller;

class ArctypeChannelController extends CommonController{
	

	
	
	//修改页面
	function edit(){
	    $info_id=$this->get_id();
		$this->assign("FEILD_ADD_ARRAY",C('FEILD_ADD_ARRAY'));
		$this->assign("FEILD_ADD_CHAR",C('FEILD_ADD_CHAR'));
		$this->assign("FEILD_ADD_CHAR_NUM",C('FEILD_ADD_CHAR_NUM'));
	    parent::edit();
	}
	
	
	
	
	//插入
	function insert(){
		$date_model  =   D(CONTROLLER_NAME);
		$data        =   $this->before_create($date_model);
		
		$table_name  =   C('DB_PREFIX')."archives_".$data['channel_table'];
		$sql         =   'CREATE TABLE IF NOT EXISTS `'.$table_name.'` (`id` int(11) NOT NULL AUTO_INCREMENT,`archives_id` int(11) NOT NULL,PRIMARY KEY (`id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT=\''.$data['name'].'模型表\' AUTO_INCREMENT=1 ;';
		$c = M()->execute($sql,true);
		if($c === false){$this->error("系统错误!",AJAX);}
		
		$add_save    =   $date_model->add($data);
		if($add_save==false){$this->error("系统错误!",AJAX);}
		$this->success('成功',U('ArctypeChannel/index'));
	}
	

	
	
	
	//模型插入字段
	function insert_field(){
	   $id                   = I('post.id');
	   $field_chinese_name   = I('post.field_chinese_name'); 	
	   $field_name           = I('post.field_name'); 	
	   $field_type           = I('post.field_type'); 	
	   $field_char           = I('post.field_char'); 	
	   $field_char_num       = I('post.field_char_num');
	   $field_select         = I('post.field_select');
	   
	   
	   if($id==""){$this->error("参数错误!",AJAX);}
	   if($field_chinese_name==""){$this->error("字段中文名称不能为空!",AJAX);}
	   if($field_name==""){$this->error("字段名称不能为空!",AJAX);}
	   if($field_char==""){$this->error("数据库字段类型不能为空!",AJAX);}
	   
	   $arctype_channel_info = D('ArctypeChannel')->getById($id);
	   
	    
	   if($field_char_num!=""){$sql_field_char_num=" ( ".$field_char_num." ) ";}else{$sql_field_char_num="";}
	   
	   $sql="ALTER TABLE  `".C('DB_PREFIX')."archives_".$arctype_channel_info['channel_table']."` ADD  `".$field_name."` ".$field_char.$sql_field_char_num."  NULL COMMENT  '".$field_chinese_name."' AFTER  `archives_id`";
	   
	   
	  // $sql="ALTER TABLE  `jc_archives_product` ADD  `ziduan2` VARCHAR( 200 ) NULL AFTER  `archives_id`";
	   
	   $c = M()->execute($sql,true);
	   if($c === false){$this->error("创建字段失败，请检查字段信息!",AJAX);}
	   
	   $channel_field_array=json_decode($arctype_channel_info['channel_field'],true);
	   $channel_field_array[count($channel_field_array)]=array(
	       "field_chinese_name" => $field_chinese_name,
	       "field_name"         => $field_name,
	       "field_type"         => $field_type,
	       "field_char"         => $field_char,
	       "field_char_num"     => $field_char_num,
	       "field_select"       => $field_select,
	   );
	   $channel_field_text = json_encode($channel_field_array);
	   
	   $this->model->where("id='".$id."'")->save(array("channel_field"=>$channel_field_text));
	   $this->success('成功',U('ArctypeChannel/edit#feild_add',array("id"=>$id)));
	   
	}
	
	
	//更改排序
	function update_sort(){
		$id          = I('post.id');
		$sort_array  = I('post.sort');
		
		$arctype_channel_info  =  D('ArctypeChannel')->getById($id);
		
		
		
		$channel_field_array=json_decode($arctype_channel_info['channel_field'],true);
		$new_channel_field_array=array();
		$count_sort_array=count($sort_array);
		for($i=0;$i<$count_sort_array;$i++){
		    $t=min($sort_array);
			$brr=array_flip($sort_array); 	
			$min_key=$brr[$t];
			
			$new_channel_field_array[]=$channel_field_array[$min_key];
			unset($sort_array[$min_key]);
		}
		
		
		
		
		
		$this->model->where("id='".$id."'")->save(array("channel_field"=>json_encode($new_channel_field_array)));
		$this->success('成功',AJAX);
	}
	
	
	
	
}
?>