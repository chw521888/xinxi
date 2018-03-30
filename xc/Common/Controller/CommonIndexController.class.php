<?php
namespace Common\Controller;
use Think\Controller;
class CommonIndexController extends CommonController{
   
   
    public function __construct()
	{
		parent::__construct();
		if(isMobile()==true){
			define('TMPL_PATH','./template_m/');
			//登录判断
			//$this->user_id=1;
			$this->user_id=$this->check_user_id();
			}else{
		     define('TMPL_PATH','./template/');//重新定义前台模板路径
		     //define('DEFAULT_THEME','/Index/');//重新定义前台模板路径
		}
	    C('listRows',10);
		  //echo APP_ROOT_PATH;
		$city_list = M('Location')->where('location_id=0 and id not in (68,69)')->select();
		$this->assign('city_list',$city_list);

		$str = file_get_contents("data.php",true);
		$str_d = date('d');
		if($str != $str_d){
			$data['vote']  = 2;
			$data['vote1'] = 0;
			$data['vote2'] = 0;
			$data['e_vote']  = 2;
			$data['e_vote1'] = 0;
			$data['e_vote2'] = 0;
			M('User')->where('1')->save($data);
			file_put_contents("data.php",$str_d);
		}
		$user_info = M('User')->where('id='.$this->user_id)->find();
		$this->assign('user_info',$user_info);
		include(APP_ROOT_PATH.'system/function/function_template.php');
		
	}


	//检查用户
	function check_user_id(){
		$user_id = session('WECHAT_USER_ID');	
		if($user_id>0){
			return $user_id;
		   }else{
			session('GO_BACK_URL',$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
			$this->redirect('Index/Wechat/get_user_info');
		    
		}
	}
}
