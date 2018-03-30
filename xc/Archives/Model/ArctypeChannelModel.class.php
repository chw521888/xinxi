<?php
namespace Archives\Model;
use Think\Model;
use Think\Model\ViewModel;

class ArctypeChannelModel extends Model{ 
    protected $_validate=array(
			     array('name','require','模型不能为空'),
			     array('channel_table','require','模型表不能为空')
	);

}

?>