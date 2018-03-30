<?php
return array(


	'APP_NAME'	        =>	 'JCCMS',
	'APP_SUB_VER'	    =>	 1.000,


	
	'AUTH_KEY'          =>   "ADMIN_XC",
	'REWRITER_DEPART'   =>   "-",
	'DEBUG'             =>   true,
	'SHOW_PAGE_TRACE'   =>   false,
	'SITE_DOMAIN'       =>   "",
	'IS_NO'             =>   array('否','是'),
	
	
	/** 字段类型设置**/
	'FEILD_ADD_ARRAY'      =>   array('文本框','多行文本框','在线编辑器','数字','日期','日期时间','下拉框','radio选项卡','上传图片','上传文件'),
	'FEILD_ADD_CHAR'       =>   array('varchar','varchar','text','int','date','datetime','varchar','varchar','varchar','varchar'),
	'FEILD_ADD_CHAR_NUM'   =>   array(100,255,'',11,'','',100,100,100,100),
	
	
	
	'ARCHIVES_ATT_ARRAY'   =>   array('a'=>'图片','b'=>'推荐首页','c'=>'推荐列表页'),
	
	
	
	'ARCTYPE_PART_TYPE'    =>   array('-1'=>'外部链接',0=>'最终列表栏目','1'=>'栏目封面'),
	
	
	'FOLDER_TEMPLET'                  =>   '/template/',         //前台页面模板所在文件夹
	'FOLDER_TEMPLET_ARCHIVES_INDEX'   =>   'Archives/index/',   //文章封面所在文件夹，相对于前台页面模板地址
	'FOLDER_TEMPLET_ARCHIVES_LIST'    =>   'Archives/list/',    //文章列表页所在文件夹，相对于前台页面模板地
	'FOLDER_TEMPLET_ARCHIVES_ARTICLE' =>   'Archives/article/', //文章文章详细页所在文件夹，相对于前台页面模板地
	
	
	
    'INITIALIZE_MODEL'   =>   2,//添加栏目默认模型
	'SYSTEM_DEBUG'       =>   true,//是否为系统调试模
	'HAVE_LIST_INDEX'    =>   true,//是否有列表页封面模板

	
	
    //
	'LOCALTION_STATUS'   =>  array('未开始','正在进行','已经结束'),
	
	'SHOW_STAGE'=>array('全国比赛','城市比赛','街道比赛'),
	
	'IS_WIN'=>array('--','晋级'),
	
	'LOCATION_NEWS'=>array(
							'1'=>'16',
							'3'=>'17',
							'4'=>'18',
							'5'=>'19',
							'6'=>'20',
							'7'=>'21',
							'8'=>'22',
							'10'=>'23',
							'11'=>'24',
							'12'=>'25',
							),
	'REVIEW_TYPE'   =>array(1=>'2016届',2=>'2017届'),
	'POSITION_TYPE'	=>array(1=>'第一名',2=>'第二名',3=>'第三名',4=>'优秀奖'),
	//'LANMU_TYPE'	=>array(1=>'社区推荐赛',2=>'街道赛',3=>'市级赛',4=>'个人秀'),
	'LANMU_TYPE'	=>array(1=>'社区推荐赛'),
	//'TYPE'			=>array(1=>'花絮',2=>'照片'),
	'TYPE'			=>array(2=>'照片'),






);
?>