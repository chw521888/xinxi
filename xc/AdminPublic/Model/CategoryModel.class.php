<?php
namespace AdminPublic\Model;
use Think\Model;

class CategoryModel extends Model {
  public $viewFields = array(
   );
   
   
   //获得从分类列表
   public function get_category_list($category=CONTROLLER_NAME,$where=false){
	         //$category_dictionary=S('category_'.$category);
			 if($category_dictionary==false or $where!=false){
			    $sql_where['is_delete']=0;	 
			    $sql_where['category_table']=$category;	 
				if($where!=false){$sql_where=$sql_where+$where;}
			    $category_dictionary=M('Category')->where($sql_where)->order("sort asc,id asc")->select();  	 
			 }
			 return $category_dictionary;
   }
   
   
   
   
   
    //获得分类的多维数组---已value的|分割成二级分类
    public function turn_category_two_array($category=CONTROLLER_NAME,$where=false){
	         $category_list=$this->get_category_list($category,$where);
			 $return_array=array();
			 foreach($category_list as $key=>$cl){
				$return_array[$key]['name'] = $cl['name'];
				$return_array[$key]['value'] = $cl['id'];
				
				$son_array=explode('|',$cl['value']);
				for($i=0;$i<count($son_array);$i++){
					$return_array[$key]['son'][$i]['name']=$son_array[$i];
					$return_array[$key]['son'][$i]['value']=$i;
				}
			}
			return $return_array;
    }
     
	 
	 //获得分类信息
     public function get_category_info($category_id){
	         //$category_info=S('category_info_'.$category_id);
			 if($category_info==false){
			    $category_info=M('Category')->getById($category_id);
				S('category_info_'.$category_id,$category_info,3600);
			 }
			 return $category_info;
    }
	
	
	
	//递归获得array
	public function get_recursive_category_list($category=CONTROLLER_NAME){
	       //$category_dictionary=S('recursive_category_'.$category);
			if($category_dictionary==false){
				$new_category_list=array();
				$category_list = $this->get_category_list($category);
				foreach($category_list as $cl){
				  $new_category_list[$cl['category_id']][]=$cl;  
				}
				$category_dictionary = $this->recursive_category_list($new_category_list);
				S('recursive_category_'.$category,$category_dictionary);
			}
			return $category_dictionary;
	}
	//递归array
	public function recursive_category_list($category_list,$pid=0,$return_array=array(),$level=0){
		if(is_array($category_list[$pid])){		   
		   for($lev = 0; $lev < $level * 2 - 1; $lev ++) {
		       $level_nbsp .= "&nbsp;&nbsp;";
	        }
			if($level++)$level_nbsp .= "┝ ";     
		   foreach($category_list[$pid] as $cl){
			  $cl['level_name']  = $level_nbsp.$cl['name'];
			  $return_array[]    = $cl;
			  $return_array      = $this->recursive_category_list($category_list,$cl['id'],$return_array,$level);
		   }
		}
		return $return_array;
	}
	
	
	
	

	
	
	

}

?>