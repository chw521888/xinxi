<?php
//是否为首页
function is_index(){
	if(CONTROLLER_NAME=='Index'){
	     return true;
      }else{
	     return false;
	}
}