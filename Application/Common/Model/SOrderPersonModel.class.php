<?php
/**
 * Created by qinxuelan.
 * 众芳摇落独暄妍，占尽风情向小园。
 * 疏影横斜水清浅，暗香浮动月黄昏。
 * 霜禽欲下先偷眼，粉蝶如知合断魂。
 * 幸有微吟可相狎，不须檀板共金尊。
 * Date: 2017/9/12
 * Time: 9:04
 */
namespace Common\Model;
use Think\Model;

class SOrderPersonModel extends BaseModel{
    protected $_validate=array(
        array('name','require','住户人员不能为空'),
        array('tel','require','联系方式不能为空'),
        array('tel', '/^1[34578]\d{9}$/', "手机号码格式错误", 0, 'regex'),
        array('id_sn','require','身份证号不能为空'),
        array('id_sn', '/^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X|x)$/', "身份证号码格式错误", 0, 'regex'),
    );

}