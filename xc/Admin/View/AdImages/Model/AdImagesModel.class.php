<?php
namespace AdImages\Model;
use Think\Model;
use Think\Model\ViewModel;

class AdImagesModel extends ViewModel {
  public $viewFields = array(
     'AdImages'                 =>  array('*','_type'=>'LEFT'),
     'Category'                 =>  array('name'=>'category_name', '_on'=>'AdImages.category_id=Category.id')
   );
 
 
 

}

?>