<?php
namespace AdminPublic\Controller;
use Think\Controller;


//后台验证的基础类
class AuthController extends BaseController{

	public function __construct()
	{
		parent::__construct();
		$this->admin_info = $this->check_auth();
		$this->model=D(CONTROLLER_NAME);		
	}
	


	/**
	 * 验证检限
	 * 已登录时验证用户权限, Index模块下的所有函数无需权限验证
	 * 未登录时跳转登录
	 */
	private function check_auth(){
		
		//登录成功		
		if(intval(C("EXPIRED_TIME"))>0&&es_session_is_expired())
		{
			es_session_delete(md5(C("AUTH_KEY")));
			es_session_delete("expire");
		}
		
		//管理员的SESSION
		$adm_session = es_session_get(md5(C("AUTH_KEY")));		
		
		$adm_name = $adm_session['login_name'];
		$adm_id = intval($adm_session['user_id']);
		$ajax = intval($_REQUEST['ajax']);
		$is_auth = 0;
		if($adm_id == 0&&$is_auth==0)
		{			
			if($ajax == 0)
			//echo U("Admin/Public/login");
			$this->redirect("Admin/Public/login");
			else
			$this->error(L("NO_LOGIN"),$ajax);	
		}
		/**
		 $ROLE_LIST=C('ROLE_LIST');
		 if($ROLE_LIST[CONTROLLER_NAME]!="" and $adm_name!=C('DEFAULT_ADMIN')){
		     $my_role_array=F('role_group_'.$adm_session['category']);
			 $this->assign("jumpUrl",u("Index/page"));
			 if(!is_array($my_role_array) or !in_array(CONTROLLER_NAME,$my_role_array)){$this->error("您没有权限操作此页面",AJAX);}
		 }
		 //$role_group_list = M('RoleGroup')->;CONTROLLER_NAME
		**/
		
		return $adm_session;
		
	}
	

}
?>