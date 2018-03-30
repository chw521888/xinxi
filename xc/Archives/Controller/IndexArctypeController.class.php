<?php
namespace Archives\Controller;
use Think\Controller;

class IndexArctypeController extends \Common\Controller\CommonIndexController{
	
    function index(){
	  $t_id=I('request.t_id','','make_number');
	  $info=get_arctype_info($t_id);
	  $this->assign('info',$info);
	  $d_arctype=D('Archives/Arctype');
	  $d_article=D('Archives/Archives');
	  
	  $t_id_array = $d_arctype->get_id_son($t_id);
	 
	 
	  //判断是否存在扩展模型
	  if($info['channeltype_channel_table']!=""){
		  $expend_model = D("Archives/Archives".ucwords($info['channeltype_channel_table']));
           if(is_array($expend_model->viewFields)){
			 $d_article=$expend_model;
		   }
		   if($expend_model->table_where!=""){
			  $map['_string']=$expend_model->table_where; 
		   }
		   if(method_exists($expend_model,"get_where")==true){
			   $map=$expend_model->get_where($map);
		   }   
	  }
	  
	  $map['arctype_id']=array('in',$t_id_array);
	  $map['Archives.is_effect']=1;
	  $map['Archives.is_delete']=0;
	  $map['Archives.end_time']=array(array('eq',0),array('egt',time()), 'or') ;
	  C('listRows',$info['list_rows']);
	  
	  $new_list=$this->_list($d_article,$map,"Archives.sort asc,Archives.pubdate desc,Archives.time",0);
	  $new_list=make_archives_data_list($new_list);
	  $this->assign ('list',$new_list );
	  
	  
	  $template=get_arctype_template($t_id);
	  $this->display($template);	
    }		
	
	
	
	
	function list_ajax(){
	  $t_id=I('request.t_id','','make_number');
	  $info=get_arctype_info($t_id);
	  $this->assign('info',$info);
	  $d_arctype=D('Archives/Arctype');
	  $d_article=D('Archives/Archives');
	  
	  $t_id_array = $d_arctype->get_id_son($t_id);
	   //判断是否存在扩展模型
	  if($info['channeltype_channel_table']!=""){
		  $expend_model = D("Archives/Archives".ucwords($info['channeltype_channel_table']));
           if(is_array($expend_model->viewFields)){
			 $d_article=$expend_model;
		   }
		   if($expend_model->table_where!=""){
			  $map['_string']=$expend_model->table_where; 
		   }
		   if(method_exists($expend_model,"get_where")==true){
			   $map=$expend_model->get_where($map);
		   }   
	  }
	  
	  $map['arctype_id']=array('in',$t_id_array);
	  $map['Archives.is_effect']=1;
	  $map['Archives.is_delete']=0;
	  $map['Archives.end_time']=array(array('eq',0),array('egt',time()), 'or') ;
	  
	  $data=$this->_list_return($d_article,$map,"Archives.sort asc,Archives.pubdate desc,Archives.time",1);
	  $this->ajaxReturn($data);
    }
}
?>