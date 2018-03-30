<?php


//转换成一维数组
function make_one_array($array,$value='name'){
      $return=array();
	  if(is_array($array) and count($array)>0){
		  $key=0;
		  foreach($array as $a){
			$return[$key]=$a[$value];
			$key++;
		  }  
	  }
	  return $return;
}





//转换成二维数组
function make_two_array($array,$key='id',$value='name'){
      $return=array();
	  if(is_array($array) and count($array)>0){
		  foreach($array as $a){
			$return[$a[$key]]=$a[$value];
		  }  
	  }
	  return $return;
}





//获得数组的的key的value
function get_array_key_value($key,$array){
	//var_dump($key);
   if(is_array($array)){
	  return $array[$key];
   }else{
	return false;   
   }	
}





//获得数组的VALUE的key
function get_array_value_key($value,$array){
	//var_dump($key);
	if(is_array($array)){
	  foreach($array as $key=>$a){
		if($value==$a){return $key;}  
	  }	
	}
	return false;
}





//处理数字为二维数组
function turn_number_array($num_end,$num_start=1){
	$return=array();
	for($i=$num_start;$i<=$num_end;$i++){
		$return[$i]=$i;
	}
	return $return;	
}



//根据系统变量,为了优化搜索,重新改造二维数组
function turn_c_seach_array($c,$friest='全部',$add_num=10){
   $return_array=array();
   $c_array=C($c);
   if(is_array($c_array)){
	   if($friest!=""){$return_array[0]=$friest;}
	   foreach($c_array as $k=>$ca){
		 $return_array[$k+$add_num]=$ca; 
	   }   
   }
   return $return_array;
}
