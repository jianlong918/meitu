<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/10
 * Time: 9:41
 */
namespace Common\Model;
use Think\Model;

class AuthGroupModel extends BaseModel{
    protected $_validate = array(
        array('rules', 'require','权限设置不能为空'),
        array('title', 'require', '组名称不能为空'),
        array('title', '', '组名称已经存在', 0, 'unique'),
    );

    /**
     * 删除数据
     * @param	array	$map	where语句数组形式
     * @return	boolean			操作是否成功
     */

}