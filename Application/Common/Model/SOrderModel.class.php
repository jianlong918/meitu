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

class SOrderModel extends BaseModel{
    protected $_validate=array(
        array('order_sn','','订单编号已经存在',0,'unique'),
        array('begin_time','require','开始时间不能为空'),
        array('end_time','require','结束时间不能为空'),
        array('product_id','require','产品id不能为空'),
    );

}