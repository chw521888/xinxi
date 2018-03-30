<?php
namespace Fengzi\Model;
use Think\Model;
use Think\Model\ViewModel;

class FengziModel extends ViewModel {
  public $viewFields = array(
     'Fengzi'	=>	array('*','_type'=>'LEFT'),
     'User'		=>	array('user_pic', '_on'=>'Fengzi.user_id=User.id')
   );




}

?>