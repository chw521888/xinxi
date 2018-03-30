<?php
namespace Huihua\Model;
use Think\Model;
use Think\Model\ViewModel;

class HuihuaModel extends ViewModel {
  public $viewFields = array(
     'Huihua'	=>	array('*','_type'=>'LEFT'),
     'User'		=>	array('user_pic','is_hpf', '_on'=>'Huihua.user_id=User.id')
   );
}

?>