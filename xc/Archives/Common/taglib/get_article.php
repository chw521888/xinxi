<?php
/**
获取文章列表标签

$tag=array(
    'arctype_id'       => 栏目ID多个用,隔开,
    'att'              => 标签,
    'where'            => 自定义where,
    'orderby'          => 表示排序方式，默认值是time 按发布时间排列。 
    'orderway'         => 值为 desc 或 asc ，指定排序方式是降序还是顺向排序，默认为降序。
	'model_d'          => 自定义model，支持自定义model,必须关联archives表。
	'subday'           => '天数' 表示在多少天以内的文档，通常用于获取指定天数的热门文档、推荐文档、热门评论文档等型.
    'limit'            => 条数,	默认10条
);
**/
function get_article($tag){
	$arctype_id = $tag['arctype_id'] ? $tag['arctype_id'] : '';
	$att        = $tag['att'] ? $tag['att'] : '';
	$where      = $tag['where'] ? $tag['where'] : '';
	$orderby    = $tag['orderby'] ? $tag['orderby'] : ' Archives.sort asc,Archives.pubdate desc,Archives.time';
	$orderway   = $tag['orderway'] ? $tag['orderway'] : 'desc';
	
	$model_d    = $tag['model_d'] ? $tag['model_d'] : '';
	$limit    = $tag['limit'] ? $tag['limit'] : 10;
	
	$subday     = $tag['subday'] ? $tag['subday'] : 0;
    //$return=S('get_article'.$arctype_id.'_'.$titlelen.'_'.$infolen.'_'.$att.'_'.$where.'_'.$orderby.'_'.$orderway.'_'.$channelid.'_'.$subday);
	if($return==false){
		if($arctype_id!=""){
			$son_arctype_id = get_arctype_id_son($arctype_id);
			$map['arctype_id']=array('in',$son_arctype_id);
		}
		if($att!=""){
		    $att_array=explode(',',$att);
			if($map['_string']!=""){$map['_string'].=" AND ";}
			$map['_string'].=" (";
			foreach($att_array as $key=>$aa){
			   if($key>0){$map['_string'].=" OR ";}
			   $map['_string'].="CONCAT(',',`att`,',') like '%,".$aa.",%'";
			}
			$map['_string'].=" )";
	    }
		if($where!=""){
			if($map['_string']!=""){$map['_string'].=" AND ";}
			$map['_string'].=$where;
		}
		
		$subday=make_number($subday);
		if($subday>0){
			 $now_datatime=time()-60*60*24*$subday;
			 $map['time']=array('gt',$now_datatime);
		}
		
		
		$map['Archives.is_delete']=0;
		$map['Archives.is_effect']=1;
		$map['Archives.end_time']=array(array('eq',0),array('egt',time()), 'or') ;
		$d_article=D("Archives/Archives");
		//if()
		if($model_d!=""){$d_article=D("Archives/".$model_d);}
		
		
		$list=$d_article->where($map)->order($orderby." ".$orderway)->limit($limit)->select();
		$return=make_archives_data_list($list);
	   S('get_article'.$arctype_id.'_'.$titlelen.'_'.$infolen.'_'.$att.'_'.$where.'_'.$orderby.'_'.$orderway.'_'.$channelid.'_'.$subday,$return);
	}
	return $return;
} 



