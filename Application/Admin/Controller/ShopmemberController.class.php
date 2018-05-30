<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/14
 * Time: 9:49
 */
namespace Admin\Controller;
use Think\Controller;
use Think\Page;

class ShopmemberController extends BaseController{
    protected $table='SMember';
    public function index(){
        $search = array();
        $name=I('get.name');
        if(!empty($name)){
            $search['real_name'] = $name;
            $condition['real_name']=array('like','%'.$name.'%');
        }

        $tel=I('get.tel');
        if(!empty($tel)){
            $search['tel'] = $tel;
            $condition['tel']=array('like','%'.$tel.'%');
        }

        $id_sn=I('get.id_sn');
        if(!empty($id_sn)){
            $search['id_sn'] = $id_sn;
            $condition['id_sn']=array('like','%'.$id_sn.'%');
        }
        $level=I('get.level');
        if(!empty($level)){
            $search['level'] = $level;
            $condition['level_id']=$level;
        }

        $level=$this->getData('','','',$table='s_level');
        /*分页*/
        $data=$this->getPage(M($this->table),$condition,$order='id desc',$limit=15,$field='');
        $this->assign(array(
            'data'=>$data,
            'name'=>$name,
            'level'=>$level,
            'search'=>$search,
        ));
        $this->display();

    }

    public function pay_log(){
        $member_id=I('get.id',0,'int');
        if(empty($member_id)){
            $this->error('数据错误!');
        }
        $type=I('get.type',0,'int');
        if(!empty($type)){
            $condition['process_type']=$type;
        }
        C('TOKEN_ON',false);
        $process_type=C('process_type');
        $condition['mid']=$member_id;
        $data=$this->getPage(M('s_pay_log'),$condition,$order='id asc',$limit=20,$field='');
        $this->assign(array(
           'data'=>$data,
           'process_type'=>$process_type,
            'type'=>$type,
        ));
        $this->display();
    }

    /*充值 注意防重复提交*/
    public function recharge(){
        $member_id=I('post.mid',0,'int');
        $paytype=I('post.paytype',0,'int');
        if(empty($member_id)){
            $this->error('数据错误');
        }
        $return_url=I('post.httpref');
        $pay=I('post.pay');

        M()->startTrans();
        $payOb=D('SPayLog');
        if($payOb->create($_POST)){
            $balance_old=M($this->table)->where(array('id'=>$member_id))->getField('balance');
            if($paytype==1){
                $_POST['balance']=$pay+$balance_old;
                $_POST['process_type']=1;
            }else{
                $_POST['balance'] = $balance_old - $pay;
                $_POST['process_type']=11;
            }
//            $_POST['balance']=$pay+$balance_old;
            $_POST['mid']=$member_id;
            $_POST['uid']=session('uid');
            $_POST['amount']=$pay;
            $_POST['created_at']=date("Y-m-d H:i:s",time());
            //数据入表
            $re=$payOb->add($_POST);
            if(!$re){
                M()->rollback();
                $this->error("操作失败");
            }

            /*message 积分变动*/
            $mrs = sendSysMessage($member_id,3,1);

            $re_member=D($this->table)->editData(array('id'=>$member_id),array('balance'=>$_POST['balance']));
            if(!$re_member){
                M()->rollback();
                $this->error("操作失败");
            }

            M()->commit();
        }
        $this->success('操作成功！',$return_url);
    }


    public function change_level(){
        $member_id=I('post.id',0,'int');
        if(empty($member_id)){
            $this->error('数据错误！');
        }
        $level_id=I('post.level_id');
        if(empty($level_id)){
            $this->error('数据错误！');
        }
        $member=$this->getSinglebyId($member_id,$field='level_id,balance');
        if($member['level_id']<=1){
            $amount=M('s_level')->where(array('id'=>$level_id))->getField('amount');
            $condition['balance']=$member['balance']+$amount;
            /*pay_log*/
            $data['balance']=$condition['balance'];
            $data['mid']=$member_id;
            $data['uid']=session('uid');
            $data['process_type']=3;
            $data['amount']=$amount;
            $data['created_at']=date("Y-m-d H:i:s",time());
            $re=M('s_pay_log')->add($data);
            if(!$re){
                $this->error('积分记录添加失败！');
            }

            /*message 积分变动*/
            $mrs = sendSysMessage($member_id,3,1);
        }else{
            if($level_id==1){
                /*pay_log*/
                $data['balance']=0;
                $data['mid']=$member_id;
                $data['uid']=session('uid');
                $data['process_type']=12;
                $data['amount']=0;
                $data['created_at']=date("Y-m-d H:i:s",time());
                M('s_pay_log')->add($data);
                $condition['balance']=0;
            }
        }



        $condition['level_id']=$level_id;
        $re=D($this->table)->editData(array('id'=>$member_id),$condition);
        if($re===FALSE){
            $this->error('操作失败！');
        }else{
            $this->success('操作成功！');
        }
    }

    public function del(){
        $id=I('post.id',0,'int');
        if(!empty($id)){
            $re_user=D($this->table)->deleteData(array('id'=>$id));
            if($re_user){
                    $this->success("删除成功!","/admin/user/index");
            }else{
                $this->error('用户删除失败！');
            }
        }
    }

    public function update(){
        $id=I('get.id',0,'int');
        if(!empty($id)){
            $meminfo=$this->getSinglebyId($id,$field='');
        }else{
            $this->redirect("/admin/shopmember/index");
        }
        $this->assign(array(
            'meminfo'=>$meminfo,
        ));
        $this->display();
    }

    public function usave(){
        $id = I('post.id');
        if($id){
            $passwd = I('post.passwd');
            $expire_at = I('post.expire_at');
            $data['expire_at'] = $expire_at;
            if($passwd!=""){
                $data['passwd'] = pwdjiami($passwd);
            }
            $m_member = M("s_member");
            $rs = $m_member->where('id='.$id)->save($data); // 根据条件更新记录
            if($rs!==FALSE){
                $this->success('操作成功！');
            }else{
                $this->error('失败！');
            }
        }

    }

}
