<?php
namespace Admin\Controller;
class SettingController extends CommonController{

	
	//清除缓存
	function clearcache(){
	    clear_dir_file(get_real_path()."data/runtime/Cache/");
	    clear_dir_file(get_real_path()."data/runtime/Data/");
	    clear_dir_file(get_real_path()."data/runtime/Logs/");
	    clear_dir_file(get_real_path()."data/runtime/Temp/");
		$this->display();
	}
	
	
	
	
}