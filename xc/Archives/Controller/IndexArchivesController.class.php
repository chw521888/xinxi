<?php
namespace Archives\Controller;
use Think\Controller;
class IndexArchivesController extends \Common\Controller\CommonIndexController{
    function index(){
	  $a_id=I('request.a_id','','make_number');
	  $info=get_article_info(array("a_id"=>$a_id));
	  if($info['id']==""){$this->error("抱歉文章未找到!",AJAX);}
	  $template=get_arctype_template($info['arctype_id'],1);
	  $this->assign ( "info", $info );
	  $this->display($template);
    }
	
	
	function index_ajax(){
	  $a_id=I('request.a_id','','make_number');
	  $info=get_article_info(array("a_id"=>$a_id));
	  if($info['id']==""){$this->error("抱歉文章未找到!",AJAX);}
	  $info['content']=htmlspecialchars_decode($info['content']);
	  $this->ajaxReturn($info);
    }
	
}
?>