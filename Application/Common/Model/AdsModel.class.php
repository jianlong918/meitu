<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/10
 * Time: 9:41
 */
namespace Common\Model;
use Think\Model;

class AdsModel extends BaseModel{
    protected $_validate = array(
        array('title', 'require', '广告名称不能为空！'),
        array('position_sn', 'require', '位置标识不能为空！'),
        array('img', 'require', '图片不能为空！'),
    );
}