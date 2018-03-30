<?php
namespace Index\Controller;
use Think\Controller;

class HuiguController extends CommonController {

     public function index(){
        $review_type = I('request.review_type');
        if($review_type == ""){
          $map['review_type'] = 1;
        }else{
          $map['review_type'] = $review_type;
        }
        $POSITION_TYPE = C('POSITION_TYPE');
        for($i=1;$i <= count($POSITION_TYPE);$i++){
          $map['position_type'] = $i;
          $list =M('Review')->where($map)->select();
          $this->assign('list'.$i,$list);
        }
        $this->assign('review_type',$map['review_type']);
        //dump($map['review_type']);
        $this->display();
    }

    public function huigu(){
    	$location_id = I('request.location_id');
    	if($location_id == ''){
    		$location_id = 65;
    	}
        $map2['location_id'] = $location_id;
        $location_list = M('Location1')->where($map2)->select();
        $location_ids  = implode(',',make_one_array($location_list,'id'));
        C('listRows',20);
    	$map['location_id'] = array('in',$location_ids.",".$location_id);
    	$this->_list(D('Show1'),$map);
    	$location_list = M('Location1')->where('location_id=0')->select();
        $this->assign('location_list',$location_list);
    	$this->assign('location_id',$location_id);
    	$this->display();
    }
    
    public function huigu2(){
    	$location_id = I('request.location_id');
    	if($location_id == ''){
    		$location_id = 65;
    	}
        $map2['location_id'] = $location_id;
        $location_list = M('Location2')->where($map2)->select();
        $location_ids  = implode(',',make_one_array($location_list,'id'));
        C('listRows',20);
    	$map['location_id'] = array('in',$location_ids.",".$location_id);
    	$this->_list(D('Show2'),$map);
    	$location_list = M('Location2')->where('location_id=0')->select();
        $this->assign('location_list',$location_list);
    	$this->assign('location_id',$location_id);
    	$this->display();
    }

    //详情页信息展示
   function show(){
       $id = I('request.id');
       $info = M('Show1')->where('id='.$id)->find();
       $info2 = M('Contingent1')->where('id='.$info['contingent_id'])->find();
       $this->assign('info',$info);
       $this->assign('info2',$info2);
       $this->display();
       }
    //详情页信息展示
   function show2(){
       $id = I('request.id');
       $info = M('Show2')->where('id='.$id)->find();
       $info2 = M('Contingent2')->where('id='.$info['contingent_id'])->find();
       $this->assign('info',$info);
       $this->assign('info2',$info2);
       $this->display();
       }


}