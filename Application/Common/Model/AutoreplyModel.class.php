<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/10
 * Time: 9:41
 */
namespace Common\Model;
use Think\Model;

class AutoreplyModel extends BaseModel{
    protected $_validate = array(
        array('content', 'require', '回复内容不能为空！'),
    );
}