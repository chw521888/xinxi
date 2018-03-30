<?php
namespace Contingent\Controller;
use Think\Controller;

class IndexShowController extends \Common\Controller\CommonIndexController{
 

   function index(){
   		$location_list = M('Location')->where('location_id=0 and id not in (68,69)')->select();
   		$this->assign('location_list',$location_list);
   		$map1 = array();
   		$map2 = array();
   		$map3 = array();
   		$location_id = I('request.location_id');
   		if($location_id != ''){
            $l_id = make_one_array(M('Location')->where('location_id='.$location_id)->select(),'id');
            $l_id[] = $location_id;
   			$map1['location_id'] = array('in',$l_id);
   			$map2['location_id'] = $location_id;
   			$map3['location_id'] = $location_id;
   		}
   		$stage		 = I('request.stage');
   		if($stage != ''){
   			$map1['stage'] = $stage;
   			//社区赛
            if($stage == 3){
   				$map2['lanmu_type'] = 1;
   				$map3['lanmu_type'] = 1;
   			}
            //街道赛
   			if($stage == 2){
   				$map2['lanmu_type'] = 2;
   				$map3['lanmu_type'] = 2;
   			}
            //城市赛
   			if($stage == 1){
   				$map2['lanmu_type'] = 3;
   				$map3['lanmu_type'] = 3;
   			}
   		}
         $map2['type'] = 1;
         $map3['type'] = 2;
   		$list1 = M('Show')->where($map1)->limit(8)->select();
   		$list2 = M('Huaxu')->where($map2)->limit(8)->select();
   		$list3 = M('Huaxu')->where($map3)->limit(8)->select();
   		$this->assign('list1',$list1);
   		$this->assign('list2',$list2);
   		$this->assign('list3',$list3);
   		$this->display();
   }
   function index_more(){
   		$location_list = M('Location')->where('location_id=0 and id not in (68,69)')->select();
   		$this->assign('location_list',$location_list);
   		$map1 = array();
         $map2 = array();
         $map3 = array();
         $location_id = I('request.location_id');
         if($location_id != ''){
            $l_id = make_one_array(M('Location')->where('location_id='.$location_id)->select(),'id');
            $l_id[] = $location_id;
            $map1['location_id'] = array('in',$l_id);
            $map2['location_id'] = $location_id;
            $map3['location_id'] = $location_id;
         }
         $stage = I('request.stage');
         $type  = I('request.type');
   		if($stage != ''){
   			$map1['stage'] = $stage;
   			if($stage == 3){
   				$map2['lanmu_type'] = 1;
   				$map3['lanmu_type'] = 1;
   			}
   			if($stage == 2){
   				$map2['lanmu_type'] = 2;
   				$map3['lanmu_type'] = 2;
   			}
   			if($stage == 1){
   				$map2['lanmu_type'] = 3;
   				$map3['lanmu_type'] = 3;
   			}
   		}
   		C('listRows',12);
   		if($type == 1){
   			$this->_list(M('Show'),$map1);
   		}
   		if($type == 2){
            $map2['type'] = 1;
   			$this->_list(M('Huaxu'),$map2);
   		}
   		if($type == 3){
            $map3['type'] = 2;
   			$this->_list(M('Huaxu'),$map3);
   		}
   		$this->display();
   }
   function index_finals(){
      $map['stage'] = 0;
      $map['is_child'] = 0;
      $cr_list = D('Contingent/Show')->where($map)->select();
      $this->assign('cr_list',$cr_list);
      $map['is_child'] = 1;
      $et_list = D('Contingent/Show')->where($map)->select();
      $this->assign('et_list',$et_list);
      //建立一个顶级总决赛城市
      $cr_info = M('Location')->where('id=68')->find();
      $this->assign('cr_info',$cr_info);
      $et_info = M('Location')->where('id=69')->find();
      $this->assign('et_info',$et_info);
      $this->display();
   }
   //城市赛页面
   function index_city(){
	   $street_id = I('get.street_id');
	   $location_id = I('get.location_id');
	   if($street_id == ""){$street_id = 0;}

	   $info_list=S('info_list_0');
	   if($info_list==false){
	       $info_list = M('Location')->where('location_id=0 and status=1')->select();
	       foreach($info_list as $key=>$lc){
		      $info_list[$key]['value'] = M('Show')->where('location_id='.$lc['id'].' and stage=1 and is_child=0')->select();
		   }
		   S('info_list_0',$info_list,60*60*24);
	   }
	   //var_dump($info_list);
	   $this->assign('info_list',$info_list);
	   $this->assign('street_id',$street_id);
	   $this->assign('location_id',$location_id);
	   $this->display();
   }
 
