<?php
namespace Index\Controller;
use Think\Controller;
class WechatController extends Controller {

	
	//返回用户信息
	public function return_user_info(){
	   $share_id=I('request.state');
	   $url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=".C('WECHAT_APPID')."&secret=".C('WECHAT_APPSECRET')."&code=".$_REQUEST['code']."&grant_type=authorization_code";
	   $return_access_token=json_decode(file_get_contents($url),true);
	    $this->insert_user($return_access_token,0);
		
	}
	

	
	//获得用户信息跳转链接
	public function get_user_info(){
		$return_url=urlencode(str_replace(":80",'',"http://".$_SERVER['HTTP_HOST'].U('Index/Wechat/return_user_info')));
		$url="https://open.weixin.qq.com/connect/oauth2/authorize?appid=".C('WECHAT_APPID')."&redirect_uri=".$return_url."&response_type=code&scope=snsapi_base#wechat_redirect";
		
		redirect($url);
	}
	
	
	
	
	//获取扫码信息并插入
	public function return_scan_code_user_info(){
		  $url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=".C('WECHAT_APPID')."&secret=".C('WECHAT_APPSECRET')."&code=".$_REQUEST['code']."&grant_type=authorization_code";
	      $return_access_token=json_decode(file_get_contents($url),true);
		 
		  $this->insert_user($return_access_token,1);
       
	}
	
	
	//扫码获得用户信息
	public function scan_code_index(){
		$return_url=urlencode("http://".$_SERVER['HTTP_HOST'].U('Index/Wechat/return_scan_code_user_info'));
		$this->assign ('return_url', $return_url );
        $this->display();
	}
	
	
	
	
	
	//插入用户
	function insert_user($return_access_token,$type=0){
	  
	  $openid = $return_access_token['openid'];

	  $url="https://api.weixin.qq.com/sns/userinfo?access_token=".$return_access_token['access_token']."&openid=".$return_access_token['openid']."&lang=zh_CN";
       $return_info=json_decode(file_get_contents($url),true);

       $user_info=M('User')->field('id')->where("openid='".$openid."'")->find();
	   //获得用户信息
	   //$user_info=S('get_user_info_openid'.$openid);
	  //  if($user_info==false){
	  //    $user_info=M('User')->field('id')->where("openid='".$openid."'")->find();
		 // S('get_user_info_openid'.$openid,$user_info,C('CACHE_TIME'));
	  //  }
	   if($user_info['id'] > 0){
		   $user_id = $user_info['id'];
		   $data  = array(
						'user_chinese_name' => $return_info['nickname'],
						'user_pic'          => $return_info['headimgurl'],
			       );
			      $user_id=M('User')->where(array('id'=>$user_id))->save($data);
	   }else{
		       //插入用户
				$data      = array(
				'openid'            => $openid,
				'user_chinese_name' => $return_info['nickname'],
				'user_pic'          => $return_info['headimgurl'],
				'type'              => 0,
				'vote'              => 2,
				'time'              => time()
		       );
		      $user_id=M('User')->add($data);
		    }

       $_SESSION['WECHAT_USER_ID']=$user_id;

	   $GO_BACK_URL=session('GO_BACK_URL');
	   if($GO_BACK_URL!=""){
		   redirect($GO_BACK_URL);
	   }else{
		   $this->redirect('Index/index');  
	   }
	}
	
	
	public function scan_code_action(){ 
	}
	
	
}