<?php


/**
//判断字符是否为UTF-8
@$string为字符串
**/
function is_u8($string)
{
	return preg_match('%^(?:
		 [\x09\x0A\x0D\x20-\x7E]            # ASCII
	   | [\xC2-\xDF][\x80-\xBF]             # non-overlong 2-byte
	   |  \xE0[\xA0-\xBF][\x80-\xBF]        # excluding overlongs
	   | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}  # straight 3-byte
	   |  \xED[\x80-\x9F][\x80-\xBF]        # excluding surrogates
	   |  \xF0[\x90-\xBF][\x80-\xBF]{2}     # planes 1-3
	   | [\xF1-\xF3][\x80-\xBF]{3}          # planes 4-15
	   |  \xF4[\x80-\x8F][\x80-\xBF]{2}     # plane 16
   )*$%xs', $string);
}





//utf8 字符串截取
function msubstr($str, $start=0, $length=15, $charset="utf-8", $suffix=true)
{
	if(function_exists("mb_substr"))
    {
        $slice =  mb_substr($str, $start, $length, $charset);
        if($suffix&$slice!=$str) return $slice."…";
    	return $slice;
    }
    elseif(function_exists('iconv_substr')) {
        return iconv_substr($str,$start,$length,$charset);
    }
    $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
    $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
    $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
    $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
    preg_match_all($re[$charset], $str, $match);
    $slice = join("",array_slice($match[0], $start, $length));
    if($suffix&&$slice!=$str) return $slice."…";
    return $slice;
}


//字符编码转换
if(!function_exists("iconv"))
{	
	function iconv($in_charset,$out_charset,$str)
	{
		require 'libs/iconv.php';
		$chinese = new Chinese();
		return $chinese->Convert($in_charset,$out_charset,$str);
	}
}

//JSON兼容
if(!function_exists("json_encode"))
{	
	function json_encode($data)
	{
		require_once 'libs/json.php';
		$JSON = new JSON();
		return $JSON->encode($data);
	}
}
if(!function_exists("json_decode"))
{	
	function json_decode($data)
	{
		require_once 'libs/json.php';
		$JSON = new JSON();
		return $JSON->decode($data,1);
	}
}






// 自动转换字符集 支持数组转换
function auto_charset($fContents,$from,$to){
    $from   =  strtoupper($from)=='UTF8'? 'utf-8':$from;
    $to       =  strtoupper($to)=='UTF8'? 'utf-8':$to;
    if( strtoupper($from) === strtoupper($to) || empty($fContents) || (is_scalar($fContents) && !is_string($fContents)) ){
        //如果编码相同或者非字符串标量则不转换
        return $fContents;
    }
    if(is_string($fContents) ) {
        if(function_exists('mb_convert_encoding')){
            return mb_convert_encoding ($fContents, $to, $from);
        }elseif(function_exists('iconv')){
            return iconv($from,$to,$fContents);
        }else{
            return $fContents;
        }
    }
    elseif(is_array($fContents)){
        foreach ( $fContents as $key => $val ) {
            $_key =     auto_charset($key,$from,$to);
            $fContents[$_key] = auto_charset($val,$from,$to);
            if($key != $_key )
                unset($fContents[$key]);
        }
        return $fContents;
    }
    else{
        return $fContents;
    }
}



//去除css
function quchu_css($jianjies){
      $jianjies = preg_replace( "@<script(.*?)</script>@is", "", $jianjies );
      $jianjies = preg_replace( "@<iframe(.*?)</iframe>@is", "", $jianjies );
      $jianjies = preg_replace( "@<style(.*?)</style>@is", "", $jianjies );
      $jianjies = preg_replace( "@<(.*?)>@is", "", $jianjies );
      return $jianjies;
}







