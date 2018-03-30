<?php
namespace AdminPublic\Controller;
use Think\Controller;

class CategoryController extends CommonController{
	
	public function __construct()
	{
		parent::__construct();
		$this->get_category_list();	
	}
	
		//分类列表
	public function category_index(){
		$have_value=I('request.have_value',0);
		$category_name=I('request.category_table',$this->getActionName());
		$map['is_delete'] = 0;
		$map['category_table'] = $category_name;
		
		
		$this->_list(M('Category'),$map,'sort','asc');
		$this->assign ('category_name', $category_name );
		$this->assign ('have_value', $have_value );
		$this->display(T(select_template('AdminPublic@Category/index',$category_name.'/category_index')));
		//echo T('Common@Category/index');exit();
		//$this->display('../../Common/View/Category/index');
		
		
	}
	
	
	//分类添加
	public function category_add(){
		$have_value=I('request.have_value',0);
		$category_name=I('request.category_table',$this->getActionName());
		$this->assign ( 'category_name', $category_name );
		$this->assign ( 'have_value', $have_value );
		
		$recursive_category_list=array("0"=>"顶级栏目")+make_two_array(D('AdminPublic/Category')->get_recursive_category_list($category_name),'id','level_name');
		$this->assign ('recursive_category_list',$recursive_category_list);
		$this->display(T(select_template('AdminPublic@Category/add',$category_name.'/category_add')));
	}
	
	
	
	//分类修改
	public function category_edit(){
		$have_value=I('request.have_value',0);
	    $category_id=I('request.id','','make_number');
		$category_info=M('Category')->getById($category_id);
		$category_name=I('request.category_table',$this->getActionName());
		
		
		
		$recursive_category_list=array("0"=>"顶级栏目")+make_two_array(D('AdminPublic/Category')->get_recursive_category_list($category_name),'id','level_name');
		$this->assign ('recursive_category_list',$recursive_category_list);
		
		
		
		$this->assign ( 'category_name', $category_name );
		$this->assign ( 'have_value', $have_value );
		$this->assign ( 'category_info', $category_info );
		$this->assign ( 'category_id', $category_info['category_id'] );
		$this->assign ( 'category_value', $category_info['value']);
		$this->display(T(select_template('AdminPublic@Category/edit',$category_name.'/category_edit')));
		//$this->display(T(select_template('Common@Category/edit',$category_name.'/category_edit')));
	}
	
	
	
	

	//分类插入
	public function category_insert(){
		$category_name=I('request.category_table',$this->getActionName());
	    $data = M('Category')->create();
		if($data['name']==''){$this->error("名称不能为空!",AJAX);}
		$data['category_table']=$category_name;
		
		$list=M('Category')->add($data);
		if (false !== $list){
			save_log('新建分类'.$data['name'].'ID='.$list,1);
			$this->success('成功',AJAX);
		}else{
			$this->error('失败',AJAX);
		}
	}
	
	
	//分类修改
	public function category_update(){
		$category_id=I('request.id');
		if($category_id>0){
			$category_info=M('Category')->getById($category_id);
			if($category_info['id']>0){}else{$this->error('参数错误!',AJAX);}
	      }else{$this->error('参数错误!',AJAX);	
		}
	    $data = M('Category')->create();
		if($data['name']==''){$this->error("名称不能为空!",AJAX);}

		$list=M('Category')->where("id='".$category_id."'")->save($data);
		if (false !== $list){
			save_log('修改分类'.$data['name'].'ID='.$category_id,1);
			$this->success('成功',AJAX);
		}else{
			$this->error('失败',AJAX);
		}
	}
	
	
		
	//分类删除
	public function category_delete(){
		$category_id=I('request.id');
		if($category_id>0){
			$category_info=M('Category')->getById($category_id);
			if($category_info['id']>0){}else{$this->error('参数错误!',AJAX);}
			}else{$this->error('参数错误!',AJAX);}
	    M('Category')->where("id='".$category_id."'")->save(array('is_delete'=>1));
		save_log('删除'.get_table_comment(get_thinkphp_tablie(CONTROLLER_NAME))."数据ID=".$category_id.'名称='.$category_info['name'],1);
		$this->success('成功',AJAX);
	}
	
	//分类删除
	public function category_foreverdelete(){
		//$category_name=I('request.category_table',$this->getActionName());
		$category_id=I('request.id');
		M('Category')->where("id=".$category_id)->delete();
		save_log('永久删除'.get_table_comment(get_thinkphp_tablie(CONTROLLER_NAME))."数据ID=".$category_id.'名称='.$category_info['name'],1);
		$this->success('成功',AJAX);
	}
	
	
	
	
	//获得分类信息
	public function get_category_list(){
		$category_name=I('request.category_table',$this->getActionName());
		$category_list=D('AdminPublic/Category')->get_category_list($category_name);
		$category_array=make_two_array($category_list,'id','name');
		
		
		$this->assign("category_array",$category_array);
		$this->assign("category_list",$category_list);
		
		return $category_list;
	}
	
	
	
		//设置字段修改
	public function  set_category_field_post(){
		$edit_array[$_REQUEST['field']]=$_REQUEST['value'];
	    $upl=M('Category')->where("id='".$_REQUEST['id']."' and category_table='".I('request.module_name')."'")->save($edit_array);
	    if(false!==$upl){
		     $this->success(L("INSERT_SUCCESS"),AJAX);
		}else{
			$this->error('参数错误',AJAX);
		}
	}	
	

}
?>