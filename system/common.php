<?php

if(!defined('APP_ROOT_PATH')) 
define('APP_ROOT_PATH', str_replace('system/common.php', '', str_replace('\\', '/', __FILE__)));


//前后台加载的函数库
require_once APP_ROOT_PATH.'system/system_init.php';




define("NOW_TIME",get_gmtime());
?>