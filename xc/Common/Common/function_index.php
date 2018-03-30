<?php

//底部信息
function get_foot_list(){
  // $foot_list=S('foot_list');
   if($foot_list==false){
	   $category=D('AdminPublic/Category')->get_category_list('Article');	  
	   foreach($category as $key=>$c){
		   $foot_list[$key]['id']=$c['id'];
		   $foot_list[$key]['name']=$c['name'];
		   $article_list   =   M('Article')->field("id,title,url")->where("category_id='".$c['id']."'")->order('id asc')->select();
		   
		   
		    $article_array=array();
			if(is_array($article_list)){
			 foreach($article_list as $key_s=>$al){
				 if($al['url']!=""){$al['link']=$al['url'];}else{$al['link']=U('Index/Index/view_article',array('id'=>$al['id']));}
				 $article_array[$key_s]  = $al;
		     }
			}
		   $foot_list[$key]['list']  = $article_array;
	   }
	   S('foot_list',$foot_list);
   }
   return $foot_list;
	
}
//type   1为加法 0为减法
function jisuan($num=10,$type=1){
		$num3 = rand(2,$num);
		$num2 = rand(1,$num3-1);
		$num1 = $num3-$num2;
		if($type == 0){
			$str = $num3." - (　　) = ".$num1;
		}else{
			$str = $num1." + (　　) = ".$num3;
		}
		return $str;
	}

//
function get_article_list($category_id){
	     $article_list_category=S('article_list_category_'.$category_id);
		 if($article_list_category==false){
	      $article_list   =   M('Article')->field("id,title,url")->where("category_id='".$category_id."'")->order('id asc')->select();
		   
		   
		    $article_list_category=array();
			if(is_array($article_list)){
			 foreach($article_list as $key_s=>$al){
				 if($al['url']!=""){$al['link']=$al['url'];}else{$al['link']=U('Index/Index/view_article',array('id'=>$al['id']));}
				 $article_list_category[$key_s]  = $al;
		     }
			}
			S('article_list_category_'.$category_id,$article_list_category);
		 }
		 
		 return $article_list_category;
}



//获得图片广告分类的图片
function get_ad_images_list($category_id){
     	$images_list=S('ad_images_list_'.$category_id);
		if($images_list==false){
		    $images_list=M('AdImages')->where("category_id ='".$category_id."'")->select();
			S('ad_images_list_'.$category_id,$images_list);
		}
		
		return $images_list;
}


//判断是否登陆
function get_login_info(){
	$return_array=array();
	$user_session = es_session_get('UserCenter');
	if($user_session['id']>0){$return_array['is_login']=1;}else{$return_array['is_login']=0;}
	$return_array['type']  =  $user_session['type'];
	$return_array['url']   =  get_user_center_url($user_session['type']);
	return $return_array;
}




function get_user_center_url($type){
   if($type==1){
				   $user_center_url=U('User/UserCenterServiceProvider/index_task_apply');
				}else{
				   $user_center_url=U('User/UserCenterEmployers/add_task');
	}
	return 	$user_center_url;
}