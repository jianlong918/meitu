<?php

namespace Common\Model;
use Think\Model;

class AskModel extends BaseModel{
	protected $_validate=array(
			array('content','require','内容不能为空'),
	);


}