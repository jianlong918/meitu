<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/10
 * Time: 9:41
 */
namespace Common\Model;
use Think\Model;

class SLevelModel extends BaseModel{
    protected $_validate = array(
        array('level_name', 'require', '等级名称不能为空！'),
        array('amount', 'require', '会员积分不能为空!'),
        array('level_name', '', '等级名称已经存在', 0, 'unique'),
    );
}