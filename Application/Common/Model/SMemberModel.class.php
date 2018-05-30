<?php

namespace Common\Model;
use Think\Model;

class SMemberModel extends BaseModel{
	protected $_validate=array(
			array('real_name','require','姓名不能为空'),
            array('tel','require','电话不能为空'),
           // array('tel', '/^1[34578]\d{9}$/', "手机号码格式错误", 0, 'regex'),
            array('id_sn','require','身份证不能为空'),
            array('id_sn', '/^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X|x)$/', "身份证格式错误", 0, 'regex'),
	);


}