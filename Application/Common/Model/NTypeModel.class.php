<?php

namespace Common\Model;
use Think\Model;

class NTypeModel extends BaseModel{
	protected $_validate=array(
			array('typename','require','分类名称不能为空'),
			array('channeltype','0','模型不能为空',0,'notequal'),
			array('typename', '', '分类名称已经存在', 0, 'unique'),
          
	);

    function getTypeById(){

    }

}