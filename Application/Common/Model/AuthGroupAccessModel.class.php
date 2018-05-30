<?php
namespace Common\Model;
use Think\Model;
/**
 * 权限规则model
 */
class AuthGroupAccessModel extends BaseModel{

	/**
	 * 根据group_id获取全部用户id
	 * @param  int $group_id 用户组id
	 * @return array         用户数组
	 */
	public function getUidsByGroupId($group_id){
		$user_ids=$this
			->where(array('group_id'=>$group_id))
			->getField('uid',true);
		return $user_ids;
	}

}
