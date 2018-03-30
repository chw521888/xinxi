<?php

//获取GMTime
function get_gmtime()
{
	return (time() - date('Z'));
}





function to_date($utc_time, $format = 'Y-m-d H:i:s') {
	if (empty ( $utc_time )) {
		return '';
	}
	$timezone = intval(app_conf('TIME_ZONE'));
	$time = $utc_time + $timezone * 3600; 
	return date ($format, $time );
}






function to_timespan($str, $format = 'Y-m-d H:i:s')
{
	$timezone = intval(app_conf('TIME_ZONE'));
	//$timezone = 8; 
	$time = intval(strtotime($str));
	if($time!=0)
	$time = $time - $timezone * 3600;
    return $time;
}




//获得时间
function turn_time($t,$d=0){
	if($d==0){return date('Y-m-d H:i:s',$t);}
	else if($d==1){return date('Y-m-d',$t);}
	else{return $t;}
}
