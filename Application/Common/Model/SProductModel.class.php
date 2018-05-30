<?php

namespace Common\Model;
use Think\Model;

class SProductModel extends BaseModel{
	protected $_validate=array(
			array('name','require','产品名称不能为空'),
			array('typeid','0','所属分类不能为空',0,'notequal'),
		    array('max_num','require','限住人数不能为空'),
		    array('price','require','所需积分不能为空'),
            array('market_price','require','所需积分不能为空'),
		    array('description','require','产品简介不能为空'),
		    array('province_id','0','省份不能为空',0,'notequal'),
		    array('city_id','0','城市不能为空',0,'notequal'),
		    array('content','require','基地详情不能为空'),

	);

}