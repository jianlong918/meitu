<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/9
 * Time: 16:19
 */
namespace Admin\Controller;
use Think\Auth;
use Think\Controller;
use Think\Page;

class UserController extends BaseController{
    protected $table='User';
    public function index(){
        /*判断是否为管理员*/
        $condition=is_admin(1,'id');
        /*用户组*/
        $user_groups=M('auth_group')->getField('id,title');
        /*搜索*/
        $usergroup=I('get.usergroup');
        if(!empty($usergroup)){
            $condition['usergroup']=$usergroup;
        }
        $auth=new Auth();
        if($auth->check("admin/user/myself",session('uid'))){
            $condition['id']=session('uid');
        }
        /*分页*/
        $data=$this->getPage(M($this->table),$condition,$order='',$limit=15,$field='');

        $this->assign(array(
            'data'=>$data,
            'user_groups'=>$user_groups,
            'condition'=>$condition,
        ));

        $this->display("index");
    }


    public function add(){
        $condition['status']=1;
        $usergroup=$this->getData('','',$condition,$table='AuthGroup');
        $this->assign('usergroup',$usergroup);
        $this->display("add");
    }

    public function save(){
        if(empty($_POST['password'])){
            $this->error("密码不能为空");
        }
        $usergroup=I('post.usergroup');
        if(empty($usergroup)){
            $this->error('用户组不能为空！');
        }
        $userOb=D($this->table);
        $_POST['created_at']=date("Y-m-d H:i:s",time())	;
        $_POST['lasttime']=date("Y-m-d H:i:s",time());

        if($userOb->create($_POST)){
            $re_user=$userOb->add();
            if($re_user){
                $authOb=M("AuthGroupAccess");
                    $data['uid']=$re_user;
                    $data['group_id']=$_POST['usergroup'];
                    $re_auth=$authOb->add($data);
                    if(!$re_auth){
                        $this->error('添加用户组失败！');
                    }
                $this->success('用户添加成功！',"/admin/user/index");
            }else {
                $this->error('添加用户失败！');
            }
        }else{
            $user=$userOb->getError();//获取自动验证的错误提示
            $this->error($user);
        }
    }

    public function del(){
        $id=I('post.id',0,'int');
        if(!empty($id)){
            $re_user=D($this->table)->deleteData(array('id'=>$id));
            if($re_user){
                $re_auth=D('AuthGroupAccess')->deleteData(array('uid'=>$id));
                if($re_auth){
                    $this->success("删除成功!","/admin/user/index");
                }else{
                    $this->error('删除失败！');
                }
            }else{
                $this->error('用户删除失败！');
            }
        }
    }


    public function update(){
        $id=I('get.id',0,'int');
        if(!empty($id)){
            $user=$this->getSinglebyId($id,$field='');
            $condition['status']=1;
            $usergroup=$this->getData('','',$condition,$table='AuthGroup');
        }else{
            $this->redirect("/admin/user/index");
        }
        $this->assign(array(
            'usergroup'=>$usergroup,
            'uarr'=>$user,
        ));
        $this->display();
    }

    public function usave(){
        if(IS_POST) {
            $userOb = D("User");
            $_POST['updated_at'] = date("Y-m-d H:i:s", time());
            $_POST['lasttime']=date("Y-m-d H:i:s",time());
            if ($userOb->create($_POST)) {
                    $re = $userOb->save();
                    if ($re!==false) {
                        $uid=I('post.id');
                        D("AuthGroupAccess")->deleteData(array('uid'=>$uid));
                            $data['uid']=$uid;
                            $data['group_id']=$_POST['usergroup'];
                            M("AuthGroupAccess")->add($data);
                        $this->success("修改成功", "/admin/user/index");
                    } else {
                        $this->error("修改失败");
                    }
            } else {
                $message = $userOb->getError();//获取自动验证的错误提示
                $this->error($message);
            }
        }

    }

    public function password(){
        if(IS_POST) {
            $password = I('post.password');
            $password1 = I('post.password1');
            $old_password = I('post.old_password');
            if (empty($password) || empty($password1) || empty($old_password)) {
                $this->error('密码不能为空');
            }
            if ($password !== $password1) {
                $this->error('两次输入密码不一致');
            }
            $username = I('post.username');
            $pwd = jiami($old_password);
            $userInfo = M("User")->where("userName='{$username}' and password='{$pwd}'")->find();
            if (empty($userInfo)) {
                $this->error("用户名或密码错误");
            }

            $condition['id']=I('post.id');
            $data['password'] = jiami($password);
            $re=D($this->table)->editData($condition,$data);
            if ($re !== false) {
                $this->success("修改成功", "/admin/user/index");
            } else {
                $this->error("修改失败");
            }
        }
        $id=I('get.id',0,'int');
        if(!empty($id)){
            $map['id']=$id;
            $username=M($this->table)->where($map)->getField('username');
            $this->assign(array(
                'id'=>$id,
                'username'=>$username,
            ));
        }else{
            $this->redirect("/admin/user/index");
        }
        $this->display();
    }

}

