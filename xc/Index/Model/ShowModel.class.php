<?php
namespace Contingent\Model;
use Think\Model;
use Think\Model\ViewModel;

class ShowModel extends ViewModel {
  public $viewFields = array(
     'Show1'                 =>  array('_as'=>'jshow','*','_type'=>'LEFT'),
     'Location1'             =>  array('id'=>'son_location_id','location_id'=>'father_location_id','name'=>'location_name','time_vote_stat','time_vote_end', '_on'=>'jshow.location_id=Location1.id')
   );
 
 

}

?>