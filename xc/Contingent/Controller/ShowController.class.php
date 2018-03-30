<?php
namespace Contingent\Controller;
use Think\Controller;

class ShowController extends \AdminPublic\Controller\CategoryController{
  
  //加票程序  传值街道ID和翻倍数
  function fb_jd(){
	//  $lei_id = I('request.lei_id');
	//  $bs = I('request.bs');
	//  $data = M('Show')->where('location_id='.$lei_id)->select();
	//  foreach($data as $v){
	//    $map['num_vote_show'] = $v['num_vote_show']*$bs;
	//    M('Show')->where('id='.$v['id'])->save($map);
	//  }
	 $this->display();
		 
	  }
//街道选拔视频首页------------------------------------------------------------------------------------------------
  function index_stage_2(){
	  $location_list=M('Location')->where('location_id=0 and id != 68 and id != 69')->select();
	  foreach($location_list as $key=>$lc){
		  $location_list[$key]['value'] = M('Location')->where("location_id=".$lc['id'])->select();
		  }
	  $this->assign("location_list",$location_list);
	  
	  $location_id = I('request.location_id');
	  $keywords = I('request.keywords');
	  if($location_id != ""){
		  $map['location_id'] = $location_id;
		  }
	  if($keywords != ""){
		$map['_string'] = "show_name like '%".$keywords."%'";
		}
	  $map['stage'] = 2;
	  $this->_list(D('Show'),$map);
	  
	  $this->display();  
  }
  
  
  //添加视频---选择街道
  function add_stage_2(){
	  $location_list=M('Location')->where('location_id=0 and id != 68 and id != 69')->select();
	  foreach($location_list as $key=>$lc){
		  $location_list[$key]['value'] = M('Location')->where("location_id=".$lc['id'])->select();
	  }
	  $this->assign("location_list",$location_list);
	  $this->display();  
  }
  
  
  //添加视频--循环队伍
  function add_show_stage_2(){
	  $location_id = I('get.location_id');
	  $map['stage']=2;
	  $map['location_id']=$location_id;
	  $have_show_contingent_id=D('Show')->get_have_show_contingent_id($map);
	  
	  unset($map);
	  $map['location_id']=$location_id;
	  if(is_array($have_show_contingent_id) and count($have_show_contingent_id)>0){
	     $map['id']=array("not in",$have_show_contingent_id);
	  }

	  $contingent_list = M('Contingent')->where($map)->select();
	  
	  
	  $this->assign('contingent_list',$contingent_list);
	  $this->assign('location_id',$location_id);
	  $this->display();
   }

   //新增
   function insert_show_stage_2(){
	    $location_id = I('post.location_id');
		$contingent_list = M('Contingent')->where('location_id='.$location_id)->select();

		foreach($contingent_list as $key=>$lc){
			$cid      =  $lc['id'];
			$is_child =  $lc['is_child'];
			if(I('post.show_name_'.$cid)!=""){
			  $map['location_id']     =   $location_id;
			  $map['contingent_id']   =   $cid;
			  $map['is_child']   	  =   $is_child;
			  $map['show_name']       =   I('post.show_name_'.$cid);
			  $map['video']           =   I('post.video_'.$cid);
			  $map['pic']             =   I('post.pic_'.$cid);
			  $map['sort']            =   I('post.sort_'.$cid);
			  $map['stage']           =   2;
			  M('Show')->add($map);
			}
	     }
	   $this->success('成功',AJAX);
   }
   
   
   
   
   
   
   
   //修改节目页
   function edit_show_stage_2(){
	   $id = I('get.id');
	   $info = M('Show')->where('id='.$id)->find();
	   $this->assign('info',$info);
	   $this->display();
	   }
   //修改节目操作
   function update_show_stage_2(){
	   $data = M('Show')->create();
	   parent::update('',$data);
   }
   
   
   
   
   
   
   
   
   
   
   
//城市选拔视频首页------------------------------------------------------------------------------------------------
  function index_stage_1(){
	  $location_array = make_two_array(M('Location')->where('location_id=0 and id != 68 and id != 69')->select(),'id','name');
	  $this->assign('location_array',$location_array);
	  
	  $location_id = I('request.location_id');
	  $keywords = I('request.keywords');
	  if($location_id != ""){
		  $map['location_id'] = $location_id;
		  }
	  if($keywords != ""){
		$map['_string'] = "show_name like '%".$keywords."%'";
		}
	  $map['stage'] = 1;
	  $this->_list(D('Show'),$map);
	  $this->display();  
  }
  
  
  
  
  //添加视频---选择街道
  function add_stage_1(){
	  
	  $location_list=M('Location')->where('location_id=0 and id != 68 and id != 69')->select();
	  $this->assign("location_list",$location_list);
	  $this->display();
  }
  
  
  
  
  
