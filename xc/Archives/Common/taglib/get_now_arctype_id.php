<?php
//获取当前栏目ID
function get_now_arctype_id(){
   //echo CONTROLLER_NAME;
   //当前页面在文章栏目页
   if(CONTROLLER_NAME=='IndexArctype'){
	   return I('request.t_id','','make_number');
   }
     //当前页面在文章详细内容页
   else if(CONTROLLER_NAME=='IndexArchives'){
	   $a_id=I('request.a_id','','make_number');
	   if($a_id==0){return 0;}
	   $archives_info=M('Archives')->field("arctype_id")->where("id='".$a_id."'")->find();
	   return $archives_info['arctype_id'];
   }else{
	   //判断当前页面在跳转页面 
	   $now_url=$_SERVER["REQUEST_URI"];
	    $map['url']=$now_url;
	    $Arctype_info=M('Arctype')->field("id")->where($map)->find();
	    $Arctype_id=make_number($Arctype_info['id']);
		return $Arctype_id;
   }
}