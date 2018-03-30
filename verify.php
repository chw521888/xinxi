<?php 

if(!defined('APP_ROOT_PATH')) 
define('APP_ROOT_PATH', str_replace('verify.php', '', str_replace('\\', '/', __FILE__)));
require APP_ROOT_PATH."system/function/es_session.php";
es_session_start();
require APP_ROOT_PATH."system/function/es_image.php";
es_image::buildImageVerify(4,1,'gif',129,43);
?>