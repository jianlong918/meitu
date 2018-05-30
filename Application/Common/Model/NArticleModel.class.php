<?php

namespace Common\Model;
use Think\Model;

class NArticleModel extends BaseModel{
	protected $_validate=array(
			array('title','require','文章标题不能为空'),
			array('typeid','0','所属栏目不能为空',0,'notequal'),

	);



}