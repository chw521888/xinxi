<?php
namespace Admin\Controller;
use Think\Controller;

class AdminPassController extends CategoryController{
	function edit_password(){
	 $this->display();	
	}
	
	function update_password(){
		$login_pass_old=I('post.login_pass_old','');
		$login_pass    =I('post.login_pass','');
		$login_pass2   =I('post.login_pass2','');
		
		if($login_pass!=$login_pass2){$this->error("重复密码不一致",AJAX);}
		
		$adm_session = es_session_get(md5(conf("AUTH_KEY")));
		$admin_info=M('Admin')->getById($adm_session['user_id']);
		if($admin_info['login_pass']!=pass_encrypt($login_pass_old)){$this->error("旧密码不正确",AJAX);}
		$data['login_pass']=pass_encrypt($login_pass);
		M('Admin')->where("id='".$adm_session['user_id']."'")->save($data);
		
		$this->success('成功',AJAX);
		//if()
	}
}
?>