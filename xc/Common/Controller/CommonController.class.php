<?php
namespace Common\Controller;
use Think\Controller;
use Think\UploadFile;


class CommonController extends Controller{
	
     public function index() {		
		//列表过滤器，生成查询Map对象
		$map = $this->_search ();
		
		//追加默认参数
		if($this->get("default_map"))
		$map = array_merge($map,$this->get("default_map"));
		if (method_exists ( $this, '_filter')){$this->_filter ( $map );}
		

		$name=$this->getActionName();
		$model = D ($name);
		if (!empty ( $model )) {
			$this->_list($model,$map);
		}
		
		$this->display();
		return;
	}
	
	
	
	
	/**
     +----------------------------------------------------------
	 * 根据表单生成查询条件
	 * 进行列表过滤
     +----------------------------------------------------------
	 * @access protected
     +----------------------------------------------------------
	 * @param string $name 数据对象名称
     +----------------------------------------------------------
	 * @return HashMap
     +----------------------------------------------------------
	 * @throws ThinkExecption
     +----------------------------------------------------------
	 */
	protected function _search($name = '') {
		//生成查询条件
		if (empty ( $name )) {
			$name = $this->getActionName();
		}
		$model = M( $name );
		$map = array ();
		foreach ( $model->getDbFields () as $key => $val ) {
			if (isset ( $_REQUEST [$val] ) && $_REQUEST [$val] != '') {
				$map [$val] = $_REQUEST [$val];
			}
			//if($val=='is_delete' and !isset($_REQUEST['is_delete'])){$map [$val]=0;}
		}
		return $map;

	}
	
	
	
	protected function _search_like($map=array(),$like_field = array(),$field_name='keywords') {
		$keywords=I('get.'.$field_name);
		if($keywords!=""){
		  if(count($like_field)>1){
			for($i=0;$i<count($like_field);$i++){
		      $where[$like_field[$i]]  = array('like', '%'.$keywords.'%');	
		    }
			$where['_logic'] = 'or';
			$map['_complex'] = $where;
		   }else{
			if(count($like_field)>0){$map[$like_field[0]]=array('like', '%'.$keywords.'%');}
		   
		  }
		}
		return $map;

	}
	
	
	
	
	

