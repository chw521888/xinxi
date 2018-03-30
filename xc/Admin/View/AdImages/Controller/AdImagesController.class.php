<?php
namespace AdImages\Controller;
use Think\Controller;

class AdImagesController extends \AdminPublic\Controller\CategoryController{
	
	
	//全局 
    public function __construct()
	{
		parent::__construct();
		$category_id=I('request.category_id','','make_number');
		if($category_id>0){
			 $category_info=$this->category->get_category_info($category_id);
		     $this->assign ('category_info', $category_info );
		}
	}
	
	//实例化图片集列表
	public function index(){
		$map = $this->_search('AdImages');
		$map = $this->_search_like($map,array('title'));
		$this->_list(D('AdImages'),$map);
		$this->display();	
	}
	
	//修改
	public function edit(){
	    $info_id=$this->get_id();
		$info=D(CONTROLLER_NAME)->getById($info_id);
		
		$category_info=$this->category->get_category_info($info['category_id']);
		$this->assign ('category_info', $category_info);
		
		$this->assign("info",$info);
		$this->display();
	}
	
	
	
    //插入图片
	function insert(){
		$data=M('AdImages')->create();
		$data['time']=strtotime($data['time']);
		parent::insert(array('title'=>'标题'),$data);
	}
	
	
	//修改图片
	function update(){
		$map           =  M('AdImages')->create();
	    $this->before_check_empty(array('title'=>'标题'),$map);
		$id            =  I('request.id');
		$map['time']   =  strtotime($map['time']);
		$archives_id   =  M('AdImages')->where("id=".$id)->save($map);
		save_log('修改'.get_table_comment(get_thinkphp_tablie('AdImages'))."数据ID=".$archives_id,1);
		$this->success('成功',AJAX);
	}
	//------------------------------广告位-------------------------------------------------------------------
	
	//实例化广告位列表
	public function tt_index(){
		
		$map = $this->_search('AdImages');
		$map = $this->_search_like($map,array('title'));
		$map['category_id'] = array('elt',0);
		$this->_list(D('AdImages'),$map);
		$this->display();	
	}
	
	//实例化广告位修改页面
	public function tt_index_edit(){
		$id = I('request.id');
		$info = M('AdImages')->where('id = '.$id)->find();
		$this->assign('info',$info);
		$this->display();
		}
	
    //插入广告位
	function tt_insert(){
		$data=M('AdImages')->create();
		$data['is_system']=1;
		$data['time']=time();
		parent::insert(array('title'=>'标题'),$data);
	}
	
	//修改广告位
	function tt_update(){
		$map           =  M('AdImages')->create();
	    $this->before_check_empty(array('title'=>'标题'),$map);
		$id            =  I('request.id');
		$archives_id   =  M('AdImages')->where("id=".$id)->save($map);
		save_log('修改'.get_table_comment(get_thinkphp_tablie('AdImages'))."数据ID=".$archives_id,1);
		$this->success('成功',U('AdImages/AdImages/tt_index'));
	}
	
	
}
?>