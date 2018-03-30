<?php
namespace Contingent\Model;
use Think\Model;
use Think\Model\ViewModel;

class ShowModel extends ViewModel {
  public $viewFields = array(
     'Show'                 =>  array('_as'=>'jshow','*','_type'=>'LEFT'),
     'Location'             =>  array('id'=>'son_location_id','location_id'=>'father_location_id','name'=>'location_name','time_vote_stat','time_vote_end', '_on'=>'jshow.location_id=Location.id')
   );
 
 
 
 
   //获得已经有作品的队伍
   function get_have_show_contingent_id($map){
	  $is_have_show=M("Show")->field("contingent_id")->where($map)->group("contingent_id")->select();
	  $is_have_array=make_one_array($is_have_show,'contingent_id');
	  return $is_have_array;
   }
 
 
 

}

?>