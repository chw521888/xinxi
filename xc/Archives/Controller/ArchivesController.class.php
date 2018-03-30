<?php
namespace Archives\Controller;
use Think\Controller;

class ArchivesController extends \AdminPublic\Controller\CategoryController{
	
	public function __construct() {
		parent::__construct();
	  //模型信息
	  $channeltype_id=I('request.channeltype_id');
	  $this->channeltype_id=$channeltype_id;
	  $arctype_channel_info=D('ArctypeChannel')->getById($channeltype_id);//模型信息
	  $this->assign("arctype_channel_info", $arctype_channel_info);
	  $this->assign("channeltype_id", $channeltype_id);
    }  
	
	
	//添加页面
	public function add(){
	    $arctype_channel_info=D('ArctypeChannel')->getById($this->channeltype_id);//模型信息		
		
		
		$arctype_channel_list=arctype_channel_list(D('Arctype')->get_recursive_list("",0),$this->channeltype_id);
		$arctype_channel_array=array(0=>'请选择栏目')+make_two_array($arctype_channel_list['list'],'id','full_typename');
		
		$this->assign("arctype_channel_array",$arctype_channel_array);
		$this->assign("arctype_channel_ids",$arctype_channel_list['ids']);
		
		
		$this->assign("channel_field",json_decode($arctype_channel_info['channel_field'],true));//模型字段
		$this->assign("ARCHIVES_ATT_ARRAY",C('ARCHIVES_ATT_ARRAY'));//模型字段
	    $this->display();
	}
	
	//修改页面
	public function edit(){
		$id=$this->get_id();
	    $arctype_channel_info=D('ArctypeChannel')->getById($this->channeltype_id);//模型信息		
		
		
		$arctype_channel_list=arctype_channel_list(D('Arctype')->get_recursive_list("",0),$this->channeltype_id);
		$arctype_channel_array=array(0=>'请选择栏目')+make_two_array($arctype_channel_list['list'],'id','full_typename');
		
		$this->assign("arctype_channel_array",$arctype_channel_array);
		$this->assign("arctype_channel_ids",$arctype_channel_list['ids']);
		
		$add_table       = "archives_".$arctype_channel_info['channel_table'];
		
		$info=M('Archives')->getById($id);
		$info_add=M($add_table)->where("archives_id='".$id."'")->find();
		if(is_array($info_add)){
		  $info=$info+$info_add;
		}
		
		
		
		$this->assign("channel_field",json_decode($arctype_channel_info['channel_field'],true));//模型字段
		$this->assign("ARCHIVES_ATT_ARRAY",C('ARCHIVES_ATT_ARRAY'));//模型字段
		$this->assign("info",$info);//模型字段
	    $this->display();
	}
	
	
	
	
	
	
	//首页赋值
	public function index(){
	  $start_time=I('get.start_time');
	  $end_time=I('get.end_time');
	  $keyword=I('get.keyword');
	  
	  $map=$this->_search();
	  $map['Archives.is_delete'] = 0;
	  $map['Arctype.channeltype_id'] = $this->channeltype_id;
	  
	  if($start_time!=""){$map['time']=array('gt',strtotime($start_time));}
	  if($end_time!=""){$map['time']=array('lt',strtotime($end_time));}
	  $map = $this->_search_like($map,array("title","source"));	
	  
	  
		$arctype_channel_list=arctype_channel_list(D('Arctype')->get_recursive_list("",0),$this->channeltype_id);
	    $arctype_channel_array=array(""=>'全部栏目')+make_two_array($arctype_channel_list['list'],'id','full_typename');
		
		$this->assign("arctype_channel_array",$arctype_channel_array);
	  
	  $this->_list(D('Archives'),$map,'Archives.sort asc,Archives.time',0);
	  $this->display();
	}
	
	
	//单页
	public function dy_index(){
	  $map['channeltype_id'] = 1;
	  $this->_list(D('arctype'),$map);
	  $this->display();
	}
	
	

