<?php
namespace Admin\Controller;
use Think\Controller;
//开放的公共类，不需RABC验证
class PublicController extends \AdminPublic\Controller\BaseController{
	public function login()
	{		
	//echo L("ADM_NAME_ERROR");exit();
		//验证是否已登录
		//管理员的SESSION
		$adm_session = es_session_get(md5(conf("AUTH_KEY")));
		$adm_name = $adm_session['adm_name'];
		$adm_id = intval($adm_session['adm_id']);
		if($adm_id != 0)
		{
			//已登录
			$this->redirect(u("Index/index"));			
		}
		else
		{
			$this->display();
		}
	}
	public function verify()
	{	
        Image::buildImageVerify(4,1);
    }
    
    //登录函数
    public function do_login()
    {		
    	$login_name = I('request.login_name','','trim'); 
    	$login_pass = I('request.login_pass','','pass_encrypt');
         
    	if($login_name == '' or $login_pass == ''){$this->error('用户名密码不能为空!',AJAX);}
        //if(es_session_get("verify")!= md5($_REQUEST['verify'])) {$this->error('验证码错误!',AJAX);}
		
		$condition['login_name'] = $login_name;
		$condition['is_effect'] = 1;
		$adm_data = M("Admin")->where($condition)->find();

		if($adm_data) //有用户名的用户
		{
			if($adm_data['login_pass']!=$login_pass)
			{
				save_log($login_name.'登陆错误',0); //记录密码登录错误的LOG
				$this->error('用户名或密码错误',AJAX);
			}
			else
			{
				//登录成功
				$adm_session['login_name'] = $adm_data['login_name'];
				$adm_session['user_id'] = $adm_data['id'];
				$adm_session['category'] = $adm_data['category'];
				
				
				es_session_set(md5(conf("AUTH_KEY")),$adm_session);
				
				//重新保存记录
				$adm_data['login_ip'] = get_client_ip();
				$adm_data['login_time'] = time();
				M("Admin")->save($adm_data);
				//save_log($adm_data['login_name'].L("LOGIN_SUCCESS"),1);
		         $this->assign("jumpUrl",u("index/index"));
				$this->success('登陆成功',U("index/index"));
			}
		}
		else
		{
			save_log($adm_name."用户名密码错误",0); //记录用户名登录错误的LOG
			$this->error("用户名密码错误",AJAX);
		}
    }
	
    //登出函数
	public function do_loginout()
	{
	//验证是否已登录
		//管理员的SESSION
		$adm_session = es_session_get(md5(conf("AUTH_KEY")));
		$adm_id = intval($adm_session['adm_id']);
		es_session_delete(md5(conf("AUTH_KEY")));
		if($adm_id == 0)
		{
			//已登录
			$this->redirect(U("Admin/Public/login"));			
		}
		else
		{
			$this->assign("jumpUrl",U("Admin/Public/login"));
			$this->assign("waitSecond",1);
			$this->success("退出成功");
		}
	}
}
?>