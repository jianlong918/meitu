<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/8
 * Time: 16:36
 */
namespace Admin\Controller;
use Think\Auth;
use Think\Controller;

class LoginController extends Controller {
    public function index(){
        if(IS_POST){
            $username = I("post.username");
            $password =I("post.password");
            $pwd=jiami($password);
            $userInfo = M("User")->where("userName='{$username}' and password='{$pwd}'")->find();
            if($userInfo == NULL){
                $this->error('登录失败,用户名或密码不正确!');
            }else{
                session('uid', $userInfo['id']);
                session('uinfo', $userInfo);
                $this->success('登录成功',"/admin/index/index");
            }
        }
        $this->display('./login'); // 输出模板
    }

    public function logout(){
        session(null);
        $this->redirect('/admin/login/index');
    }

}