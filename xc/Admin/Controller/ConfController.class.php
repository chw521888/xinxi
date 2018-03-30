<?php
namespace Admin\Controller;
use Think\Controller;


class ConfController extends CommonController{
public function index()
	{
		    $list=array();
			$conf_list = D('Conf')->order("sort asc,id asc")->select();
			foreach($conf_list as $cl){
				$list[$cl['conf_group']][]=$cl;
			}
			$this->assign ( "list", $list );
		    $this->display();
	}
	
    public function conf_update(){
			$conf_list = D('Conf')->order("id asc")->select ( );
			foreach($conf_list as $cl){
				M('Conf')->where("id='".$cl['id']."'")->save(array('value'=>$_POST[$cl['name']]));
			}
			
			
			 $conf_list = D('Conf')->order("id asc")->select();
             $connet='<?php 
			            return array(';
			 foreach($conf_list as $cl){
				 if($cl['is_array']==1){
					  $connet.='
					  \''.$cl['name'].'\'=>'.'array(\''.str_replace('|','\',\'',$cl['value']).'\'),';
				 }
				 else{
					  $connet.= '
					  \''.$cl['name'].'\'=>\''.$cl['value'].'\',';
				 }   
			  }
             $connet.=');
			 ?>';

			file_put_contents('public/sys_config.php', $connet);
			$this->success("更新成功", U('Conf/index'));
	}
}

?>