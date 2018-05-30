<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/10
 * Time: 9:41
 */
namespace Common\Model;
use Think\Model;

class UserModel extends BaseModel{
    protected $_validate = array(
        array('username', 'require', '请填写账号！',1),
        array('realname', 'require', '请填写真实姓名！',1),
        array('username', '', '名字已经存在', 0, 'unique'),
        array('mobile', 'require', "手机号码不能为空"),
        array('mobile', '/^1[34578]\d{9}$/', "手机号码格式错误", 0, 'regex'),

    );

    protected $_auto = array (
        array('password','jiami',1,'function') ,
    );

}