  //添加视频--循环队伍
  function add_show_stage_1(){
	  $location_id = I('get.location_id');
	  $map['stage']  = 1;
	  //获取已经添加作品的队伍ID集
	  $have_show_contingent_id=D('Show')->get_have_show_contingent_id($map);
	  
	  unset($map);
	  //获取街道赛晋级队伍ID集
	  $map['location_id']=$location_id;
	  $location_list = M('Location')->where($map)->select();
	  $win_array = array();
	  $win_array_2 = array();
	  foreach($location_list as $key=>$lc){
		  if($lc['win_contingent_id'] != ''){
			  $win_array_2 = explode(',',$lc['win_contingent_id']);
			  foreach($win_array_2 as $wa2){
				  $win_array[] = $wa2;
				  }
			  }
		  }
		//var_dump($win_array);
	  unset($map);
	  //去除已经添加作品的队伍ID后结果集
	  $new_win_array = array();
	  if(is_array($have_show_contingent_id) and count($have_show_contingent_id)>0){
		 for($i=0;$i<count($win_array);$i++){
			 if(in_array($win_array[$i],$have_show_contingent_id)){
				 }else{
					 $new_win_array[] = $win_array[$i];
					 }
			 }
	  }else{
		  $new_win_array = $win_array;
		  }
		  //var_dump($new_win_array);
	  $map['id'] = array('in',$new_win_array);
	  
	  $contingent_list = M('Contingent')->where($map)->select();
	  
	  $this->assign('contingent_list',$contingent_list);
	  $this->assign('location_id',$location_id);
	  $this->display();
	  
   }
   //新增
   function insert_show_stage_1(){
	  $location_id = I('post.location_id');
	  $map['location_id'] = $location_id;
	  $location_list = M('Location')->where($map)->select();
	  $win_array = array();
	  foreach($location_list as $key=>$lc){
		  if($lc['win_contingent_id'] != ''){
			  $win_array_2 = explode(',',$lc['win_contingent_id']);
			  foreach($win_array_2 as $wa2){
				  $win_array[] = $wa2;
				  }
			  }
		  }
	  $data2['id']            =   array('in',$win_array);
	  $contingent_list       = M('Contingent')->where($data2)->select();
		foreach($contingent_list as $key=>$lc){
			$cid      =  $lc['id'];
			$is_child = $lc['is_child'];
			if(I('post.show_name_'.$cid)!=""){
			$map['location_id']   =   $location_id;
			$map['contingent_id'] =   $cid;
			$map['is_child']      =   $is_child;
			$map['show_name']     =   I('post.show_name_'.$cid);
			$map['video']         =   I('post.video_'.$cid);
			$map['video2']        =   I('post.video2_'.$cid);
			$map['pic']           =   I('post.pic_'.$cid);
			$map['sort']          =   I('post.sort_'.$cid);
			$map['stage']         =   1;
			
			M('Show')->add($map);
			}
		}
		$this->success('',AJAX);
	   }
   //修改节目页
   function edit_show_stage_1(){
	   $id = I('get.id');
	   $info = M('Show')->where('id='.$id)->find();
	   $this->assign('info',$info);
	   $this->display();
	   }
   //修改节目操作
   function update_show_stage_1(){
	   $data = M('Show')->create();
	   parent::update('',$data);
	   }
   
   
   
   
   
   
   
   
//全国视频首页------------------------------------------------------------------------------------------------
  function index_stage_0(){
	  $map['stage'] = 0;
	  $this->_list(D('Show'),$map);
	  $this->display();  
  }
  
  
  
  //添加视频--循环队伍
  function add_show_stage_0(){
	  $location_id_array     = make_one_array(M('location')->where('location_id=0')->select(),'id');
	  $data['is_win']        = 1;
	  $data['location_id']   = array('in',$location_id_array);
	  $contingent_array      = make_one_array(M('Show')->where($data)->select(),'contingent_id');
	  $data2['id']           =   array('in',$contingent_array);
	  $contingent_list       = M('Contingent')->where($data2)->select();
	  $this->assign('contingent_list',$contingent_list);
	  $this->display();  
   }
   
   
   
   //新增
   function insert_show_stage0(){
		$contingent_id = I('request.contingent_id');
		$map['id'] = $contingent_id;
		$c_info = M('Contingent')->where($map)->find();
		if($c_info['is_child'] == 1){
			$location_id=69;
		}else{
			$location_id=68;
		}
		$data = M('Show')->create();
		$data['location_id'] = $location_id;
		$data['stage']       = 0;
		$data['is_child']    = $c_info['is_child'];
		parent::insert('',$data);
   }
   
   
   
   
   //修改节目页
   function edit_show_stage_0(){
	   $id = I('get.id');
	   $info = M('Show')->where('id='.$id)->find();
	   $this->assign('info',$info);
	   $this->display();
    }
	   
	   
	   
   //修改节目操作
   function update_show_stage_0(){
	   $data = M('Show')->create();
	   parent::update('',$data);
   }
   
}
?>