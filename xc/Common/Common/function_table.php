<?php

//审核操作
function check_effect($effect,$id,$table=""){
	$effect_array=C('IS_NO');
    return '<span style="cursor:pointer" onclick="do_check_effect('.$id.','.$effect.',\''.$table.'\')">'.$effect_array[$effect].'</span>';	
}

//设置提交文本框
function get_field($value,$id,$field,$allow_empty=0){
		return "<span class='sort_span' onclick=\"set_field(".$id.",'".$value."','".$field."',this,".$allow_empty.");\">".$value."</span>";
}


//设置分类提交文本框
function get_category_field($value,$id,$field,$allow_empty=0){
		return "<span class='sort_span' onclick=\"set_category_field(".$id.",'".$value."','".$field."',this,".$allow_empty.");\">".$value."</span>";
}


//输出两个参数
function echo_two($field1,$field2,$j='-'){
         return $field1.$j.$field2;
}


//设置排序input
function  set_sort_input($sort,$id){
	return '<input name="sort['.$id.']" type="text" id="textfield" size="3" value="'.$sort.'" class="input input-order" />';
}


//检查系统删除
function check_action_competence($delete,$is_system=0,$act_competence){
	if(C("SYSTEM_DEBUG")==false){
		if($is_system!=1 or $act_competence!="delete"){return $delete;}
	}else{
	   return $delete;
	}
}
//获取分组名称
function  show_authgroup_title($id){
	$data = M('AuthGroup')->where('id='.$id)->find();
	return $data['title'];
}

//时间为0永久有效
function show_turn_time($time){
	if($time == 0){ return "永久"; }else{ return turn_time($time); }
	}
//---------------------------广场舞开始--------------------------------
function show_C($num,$c){
	return C($c)[$num];
}
//展示所属城市
function show_l1_name($id){
	$data = M('Location')->where("id=".$id)->find();
	$txt  = $data['name'];
	return $txt;
	}
//展示所属城市及街道
function show_l2_name($id){
	$data = M('Location')->where("id=".$id)->find();
	$data2 = M('Location')->where("id=".$data['location_id'])->find();
	$txt = $data2['name']."-".$data['name'];
	return $txt;
	}
//展示所属街道
function show_street_name($street_id,$location_id){
	if($street_id == 0){
	$data = M('Location')->where("id=".$location_id)->find();
	$txt = $data['name'];
	}else{
	$data = M('Location')->where("id=".$street_id)->find();
	$txt = $data['name'];
		}
	return $txt;
	}
//展示队伍名称
function show_ca_name($id){
	$data = M('Contingent')->where("id=".$id)->find();
	return getstr($data['name'],15);
	}
//展示队伍名称
function show_ca_name2($id){
	$data = M('Contingent')->where("id=".$id)->find();
	return $data['name'].'-'.$id;
	}
//获取阶段名称
function show_stage($id){
	$SHOW_STAGE = C('SHOW_STAGE');
	return $SHOW_STAGE[$id];
	}
//全国比赛是否晋级
function show_is_win($is_win){
	$is_win_array=C('IS_WIN');
    return $is_win_array[$is_win];
}
//街道比赛是否晋级
function show_is_win2($is_win,$id,$table=""){
	$is_win_array=C('IS_WIN');
	if($is_win <= 0){
        return '<span style="cursor:pointer" onclick="show_is_win2('.$id.','.$is_win.',\''.$table.'\')">【'.$is_win_array[$is_win].'】</span>';
	}else{
		return '【'.$is_win_array[$is_win].'】';
	}
}
//城市比赛是否晋级
function show_is_win1($is_win,$id,$table=""){
	$is_win_array=C('IS_WIN');
	if($is_win <= 0){
    return '<span style="cursor:pointer" onclick="show_is_win1('.$id.','.$is_win.',\''.$table.'\')">【'.$is_win_array[$is_win].'】</span>';	
	}else{
		return '【'.$is_win_array[$is_win].'】';
		}
}
//时间显示机制
function show_time_s($str){
	return str_replace('-','.',$str);
	}
//数字显示
function show_num_s($str){
	return substr("0".$str,-2);
	}
//返回时间的年和月
function turn_time_MY($t,$d=0){
	if($d==0){return date('m',$t);}
	else if($d==1){return date('Y',$t);}
	else{return $t;}
	}
//北京特殊投票
function tc_location_id($id){
	$data = M('Show')->where('id='.$id)->find();
	return $data['location_id'];
	}
//展示-
function show_str($id){
	if($id==0){return "-";}else{return $id;}
	}

//全国赛城市显示
function show_city_over($id){
	if($id==611){$str='成都';}
	if($id==612){$str='武汉';}
	if($id==613){$str='广州';}
	if($id==614){$str='扬州';}
	if($id==615){$str='西安';}
	if($id==616){$str='北京';}
	if($id==617){$str='太原';}
	if($id==618){$str='郑州';}
	if($id==619){$str='长春';}
	if($id==620){$str='呼和浩特';}
	return $str;
}

function show_user_name($id){
	$data = M('User')->where('id='.$id)->find();
	return $data['user_chinese_name'];
}
function show_location_name($id){
	$data = M('Location')->where('id='.$id)->find();
	return $data['name'];
}

function show_dati_jg($id){
	$url = "<a href='".U('Index/Dati/index',array('id'=>$id))."' target='_blank'>查看答题结果</a>";
	return $url;
}
//---------------------------广场舞结束--------------------------------	

function show_dati_title($data){
	$dd = json_decode(htmlspecialchars_decode($data),true);
	//return 1111;
	return $dd['main'][0][1];
}