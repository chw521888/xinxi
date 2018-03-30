<?php
namespace Admin\Controller;
use Think\Controller;



class IndexController extends CommonController{

	//首页
    public function index(){
		$adm_session = es_session_get(md5(conf("AUTH_KEY")));
		$user_info=M('Admin')->getById($adm_session['user_id']);
		$this->assign("user_info",$user_info);
		
		
		
		//获得文章模型
		$arctype_channel_list=D('ArctypeChannel')->where("id > 1")->select();
		$this->assign("arctype_channel_list",$arctype_channel_list);
		
		
		
		$this->display();
    }
    

    //框架头
	public function top()
	{
		$this->display();
	}
	
	
	//框架左侧
	public function left()
	{
		/****/
		$this->display();
	}
	
	
	
	//默认框架主区域
	public function main(){
				
		$this->display();
	}
	
		
	//底部
	public function footer()
	{
		$this->display();
	}
	
	
	
	//修改管理员密码
	public function change_password(){
	
	}	
	
	
	
	public function do_change_password(){
	
	}
	
		
	
	public function page(){
        $user_employers=M('User')->where('type=0')->count('*');
        $user_service_provider=M('User')->where('type=1')->count('*');
        $task_employers=M('TaskEmployers')->count('*');
        $task=M('Task')->count('*');
		
		$user_0_list=M('User')->where("type=0")->order("id desc")->limit(0,10)->select();
		$user_1_list=M('User')->where("type=1")->order("id desc")->limit(0,10)->select();
		
		
		$task_employers_list=M('TaskEmployers')->order("id desc")->limit(0,10)->select();
		$task_list=M('Task')->order("id desc")->limit(0,10)->select();
		
		$this->assign("user_employers",$user_employers);
		$this->assign("user_service_provider",$user_service_provider);
		$this->assign("task_employers",$task_employers);
		$this->assign("task",$task);
		$this->assign("user_0_list",$user_0_list);
		$this->assign("user_1_list",$user_1_list);
		$this->assign("task_employers_list",$task_employers_list);
		$this->assign("task_list",$task_list);
        $this->display();
	}
	
	

	
	
	//设置字段修改
	public function  set_field_post(){
		$edit_array[$_REQUEST['field']]=$_REQUEST['value'];
	    $upl=M(I('request.module_name'))->where("id='".$_REQUEST['id']."'")->save($edit_array);
	    if(false!==$upl){
		     $this->success(L("INSERT_SUCCESS"),AJAX);
		}else{
			$this->error('参数错误',AJAX);
		}
	}
	
	
	//清除缓存
	function clear_cache(){
			
		sp_clear_cache();
		$this->display();
	}
	
	
	
	
}
?>