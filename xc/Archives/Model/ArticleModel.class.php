<?php
namespace Article\Model;
use Think\Model;
use Think\Model\ViewModel;

class ArticleModel extends ViewModel {
  public $viewFields = array(
     'Article'                 =>  array('*','_type'=>'LEFT'),
     'Category'                 =>  array('name'=>'category_name', '_on'=>'Article.category_id=Category.id')
   );
 
 
 

}

?>