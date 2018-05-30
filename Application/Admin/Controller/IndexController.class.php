<?php

namespace Admin\Controller;
use Think\Controller;

class IndexController extends BaseController {
    protected $table =  'user';
    /*获取用户组*/
    public function index(){
        $uid=session('uid');
        $user=$this->getSinglebyId($uid,$field='username,usergroup');
        $this->assign(array(
            'user'=>$user,
        ));
        $this->display();
    }
}