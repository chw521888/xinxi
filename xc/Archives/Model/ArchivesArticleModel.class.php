<?php
namespace Archives\Model;
use Think\Model;
use Think\Model\ViewModel;

class ArchivesArticleModel extends ViewModel {
  public $viewFields = array(
     'Archives'               =>  array('*','_type'=>'LEFT'),
     'ArchivesArticle'        =>  array('uploadfile', '_on'=>'ArchivesArticle.archives_id=Archives.id')
   );
 
 
 

}

?>