<?php
namespace Contingent\Controller;
use Think\Controller;

class LocationController extends \AdminPublic\Controller\CategoryController{


	function index(){
		$list=D('Location')->where('location_id=0')->select();
		foreach($list as $key=>$lc){
			$list[$key]['value'] = D('Location')->where("location_id=".$lc['id'])->select();
			}
		$this->assign("list",$list);
		$this->display();
	}
	//添加页面
	function add(){
		
		$location_list=D('Location')->where('location_id=0 and id != 68 and id != 69')->select();//获得分类
		$location_list_array=array(0=>"顶级栏目")+make_two_array($location_list,'id','name');
		
		$this->assign("location_list",$location_list_array);
		parent::add();
    }
	//插入操作
	function insert(){
		$data=M("Location")->create();
		$data['time_sport_stat']=strtotime($data['time_sport_stat']);
		$data['time_sport_end']=strtotime($data['time_sport_end']);
		$data['time_vote_stat']=strtotime($data['time_vote_stat']);
		$data['time_vote_end']=strtotime($data['time_vote_end']);
		 parent::insert('',$data);
	}
	
	//修改页面
	function edit(){
		$id = I('request.id');
		$info = D('Location')->where('id = '.$id)->find();
		
		$location_list=D('Location')->where('location_id=0 and id != 68 and id != 69')->select();//获得分类
		$location_list_array=array(0=>"顶级栏目")+make_two_array($location_list,'id','name');
		
		$this->assign('info',$info);
		$this->assign("location_list",$location_list_array);
		parent::edit();
		}
	//修改操作
	function update(){
		$data=M("Location")->create();
		$data['time_sport_stat']=strtotime($data['time_sport_stat']);
		$data['time_sport_end']=strtotime($data['time_sport_end']);
		$data['time_vote_stat']=strtotime($data['time_vote_stat']);
		$data['time_vote_end']=strtotime($data['time_vote_end']);
		 parent::update('',$data);
	}
}
?>