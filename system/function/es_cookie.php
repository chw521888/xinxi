<?php



    // 判断Cookie是否存在
    function es_cookie_is_set($name) {
        return isset($_COOKIE[$name]);
    }




    // 获取某个Cookie值
    function es_cookie_get($name) {
    	if(isset($_COOKIE[$name]))
        $value   = $_COOKIE[$name];
        else
        $value = null;
        return $value;
    }

    // 设置某个Cookie值
    function es_cookie_set($name,$value,$expire='',$path='',$domain='') {   
    	$path = app_conf("COOKIE_PATH");
     	$domain = app_conf("DOMAIN_ROOT");
        $expire =   !empty($expire)?get_gmtime()+$expire:0;
        setcookie($name, $value,$expire,$path,$domain);
    }

    // 删除某个Cookie值
    function es_cookie_delete($name) {
        es_cookie::set($name,'',0);
    }

    // 清空Cookie值
    function es_cookie_clear() {
        unset($_COOKIE);
    }
?>