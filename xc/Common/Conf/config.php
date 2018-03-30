<?php
if (!defined('THINK_PATH')) exit();
if(file_exists(APP_ROOT_PATH.'system/config.php'))
$sys_config	=	require APP_ROOT_PATH.'system/config.php';
define("AJAX", intval($_REQUEST['ajax'])); 

$array = array(
    'TMPL_ADMIN_HEAD'     => 'xc/Admin/View/Public/page_head.html',
	'TOKEN_ON'	          => 0,
    'DEFAULT_THEME'       => '', //后台模板
	'LANG_SWITCH_ON'      => true,        //开启多语言支持开关
	'LANG_LIST'           => 'en-us', // 允许切换的语言列表 用逗号分隔
    'DEFAULT_LANG'        => 'en-us',    // 默认语言
    'LANG_AUTO_DETECT'    => true,    // 自动侦测语言
	'URL_MODEL'		      => '0',     //后台URL模式为原始模式
	'SHOW_PAGE_TRACE'     =>true,
	

	'TMPL_ACTION_ERROR'     => 'Common@Public:error', // 默认错误跳转对应的模板文件
	'TMPL_ACTION_SUCCESS'   => 'Common@Public:success', // 默认成功跳转对应的模板文件
	//'TMPL_TRACE_FILE'     => BASE_PATH.'/global/PageTrace.tpl.php',// 页面Trace的模板
	
	'PAGE_ROLLPAGE'         => 5,      // 分页显示页数
	'PAGE_LISTROWS'         => 30,     // 分页每页显示记录数
	//后台自动载入的类库
	'APP_AUTOLOAD_PATH'     => 'Think.Util.,@.COM.',// __autoLoad 机制额外检测路径设置,注意搜索顺序
	
	//Auth配置
   'AUTH_CONFIG'=>array(
        'AUTH_ON'           => true, //认证开关
        'AUTH_TYPE'         => 1, // 认证方式，1为时时认证；2为登录认证。
        'AUTH_GROUP'        => 'jc_auth_group', //用户组数据表名
        'AUTH_GROUP_ACCESS' => 'jc_auth_group_access', //用户组明细表
        'AUTH_RULE'         => 'jc_auth_rule', //权限规则表
        'AUTH_USER'         => 'admin'//用户信息表
    ),
	
	
);
if(file_exists(APP_ROOT_PATH.'system/config.php'))
$config = array_merge($sys_config,$array);
else
$config = $array;

return $config;
?>