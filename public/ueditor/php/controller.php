<?php
//header('Access-Control-Allow-Origin: http://www.baidu.com'); //设置http://www.baidu.com允许跨域访问
//header('Access-Control-Allow-Headers: X-Requested-With,X_Requested_With'); //设置允许的跨域header
date_default_timezone_set("Asia/chongqing");
error_reporting(E_ERROR);
header("Content-Type: text/html; charset=utf-8");

$CONFIG = json_decode(preg_replace("/\/\*[\s\S]+?\*\//", "", file_get_contents("config.json")), true);
$action = $_GET['action'];

$upload_type = $_GET['upload_type'];
$upload_path_son = $_GET['upload_path_son'];


$root_path=str_replace("/public/ueditor/php/controller.php",'',$_SERVER['SCRIPT_NAME']);
$upload_path=$root_path."/upload/";
if($upload_path_son!=""){$upload_path_son='/'.$upload_path_son;}//字文件夹

   //设置上传目录
   switch ($upload_type) {
	   case 'question':
	      $question_upload_path=$upload_type.$upload_path_son;
	      $question_upload_file=$question_upload_path.'/{yyyy}{mm}{dd}{time}{rand:2}';
		  
		  $CONFIG['imagePathFormat']=$question_upload_file;
		  $CONFIG['scrawlPathFormat']=$question_upload_file;
		  $CONFIG['snapscreenPathFormat']=$question_upload_file;
		  $CONFIG['catcherPathFormat']=$question_upload_file;
		  $CONFIG['videoPathFormat']=$question_upload_file;
		  $CONFIG['filePathFormat']=$question_upload_file;
		  $CONFIG['imageManagerListPath']=$question_upload_path;
		  $CONFIG['fileManagerListPath']=$question_upload_path;
	   break;
	   default:
	   break;
   }


$CONFIG['imagePathFormat']          =     $upload_path.$CONFIG['imagePathFormat'];//图片上传路径
$CONFIG['scrawlPathFormat']         =     $upload_path.$CONFIG['scrawlPathFormat'];//涂鸦图片上传路径
$CONFIG['snapscreenPathFormat']     =     $upload_path.$CONFIG['snapscreenPathFormat'];//截图图片上传路径
$CONFIG['catcherPathFormat']        =     $upload_path.$CONFIG['catcherPathFormat'];//抓取远程图片上传路径
$CONFIG['videoPathFormat']          =     $upload_path.$CONFIG['videoPathFormat'];//视频上传路
$CONFIG['filePathFormat']           =     $upload_path.$CONFIG['filePathFormat'];//文件上传路
$CONFIG['imageManagerListPath']     =     $upload_path.$CONFIG['imageManagerListPath'];//图片列目录
$CONFIG['fileManagerListPath']      =     $upload_path.$CONFIG['fileManagerListPath'];//文件列目录



switch ($action) {
    case 'config':
        $result =  json_encode($CONFIG);
        break;

    /* 上传图片 */
    case 'uploadimage':
    /* 上传涂鸦 */
    case 'uploadscrawl':
    /* 上传视频 */
    case 'uploadvideo':
    /* 上传文件 */
    case 'uploadfile':
        $result = include("action_upload.php");
        break;

    /* 列出图片 */
    case 'listimage':
        $result = include("action_list.php");
        break;
    /* 列出文件 */
    case 'listfile':
        $result = include("action_list.php");
        break;

    /* 抓取远程文件 */
    case 'catchimage':
        $result = include("action_crawler.php");
        break;

    default:
        $result = json_encode(array(
            'state'=> '请求地址出错'
        ));
        break;
}

/* 输出结果 */
if (isset($_GET["callback"])) {
    if (preg_match("/^[\w_]+$/", $_GET["callback"])) {
        echo htmlspecialchars($_GET["callback"]) . '(' . $result . ')';
    } else {
        echo json_encode(array(
            'state'=> 'callback参数不合法'
        ));
    }
} else {
    echo $result;
}