//截取字符
function getstr($string, $length,$jiewei='..',$encoding  = 'utf-8') {
   $string = trim($string);
   
    if($length && strlen($string) > $length) {
        $wordscut = '';
         if(strtolower($encoding) == 'utf-8') {
           $n = 0;
             $tn = 0;
             $noc = 0;
             while ($n < strlen($string)) {
                 $t = ord($string[$n]);
                if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
                     $tn = 1;
                    $n++;
                    $noc++;
                } elseif(194 <= $t && $t <= 223) {
                     $tn = 2;
                     $n += 2;
                    $noc += 2;
                } elseif(224 <= $t && $t < 239) {
                    $tn = 3;
                    $n += 3;
                     $noc += 2;
                } elseif(240 <= $t && $t <= 247) {
                     $tn = 4;
                    $n += 4;
                     $noc += 2;
                 } elseif(248 <= $t && $t <= 251) {
                     $tn = 5;
                     $n += 5;
                    $noc += 2;
                } elseif($t == 252 || $t == 253) {
                    $tn = 6;
                    $n += 6;
                    $noc += 2;
                } else {
                    $n++;
                }
                 if ($noc >= $length) {
                    break;
                 }
            }
             if ($noc > $length) {
              $n -= $tn;
           }
           $wordscut = substr($string, 0, $n);
        } else {
            for($i = 0; $i < $length - 1; $i++) {
                if(ord($string[$i]) > 127) {
                    $wordscut .= $string[$i].$string[$i + 1];
                   $i++;
               } else {
                   $wordscut .= $string[$i];
              }
           }
      }
       $string = $wordscut.$jiewei;
    }
   return trim($string);
 }
 
//截取字符加完整title

function getstr_title($string, $length,$jiewei='..',$tag='a',$encoding  = 'utf-8'){
	
	return "<".$tag." title='".$string."'>".getstr($string, $length,$jiewei='..',$encoding  = 'utf-8')."</".$tag.">";
}
 
 
 
//过滤注入
function filter_injection(&$request)
{
	$pattern = "/(select[\s])|(insert[\s])|(update[\s])|(delete[\s])|(from[\s])|(where[\s])/i";
	foreach($request as $k=>$v)
	{
				if(preg_match($pattern,$k,$match))
				{
						die("SQL Injection denied!");
				}
		
				if(is_array($v))
				{					
					filter_injection($v);
				}
				else
				{					
					
					if(preg_match($pattern,$v,$match))
					{
						die("SQL Injection denied!");
					}					
				}
	}
	
}

//过滤请求
function filter_request(&$request)
{
		if(MAGIC_QUOTES_GPC_NEW)
		{
			foreach($request as $k=>$v)
			{
				if(is_array($v))
				{
					filter_request($v);
				}
				else
				{
					$request[$k] = stripslashes(trim($v));
				}
			}
		}
		
}

function adddeepslashes(&$request)
{

			foreach($request as $k=>$v)
			{
				if(is_array($v))
				{
					adddeepslashes($v);
				}
				else
				{
					$request[$k] = addslashes(trim($v));
				}
			}		
}


function quotes($content)
{
	//if $content is an array
	if (is_array($content))
	{
		foreach ($content as $key=>$value)
		{
			$content[$key] = mysql_real_escape_string($value);
		}
	} else
	{
		//if $content is not an array
		mysql_real_escape_string($content);
	}
	return $content;
}


//request转码
function convert_req(&$req)
{
	foreach($req as $k=>$v)
	{
		if(is_array($v))
		{
			convert_req($req[$k]);
		}
		else
		{
			if(!is_u8($v))
			{
				$req[$k] = iconv("gbk","utf-8",$v);
			}
		}
	}
}




//处理多行文本框数值回车换成换行
function make_textarea($value){
	$value=nl2br($value);
	$new_value=str_replace('\n','<br />',$value);
	return $new_value; 
}



//后台字符加密
function pass_encrypt($pass){
  	return md5(md5('Z').'H'.$pass.'X');
}



//显示图片路径
function show_img($url,$w=20,$h=5){
	if($url == "")
	{
     return '';
	}
	else
	{
     return '<a href="'.$url.'" target="_blank"><img src="'.$url.'" width="'.$w.'" height="'.$h.'" /></a>';
	}
}

