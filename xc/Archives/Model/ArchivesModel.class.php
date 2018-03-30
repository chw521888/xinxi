<?php
namespace Archives\Model;
use Think\Model;
use Think\Model\ViewModel;

class ArchivesModel extends ViewModel {
  public $viewFields = array(
     'Archives'                 =>  array('*','_type'=>'LEFT'),
     'Arctype'                  =>  array('typename','template_article','channeltype_id', '_on'=>'Archives.arctype_id=Arctype.id')
   );
 
 
 

}

?>