	//假删除页面赋值
	public function del_index(){
	
	$map['is_delete'] = 1;
	$this->_list(D('Archives'),$map,'sort','asc');
	$this->display();
	}
	
	
	
	
	//新增文章过程
	function insert(){
		
		$adm_session     =  es_session_get(md5(conf("AUTH_KEY")));
		
		$map             =  M('Archives')->create();
	    $this->before_check_empty(array('title'=>'标题','arctype_id'=>'文章栏目'),$map);
		$map['time']     =  strtotime($map['time']);
		$map['end_time']     =  strtotime($map['end_time']);
		$map['admin_id'] =  $adm_session['user_id'];
		$att_array       =  $_POST['att'];
		
		if($map['pic']!="" and (!is_array($att_array) or !in_array('a',$att_array))){$att_array[]='a';}//上传缩略图自动加图片属性
		if(is_array($att_array)){$map['att']=implode(',',$att_array);}//处理属性
		//处理多图上传
		$pic_list_array=array();
		for($i=0;$i<count($_POST['pic_list_url']);$i++){
		  	$pic_list_array[$i]['url']=$_POST['pic_list_url'][$i];
		  	$pic_list_array[$i]['name']=$_POST['pic_list_name'][$i];
		}
		$map['pic_list'] = json_encode($pic_list_array);
		if($_POST['is_url']!=1){unset($map['url']);}//处理外链接
		
		
		
		$arctype_channel_info=D('ArctypeChannel')->getById($this->channeltype_id);//模型信息
		
		$archives_id     =  M('Archives')->add($map);
		if($archives_id == false){$this->error('系统错误',AJAX);}
		
		//给扩展表增加信息
		$add_table       = "archives_".$arctype_channel_info['channel_table'];
		$Arctype_data    =  M($add_table)->create();
		$Arctype_data['archives_id'] = $archives_id ;
		 M($add_table)->add($Arctype_data);
		
		
		if($archives_id == false){$this->error('系统错误',AJAX);}
		save_log('新增'.get_table_comment(get_thinkphp_tablie('Archives'))."数据ID=".$archives_id,1);
		$this->success('成功',AJAX);
		
	}
	
	//修改文章过程
	function update(){
		$map           =  M('Archives')->create();
	    $this->before_check_empty(array('title'=>'标题','arctype_id'=>'文章栏目'),$map);
		$id            =  I('request.id');
		$map['time']   =  strtotime($map['time']);
		$map['end_time']   =  strtotime($map['end_time']);

        $att_array       =  $_POST['att'];
		
		if($map['pic']!="" and (!is_array($att_array) or !in_array('a',$att_array))){$att_array[]='a';}//上传缩略图自动加图片属性
		if(is_array($att_array)){$map['att']=implode(',',$att_array);}else{$map['att']="";}//处理属性
		//处理多图上传
		$pic_list_array=array();
		for($i=0;$i<count($_POST['pic_list_url']);$i++){
		  	$pic_list_array[$i]['url']=$_POST['pic_list_url'][$i];
		  	$pic_list_array[$i]['name']=$_POST['pic_list_name'][$i];
		}
		$map['pic_list'] = json_encode($pic_list_array);
		if($_POST['is_url']!=1){unset($map['url']);}//处理外链接
		
		
		
		$arctype_channel_info=D('ArctypeChannel')->getById($this->channeltype_id);//模型信息
		
		


		$archives_id   =  M('Archives')->where("id=".$id)->save($map);
		//给扩展表增加信息
		$add_table       = "archives_".$arctype_channel_info['channel_table'];
		$Arctype_data    =  M($add_table)->create();
		unset($Arctype_data['id']);
		$add_table_info=M($add_table)->where("archives_id='".$id."'")->find();
		if($add_table_info['id']>0){
			 M($add_table)->where("archives_id='".$id."'")->save($Arctype_data);			 
		}else{
			 $Arctype_data['archives_id']=$id;
			 M($add_table)->add($Arctype_data);
		}
		 
		 
		save_log('修改'.get_table_comment(get_thinkphp_tablie('Archives'))."数据ID=".$archives_id,1);
		$this->success('成功',U('Archives/Archives/index',array('channeltype_id'=>$this->channeltype_id)));
	}
	
	//假删除
	function delete(){
		$list_id = I('request.id');
		$data['is_delete'] = 1;
		M('Archives')->where('id  in ('.$list_id.')')->save($data);
		$this->success('成功',AJAX);
		}
	
	
	//恢复删除
	function re_delete(){
		$list_id = I('request.id');
		$data['is_delete'] = 0;
		M('Archives')->where('id in ('.$list_id.')')->save($data);
		$this->success('成功',AJAX);
		}
	
	
	
	
	
	
	
	
	
}
?>