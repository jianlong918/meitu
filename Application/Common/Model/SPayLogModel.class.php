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

class SPayLogModel extends BaseModel{
    protected $_validate=array(
        array('pay','require','充值金额不能为空'),
    );

}