	/**
     +----------------------------------------------------------
	 * 根据表单生成查询条件
	 * 进行列表过滤
     +----------------------------------------------------------
	 * @access protected
     +----------------------------------------------------------
	 * @param Model $model 数据对象
	 * @param HashMap $map 过滤条件
	 * @param string $sortBy 排序
	 * @param boolean $asc 是否正序
     +----------------------------------------------------------
	 * @return void
     +----------------------------------------------------------
	 * @throws ThinkExecption
     +----------------------------------------------------------
	 */
	protected function _list($model, $map, $sortBy = '', $asc = false ,$primary_key='id') {
		//排序字段 默认为主键名
		$voList = array();
		if (isset ( $_REQUEST ['_order'] )) {
			$order = $_REQUEST ['_order'];
		} else {
			$order = ! empty ( $sortBy ) ? $sortBy : $model->getPk ();
		}
		//排序方式默认按照倒序排列
		//接受 sost参数 0 表示倒序 非0都 表示正序
		if (isset ( $_REQUEST ['_sort'] )) {
			$sort = $_REQUEST ['_sort'] ? 'asc' : 'desc';
		} else {
			$sort = $asc ? 'asc' : 'desc';
		}
		
		
		//取得满足条件的记录数
		$count = $model->where ( $map )->count ('*');
		
		if ($count > 0) {
			//创建分页对象
			if (! empty ( $_REQUEST ['listRows'] )) {
				$listRows = $_REQUEST ['listRows'];
			} else {
				$listRows = C('listRows');
			}
			//echo $listRows;exit();
			$p = new \Think\Page ( $count, $listRows );
			
			
			//分页查询数据
			$voList = $model->where($map)->order(   $order . " " . $sort)->limit($p->firstRow . ',' . $p->listRows)->select ();
			//var_dump($voList);
			
//			echo $model->getlastsql();
			//分页跳转的时候保证查询条件
		
			//分页显示


			$page = $p->show ();
			//列表排序显示
			$sortImg = $sort; //排序图标
			$sortAlt = $sort == 'desc' ? l("ASC_SORT") : l("DESC_SORT"); //排序提示
			$sort = $sort == 'desc' ? 1 : 0; //排序方式
			//模板赋值显示
			$this->assign ( 'list', $voList );
			$this->assign ( 'sort', $sort );
			$this->assign ( 'order', $order);
			$this->assign ( 'sortImg', $sortImg );
			$this->assign ( 'sortType', $sortAlt );
			$this->assign ( "page", $page );
			$this->assign ( "listRows", $listRows );
			$this->assign ( "listcount", $count );
			$this->assign ( "listRowsList", C('listRowsList'));
			$this->assign ( "nowPage",$p->nowPage);
		}
		return $voList;
	}
	
	
	
	
	/**
     +----------------------------------------------------------
	 * 根据表单生成查询条件
	 * 进行列表过滤
     +----------------------------------------------------------
	 * @access protected
     +----------------------------------------------------------
	 * @param Model $model 数据对象
	 * @param HashMap $map 过滤条件
	 * @param string $sortBy 排序
	 * @param boolean $asc 是否正序
     +----------------------------------------------------------
	 * @return void
     +----------------------------------------------------------
	 * @throws ThinkExecption
     +----------------------------------------------------------
	 */
	protected function _list_return($model, $map, $sortBy = '', $asc = false ,$primary_key='id') {
		//排序字段 默认为主键名
		$voList = array();
		if (isset ( $_REQUEST ['_order'] )) {
			$order = $_REQUEST ['_order'];
		} else {
			$order = ! empty ( $sortBy ) ? $sortBy : $model->getPk ();
		}
		//排序方式默认按照倒序排列
		//接受 sost参数 0 表示倒序 非0都 表示正序
		if (isset ( $_REQUEST ['_sort'] )) {
			$sort = $_REQUEST ['_sort'] ? 'asc' : 'desc';
		} else {
			$sort = $asc ? 'asc' : 'desc';
		}
		
		
		//取得满足条件的记录数
		$count = $model->where ( $map )->count ('*');
		
		$data=array("s"=>1);
		if ($count > 0) {
			//创建分页对象
			if (! empty ( $_REQUEST ['listRows'] )) {
				$listRows = $_REQUEST ['listRows'];
			} else {
				$listRows = C('listRows');
			}
			//echo $listRows;exit();
			$p = new \Think\Page ( $count, $listRows );
			
			
			//分页查询数据
			$voList = $model->where($map)->order(  $order . " " . $sort)->limit($p->firstRow . ',' . $p->listRows)->select ( );
			//var_dump($voList);
			
//			echo $model->getlastsql();
			//分页跳转的时候保证查询条件
		
			//分页显示

			$page = $p->show ();
			//列表排序显示
			$sortImg = $sort; //排序图标
			$sortAlt = $sort == 'desc' ? l("ASC_SORT") : l("DESC_SORT"); //排序提示
			$sort = $sort == 'desc' ? 1 : 0; //排序方式
		
			
			$data=array(
			    'list'          =>  $voList,
			    'sort'          =>  $sort,
			    'order'         =>  $order,
			    'sortType'      =>  $sortType,
			    'page'          =>  $page,
			    'listRows'      =>  $listRows,
			    'listRowsList'  =>  C('listRowsList'),
			    'nowPage'       =>  $p->nowPage,
			    'totalPage'     =>  $p->totalPages,
				"s"             =>  1
			 );
			
		}
		return $data;
	}
	
	
	
	
	//获得主键id
	public function get_id($field_id='id',$CONTROLLER=CONTROLLER_NAME){
	    $id=I('request.'.$field_id,'','make_number');
		if($id<1){$this->error("参数错误!",AJAX);}
	    $user_info=D($CONTROLLER)->field('id')->getById($id);
		if($user_info[$field_id] < 0){$this->error("参数错误!",AJAX);}
		return $user_info[$field_id];
	}
	
	
	
	/**
     * Ajax方式返回数据到客户端
     * @access protected
     * @param mixed $data 要返回的数据
     * @param String $type AJAX返回数据格式
     * @return void
     */
    protected function ajaxReturn($data, $type = '',$json_option=0) {
        
        $data['referer']=$data['url'] ? $data['url'] : "";
        $data['state']=$data['status'] ? "success" : "fail";
        
        if(empty($type)) $type  =   C('DEFAULT_AJAX_RETURN');
        switch (strtoupper($type)){
        	case 'JSON' :
        		// 返回JSON数据格式到客户端 包含状态信息
        		header('Content-Type:application/json; charset=utf-8');
        		exit(json_encode($data,$json_option));
        	case 'XML'  :
        		// 返回xml格式数据
        		header('Content-Type:text/xml; charset=utf-8');
        		exit(xml_encode($data));
        	case 'JSONP':
        		// 返回JSON数据格式到客户端 包含状态信息
        		header('Content-Type:application/json; charset=utf-8');
        		$handler  =   isset($_GET[C('VAR_JSONP_HANDLER')]) ? $_GET[C('VAR_JSONP_HANDLER')] : C('DEFAULT_JSONP_HANDLER');
        		exit($handler.'('.json_encode($data,$json_option).');');
        	case 'EVAL' :
        		// 返回可执行的js脚本
        		header('Content-Type:text/html; charset=utf-8');
        		exit($data);
        	case 'AJAX_UPLOAD':
        		// 返回JSON数据格式到客户端 包含状态信息
        		header('Content-Type:text/html; charset=utf-8');
        		exit(json_encode($data,$json_option));
        	default :
        		// 用于扩展其他返回格式数据
        		Hook::listen('ajax_return',$data);
        }
        
    }


}