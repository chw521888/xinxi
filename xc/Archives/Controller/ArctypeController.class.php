<?php
namespace Archives\Controller;
use Think\Controller;

class ArctypeController extends \AdminPublic\Controller\CategoryController{
	
	//添加页面
	function add(){
		
		$arctype_list=D('Arctype')->get_recursive_list("",0);//获得分类
		$arctype_list_array=array(0=>"顶级栏目")+make_two_array($arctype_list,'id','full_typename');
		
		$model_list=D('ArctypeChannel')->order("id asc")->select();
		
		$temp_list=array();
		if(is_array($model_list)){
		  foreach($model_list as $ml){
			$temp_list[$ml['id']]=array($ml['template_index'],$ml['template_list'],$ml['template_article']);   
		  }
		}
		
		
		$this->assign("temp_list",$temp_list);
		$this->assign("model_list",make_two_array($model_list));
		$this->assign("arctype_list",$arctype_list_array);
		parent::add();
    }
	
	//修改页面
	function edit(){
		$url = I('request.url');
		$id = I('request.id');
		$arctype_list=D('Arctype')->get_recursive_list("",0);//获得分类
		$arctype_list_array=array(0=>"顶级栏目")+make_two_array($arctype_list,'id','full_typename');
		
		$model_list=D('ArctypeChannel')->order("id asc")->select();
		
		$temp_list=array();
		if(is_array($model_list)){
		  foreach($model_list as $ml){
			$temp_list[$ml['id']]=array($ml['template_index'],$ml['template_list'],$ml['template_article']);   
		  }
		}
		$info = D('Arctype')->where('id = '.$id)->find();
		
		//dump($url);
		$this->assign('url',$url);
		$this->assign('info',$info);
		$this->assign("temp_list",$temp_list);
		$this->assign("model_list",make_two_array($model_list));
		$this->assign("arctype_list",$arctype_list_array);
		parent::edit();
		}
	
	
	//插入操作
	function insert(){
		$data=M("Arctype")->create();
		//处理多图上传
		$pic_list_array=array();
		for($i=0;$i<count($_POST['pic_list_url']);$i++){
		  	$pic_list_array[$i]['url']=$_POST['pic_list_url'][$i];
		  	$pic_list_array[$i]['name']=$_POST['pic_list_name'][$i];
		}
		$data['pic_list'] = json_encode($pic_list_array);
		
		 parent::insert(array("typename"=>"栏目名称","channeltype_id"=>"模型"),$data);
	}
	
	//修改操作
	function update(){
		$back_url=I("request.back_url");
		$data=M("Arctype")->create();
		//处理多图上传
		$pic_list_array=array();
		for($i=0;$i<count($_POST['pic_list_url']);$i++){
		  	$pic_list_array[$i]['url']=$_POST['pic_list_url'][$i];
		  	$pic_list_array[$i]['name']=$_POST['pic_list_name'][$i];
		}
		$data['pic_list'] = json_encode($pic_list_array);
		
		$info_id=$this->get_id();
	   $this->before_check_empty(array("typename"=>"栏目名称","channeltype_id"=>"模型"),$data);
	   $list=M("Arctype")->save($data);
	   if($list!=false){
			save_log('修改'.get_table_comment(get_thinkphp_tablie(CONTROLLER_NAME))."数据ID=".$info_id,1);
	   }
	   
	   if($back_url==""){$back_url=AJAX;}
	   //echo $back_url;
	  
		$this->assign('jumpUrl',($back_url));
	   $this->success('成功',$back_url);
		 //parent::update(array("typename"=>"栏目名称","channeltype_id"=>"模型"),$data);
	}
	
	//删除操作
	function foreverdelete(){
		$id = I('request.id');
		$arctype_list   = D('Arctype')->where('reid = '.$id)->select();
		$archives_list  = D('Archives')->where('is_delete = 0 and arctype_id = '.$id)->select();
		if(count($arctype_list) < 1 && count($archives_list) < 1){
					$arctype_id = M('Arctype')->where("id=".$id)->delete();
					save_log('永久删除'.get_table_comment(get_thinkphp_tablie('Arctype'))."数据ID=".$arctype_id,1);
	    }else{
				$this->error('请先删除下面子栏目',AJAX);
		}
		$this->success('成功',AJAX);
		
	}
	
	
	//首页
	function index(){
		$list=D('Arctype')->get_recursive_list("",0);
		$this->assign("list",$list);
		$this->display();
	}
	
	
	
	
}
?>