    //街道赛页面
   function index_street(){
	   $location_id = I('get.location_id');
	   $street_id = I('get.street_id');
	   $s_id = I('get.s_id');

	   if($street_id == ""){$street_id = 0;}
	   $info=S('info_'.$location_id);
	   $info_list=S('info_list_'.$location_id);
	   if($info_list==false){
		   $info = M('Location')->where('id='.$location_id)->find();
		   $info_list = M('Location')->where('location_id='.$location_id.' and status=1')->select();
		   foreach($info_list as $key=>$lc){
				   $info_list[$key]['value'] = M('Show')->where('location_id='.$lc['id'].' and stage=2 and is_child=0')->select();
			   }
		   S('info_'.$location_id,$info,60*60*24);
		   S('info_list_'.$location_id,$info_list,60*60*24);
	   }
	   //var_dump($info_list);
	   $this->assign('info',$info);
	   $this->assign('s_id',$s_id);
	   $this->assign('street_id',$street_id);
	   $this->assign('info_list',$info_list);
	   $this->assign('location_id',$location_id);

      $child_list = array();
      //$child_list=S('child_list');
      if($child_list==false){
         foreach($info_list as $key=>$lc){
               $show_list = M('Show')->where('location_id='.$lc['id'].' and stage=2 and is_child=1')->select();
               if($show_list[0]['id'] > 0){
                  foreach ($show_list as $k => $val) {
                     $child_list[] = $val;
                  }
               }
            }
         S('child_list',$child_list,60*60*24);
      }
      $this->assign('child_list',$child_list);
	   $this->display();
   }
   
   
   //详情页信息展示
   function index_show(){
		$id    = I('request.id');
		$info  = M('Show')->where('id='.$id)->find();
		$info2 = M('Contingent')->where('id='.$info['contingent_id'])->find();
	   $this->assign('info',$info);
	   $this->assign('info2',$info2);
	   $this->display();
	   }
    
 
 	function index_xiu(){
		$location_id   = I('request.location_id');
		$location_list = M('Location')->where('location_id=0 and id <> 65')->select();
 		$this->assign('location_list',$location_list);
      if($location_id != ""){
 		   $map['location_id'] = $location_id;
      }
 		$map['lanmu_type']  = 4;
 		$this->_list(M('Huaxu'),$map);
 		$this->display();

 	}

 	function index_xiu_show(){
 		$id = I('request.id');
 		$info = M('Huaxu')->where('id='.$id)->find();
 		$this->assign('info',$info);
 		$this->display();
 	}
 	function index_shequ(){
 		$location_id = I('request.location_id');
 		if($location_id != ''){
 			$map['location_id'] = $location_id;
 		}
      C('listRows',12);
 		$map['lanmu_type']  = 1;
 		$map['type']		= 2;
 		$list1 = M('Huaxu')->where($map)->select();
      $this->_list(M('Huaxu'),$map);
 		// $map['type']		= 1;
 		// $list2 = M('Huaxu')->where($map)->select();
 		$this->assign('info',D('Location')->where('id='.$location_id)->find());
 		// $this->assign('list1',$list1);
      // $this->assign('list2',$list2);
 		$this->display();
 	}
 
}
?>