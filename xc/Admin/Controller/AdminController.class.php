<?php
namespace Admin\Controller;
use Think\Controller;

class AdminController extends CommonController{
	
	function edit_password(){
		
		$this->display();
	}
	
	
	function add(){
		$this->get_category_list();
		$this->assign("auth_group_array",make_two_array(D("AuthGroup")->select(),'id','title'));
		$this->display();
	}
	
	
	
	function edit(){
	    $info_id=$this->get_id();
		$info=D(CONTROLLER_NAME)->getById($info_id);
        //var_dump($info);
		$this->assign("info",$info);
		$this->get_category_list();
		$this->assign("auth_group_array",make_two_array(D("AuthGroup")->select(),'id','title'));
		$this->display();
	}
	
	
	
	function insert(){
		$login_name=I('post.login_name','');
		$login_pass=I('post.login_pass','');
		$login_pass2=I('post.login_pass2','');
		if($login_name==''){$this->error('用户名不能为空！',AJAX);}
		if($login_pass==''){$this->error('密码不能为空！',AJAX);}
		if($login_pass!=$login_pass2){$this->error('重复密码不一致！',AJAX);}
		$data = M(CONTROLLER_NAME)->create();
		$data['login_pass']=pass_encrypt($data['login_pass']);
		$data['time']=time();
		
		$this->before_check_empty(array('login_name'=>'姓名'),$data);
		$list=M(CONTROLLER_NAME)->add($data);
		if (false !== $list){
			save_log('添加'.get_table_comment(get_thinkphp_tablie(CONTROLLER_NAME))."数据ID=".$list,1);
			$data_role=array(
			     'uid'      =>  $list,
			     'group_id' =>  $data['auth_group_id']
			);
		    M("AuthGroupAccess")->add($data_role);
			$this->success('成功',AJAX);
		}else{
			$this->error('失败',AJAX);
		}
	}
	
	  //修改会员操作
   public function update(){
	   $id=I('request.id');
	   $info_id=$this->get_id();
	   $data = M(CONTROLLER_NAME)->create();
	   
		$this->before_check_empty(array('login_name'=>'用户名'),$data);
		 
		  if($data['login_pass']!=""){
		    if($data['login_pass']!=$_POST['login_pass2']){$this->error('重复密码不一致',AJAX);}	
		    $data['login_pass']=pass_encrypt($data['login_pass']);
		  }else{
			unset($data['login_pass']);
		  }
		 $data['is_effect'] = (int)$data['is_effect'];
		$list=M(CONTROLLER_NAME)->where('id='.$id)->save($data);
		
		 M("AuthGroupAccess")->where("uid='".$data['id']."'")->save(array('group_id' =>  $data['auth_group_id']));
		$this->success('成功',AJAX);
   }
	
		
		
	
    //用户组列表
    function index_auth_group(){
		$this->_list(D('AuthGroup'));
		$this->display();
	}
	
	
	//管理员分组
	function add_auth_group(){
		
		$auth_rule_list=D("AuthRule")->order('sort asc')->select();
		$this->assign("auth_rule_list",$auth_rule_list);
		$this->display();
	}
	
	
	//插入分组
	function insert_auth_group(){
		$m_mauth_group=M("AuthGroup");
		$data=$m_mauth_group->create();
		if($data['title']==""){$this->error("分组名称不能为空!",AJAX);}
		$rules_array=I('post.rules');
		if(is_array($rules_array))$data['rules']=implode(',',$rules_array);
		$data['status']=1;
		$m_mauth_group->add($data);
		$this->success('成功',AJAX);
	}
	
	
	
	//修改分组
	function edit_auth_group(){
	    $id=$this->get_id('id',"AuthGroup");
		$info=D("AuthGroup")->getById($id);
		
		//$info['rules_array']=array();
		$info['rules_array']=explode(',',$info['rules']);
		
		$auth_rule_list=D("AuthRule")->order('sort asc')->select();
		$this->assign("auth_rule_list",$auth_rule_list);
		
		$this->assign("info",$info);
		$this->display();
	}
	
	
	
	//修改分组操作
	function update_auth_group(){
	    $id=I('request.id');
		$m_mauth_group=M("AuthGroup");
		$data=$m_mauth_group->create();
		if($data['title']==""){$this->error("分组名称不能为空!",AJAX);}
		$rules_array=I('post.rules');
		if(is_array($rules_array))$data['rules']=implode(',',$rules_array);
		$data['status']=1;
		$m_mauth_group->where("id=".$id)->save($data);
		$this->success('成功',AJAX);
		//$info=D("AuthGroup")->getById($id);
	}
	//删除
	public function foreverdelete(){
		$category_name=$this->getActionName();
		$department_id=I('request.id');
		if($department_id==""){$this->error('参数错误!',AJAX);}
		M('AuthGroup')->where("id in (".$department_id.")")->delete();
		$this->success('成功',AJAX);
	}
	
}
?>