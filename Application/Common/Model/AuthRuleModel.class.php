<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/10
 * Time: 9:41
 */
namespace Common\Model;
use Think\Model;

class AuthRuleModel extends BaseModel{
    protected $_validate = array(
        array('name', 'require', '链接不能为空'),
        array('name', '', '链接已经存在',0,'unique'),
        array('title', 'require', '权限名称不能为空'),
        array('title', '', '权限名称已经存在', 0, 'unique'),
        array('condition','','',0,'length','0,100'),
    );

    public function getAuthruleByName($name){
        $auth_rule = $this->where("name='%s'",array($name))->find();
        return $auth_rule;
    }

    function getAuthRulebyPid($pid){
        $auth_rules=$this->where("pid=%d",array($pid))->select();
        return $auth_rules;
    }


}