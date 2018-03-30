<?php
namespace Contingent\Controller;
use Think\Controller;

class IndexShowVoteController extends \Common\Controller\CommonIndexController{

   //给作品投票
   function post_vote(){
		$type      = I('post.type','','make_number');
		$show_id   = I('post.show_id','','make_number');
		$show_info = D("Contingent/Show")->where("jshow.id=".$show_id)->find();
		if($show_info['id'] == ""){$this->error("参数错误",AJAX);}
		if($show_info['time_vote_stat'] > time()){$this->error("抱歉,投票还未开始！",AJAX);}
		if($show_info['time_vote_end'] < time()){$this->error("抱歉,投票已经结束！",AJAX);}

		$m_user = M('User');
		$m_show = M('Show');
		
		if($type == 1){
			$user = $m_user->where("id=".$this->user_id)->find();
			$vote = $user['vote'];
			if($vote <= 0){$this->error("您的微端投票机会已经用完!",AJAX);}

			$m_user->where("id=".$this->user_id)->setDec('vote');
		}else{
			$lasttime = strtotime(date('Y-m-d 23:59:59'));
			$vote = $_COOKIE['vote_array'];
			if($vote < 2){
				$value = (int)$vote + 1;
				setcookie("vote_array",$value,$lasttime);
			}
			if($vote >= 2){$this->error("您的PC投票机会已经用完!",AJAX);}
		}

		

		
		//1为微信端投票
		if($type == 1){
			$m_show->where("id='".$show_id."'")->setInc("num_vote");
		}else{
			$m_show->where("id='".$show_id."'")->setInc("pc_num_vote");
		}
		$m_show->where("id='".$show_id."'")->setInc("num_vote_show");


		S('info_list_0',NULL);
		S('info_list_'.$city_location_id,NULL);
		S('info_'.$show_info['id']);//作品id
		S('info2_'.$show_info['contingent_id']);//队伍id
	   
	   clear_dir_file(get_real_path()."data/runtime/Cache/");
	    clear_dir_file(get_real_path()."data/runtime/Data/");
	    clear_dir_file(get_real_path()."data/runtime/Logs/");
	    clear_dir_file(get_real_path()."data/runtime/Temp/");
	   $this->success('投票成功',AJAX);
	   
   }
 
 
}
?>