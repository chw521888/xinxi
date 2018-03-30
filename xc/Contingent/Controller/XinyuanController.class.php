<?php
namespace Contingent\Controller;
use Think\Controller;
use Think\Upload;

class XinyuanController extends \Common\Controller\CommonIndexController{
 
   function index(){
		$map['is_effect'] = 1;
   		$this->_list(M('Xinyuan'),$map);
		$this->display();
   }
   function insert_xy(){
		$data = M('Xinyuan')->create();
		$setting = array(  
            'mimes' => '', //允许上传的文件MiMe类型  
            'maxSize' => 6 * 1024 * 1024, //上传的文件大小限制 (0-不做限制)  
            'exts' => implode(',',C('TASK_ALLOW_IMAGE_EXT')), //允许上传的文件后缀  
            'autoSub' => true, //自动子目录保存文件  
            'subName' => 0, //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组  
            'rootPath' => './upload/other/user_photo/', //保存根路径  
            'savePath' => '', //保存路径  
			'saveRule' => $user_info['id'] , //保存路径  
			'thumb'    => true, //保存路径  
			'thumbMaxWidth' => 300, //保存路径  
			'thumbMaxHeight' => 300, //保存路径  
        );  
        /* 调用文件上传组件上传文件 */  
        //实例化上传类，传入上面的配置数组  
        $this->uploader = new Upload($setting);  
        $info = $this->uploader->upload($_FILES);
		
		if($info['pic']['savename']!=false){
		   $data['pic']=$setting['rootPath'].$info['pic']['savename'];
		}
		$data_id = M('Xinyuan')->add($data);
		if($data_id > 0){
			$this->success('愿望已提交！',AJAX);
			}
		}
 	function insert_tp(){
		$map['id'] = I('request.id');
		$data = M('Xinyuan')->field('num')->where($map)->find();
		$data['num'] = (int)$data['num']+1;
		$data_id = M('Xinyuan')->where($map)->save($data);
		if($data_id > 0){
			$this->success('投票成功！',AJAX);
			}
		}
}
?>