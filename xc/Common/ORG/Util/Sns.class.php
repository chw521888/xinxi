<?php


/*

	$sns  = new \Common\ORG\Util\Sns();					// 实例化上传类

	$mobile = "18688888888";  //接收短信人的手机号
	$content = "短信内容";
	$sns->sendsns($mobile,$content);


*/
namespace Common\ORG\Util;



class Sns{

        /* Main Function */



        function sendsns($mobile,$content)

        {



				$post_data = array();

				$post_data['userid'] = C('SNS_ORG_ID');//企业ID

				$post_data['password'] = C('SNS_ORG_PASS');//密码

				$post_data['account'] =C('SNS_ORG_USER');//账号

				$post_data['content'] = $content; 

				$post_data['mobile'] = $mobile;//手机号

				$post_data['sendtime'] = C('SNS_ORG_TIME'); //不定时发送，值为''，定时发送，输入格式YYYYMMDDHHmmss的日期值

				$url='http://121.52.209.124:8888/sms.aspx?action=send';

				$o='';

				foreach ($post_data as $k=>$v)

				{

				   $o.="$k=".urlencode($v).'&';

				}

				$post_data=substr($o,0,-1);

				$ch = curl_init();

				curl_setopt($ch, CURLOPT_POST, 1);

				curl_setopt($ch, CURLOPT_HEADER, 0);

				curl_setopt($ch, CURLOPT_URL,$url);

				curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

				//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //如果需要将结果直接返回到变量里，那加上这句。

				$result = curl_exec($ch);





                return $result;







        }



























}







?>