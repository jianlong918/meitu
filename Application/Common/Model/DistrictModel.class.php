<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/7
 * Time: 14:00
 */

namespace Common\Model;

use Think\Model;

class DistrictModel extends Model{
    function getDistrict($upid){
        $districts = $this->where("upid=%d",array($upid))->select();
        return $districts;
    }

    function getDistrictName($id){
        $district = $this->where("id=%d",array($id))->find();
        return $district;
    }
	
}