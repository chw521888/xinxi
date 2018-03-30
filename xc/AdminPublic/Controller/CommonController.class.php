<?php
namespace AdminPublic\Controller;
use Think\Controller;
use Think\UploadFile;

class CommonController extends AuthController{
	
	//公共添加页面
	public function add(){
		$this->display();
	}
	
	//公共修改
	public function edit(){
	    $info_id=$this->get_id();
		$info=D(CONTROLLER_NAME)->getById($info_id);
		
		$this->assign("info",$info);
		$this->display();
	}	
	
	
	
	//检查是否为空
	function before_check_empty($msg_array=array(),$data=array()){
		if(is_array($msg_array) and count($msg_array)>0){
		  foreach($msg_array as $key=>$ma){
			 if(!$data[$key] or $data[$key]==""){$this->error($ma.'不能为空',AJAX);} 
		  }
		}
	}
	
	
	
	//检查是否为空
	function before_create($date_model){
		$data = $date_model->create();
		if($data==false){$this->error($date_model->getError(),AJAX);}else{
		  return $data;
		}
	}
	
	
	
	
	
	//公共插入操作
	public function insert($msg_array=array(),$data=array()){
		if(is_array($data) and count($data)>0){
		
		}else{
			$model =M(CONTROLLER_NAME);
	        $data = $this->before_create($model);
		}
		$this->before_check_empty($msg_array,$data);
		$list=M(CONTROLLER_NAME)->add($data);
		if (false !== $list){
			save_log('添加'.get_table_comment(get_thinkphp_tablie(CONTROLLER_NAME))."数据ID=".$list,1);
			$this->success('成功',AJAX);
		}else{
			$this->error('失败',AJAX);
		}
	}
	
	
    //公共更新操作
	public function update($msg_array=array(),$data=array()){
	   $info_id=$this->get_id();
	   if(is_array($data) and count($data)>0){}else{
			$model =M(CONTROLLER_NAME);
	        $data = $this->before_create($model);
		}
	   $this->before_check_empty($msg_array,$data);
	   $list=M(CONTROLLER_NAME)->save($data);
	   if($list!=false){
			save_log('修改'.get_table_comment(get_thinkphp_tablie(CONTROLLER_NAME))."数据ID=".$info_id,1);
	   }
	   $this->success('成功',AJAX);
	}
	
	
	
	
	
	
		//假删除
    public function delete($CONTROLLER_NAME=''){
		if($CONTROLLER_NAME==''){$CONTROLLER_NAME=CONTROLLER_NAME;}
	    $info_id=I('request.id','');
		if($info_id==""){$this->error("参数错误!",AJAX);}		
	    M($CONTROLLER_NAME)->where("id in (".$info_id.")")->save(array('is_delete'=>1));
		save_log('删除'.get_table_comment(get_thinkphp_tablie(CONTROLLER_NAME))."数据ID=".$info_id,1);
		//M(CONTROLLER_NAME)->where("id='".$get_id."'")->delete();
		$this->success('成功',AJAX);
	}

	
	
	
	
	//永久删除
	public function foreverdelete($CONTROLLER_NAME=''){
		$POST_CONTROLLER_NAME = I('request.controller_name');
		
		if($CONTROLLER_NAME==''){$CONTROLLER_NAME=CONTROLLER_NAME;}
		if($POST_CONTROLLER_NAME!=''){$CONTROLLER_NAME=$POST_CONTROLLER_NAME;}
		
	    $info_id=I('request.id','');
		if($info_id==""){$this->error($info_id,AJAX);}
		save_log('永久删除'.get_table_comment(get_thinkphp_tablie(CONTROLLER_NAME))."数据ID=".$info_id,1);
		M($CONTROLLER_NAME)->where("id in (".$info_id.")")->delete();
		$this->success('成功',AJAX);
	}
	
	
	
	
	
	
	//全局更新排序
	public function update_sort($CONTROLLER_NAME=''){
		$table_name=I('post.table_name');
		if($CONTROLLER_NAME==''){$CONTROLLER_NAME=$table_name;}
		if($CONTROLLER_NAME==''){$CONTROLLER_NAME=CONTROLLER_NAME;}
		$model= M($CONTROLLER_NAME);
        $pk =$model->getPk(); //获取主键名称
		$ids = $_POST['sort'];
        foreach ($ids as $key => $r) {
            $data['sort'] = $r;
            $model->where(array($pk => $key))->save($data);
        }
		$this->success('成功',AJAX);
	}
	
	
	
		
	//审核操作
	public function do_check_effect(){
	   $id = trim($_REQUEST['id']);
	   $effect = trim($_REQUEST['effect']);
	   $actionname = trim($_REQUEST['module_name']);
	   
	   if($id>0 and $actionname!='' and in_array($effect,array(0,1))){
		   if($effect==0){$act_effect=1;}else{$act_effect=0;}
		   M($actionname)->where("id='".$id."'")->save(array('is_effect'=>$act_effect));
		   $this->success('',1);
	   }else{
		   $this->error('参数错误',1);
	   }
	}


	//街道比赛晋级操作
	public function show_is_win2(){
		$id = trim($_REQUEST['id']);
		$is_win = trim($_REQUEST['is_win']);

		$show                  = M('Show')->where('id='.$id)->find();
		$contingent_id         = $show['contingent_id'];
		$location_id           = $show['location_id'];
		$location_list         = M('Location')->where('id='.$location_id)->find();
		$ids                   = explode(',',$location_list['win_contingent_id']);

		//if($location_list['win_contingent_id'] == ''){$ids[0] = $contingent_id;}else{$ids[1] = $contingent_id;}
		$ids[] = $contingent_id;
		M('Location')->where('id='.$location_id)->save(array('win_contingent_id'=>implode(',',$ids)));
		M('Show')->where("id=".$id)->save(array('is_win'=>'1'));
		$this->success('',AJAX);
	}

	//城市比赛晋级操作
	public function show_is_win1(){
		$id = trim($_REQUEST['id']);
		$is_win = trim($_REQUEST['is_win']);
		$actionname = 'Show';
		$show                  = M('Show')->where('id='.$id)->find();
		$contingent_id         = $show['contingent_id'];
		$location_id           = $show['location_id'];
		$location_list         = M('Location')->where('id='.$location_id)->find();
		$ids                   = explode(',',$location_list['win_contingent_id']);
		$ids[] = $contingent_id;
		M('Location')->where('id='.$location_id)->save(array('win_contingent_id'=>implode(',',$ids)));
		M('Show')->where("id=".$id)->save(array('is_win'=>'1'));
		$this->success('',AJAX);
	}


}