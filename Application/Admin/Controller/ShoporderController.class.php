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

class ShoporderController extends BaseController{
    protected $table='SOrder';
    public function index(){
        $search = array();
        $order_sn=I('get.order_sn');
        if(!empty($order_sn)){
            $condition['order_sn']=array('like','%'.$order_sn.'%');
            $search['order_sn'] = $order_sn;
        }
        $status=I('get.status',0,'int');
        if(!empty($status)){
            $search['status'] = $status;
            $condition['status']=$status;
        }else{
            $condition['status']=array('neq',6);
        }

        $real_name=I('get.real_name');
        if(!empty($real_name)){
            $search['real_name'] = $real_name;
            $p_orderids = M("s_order_person")->where("name like '%".$real_name."%'")->getField("order_id",true);
            $p_orderids = $p_orderids?$p_orderids:"0";
            $condition['id']=array('in',$p_orderids);
        }

        $tel=I('get.tel');
        if(!empty($tel)){
            $search['tel'] = $tel;
            $p_orderids = M("s_order_person")->where("tel like '%".$tel."%'")->getField("order_id",true);
            $p_orderids = $p_orderids?$p_orderids:"0";
            $condition['id']=array('in',$p_orderids);
        }

        $product_name=I('get.product_name');
        if(!empty($product_name)){
            $search['product_name'] = $product_name;
            $proids = M("s_product")->where("name like '%".$product_name."%'")->getField("id",true);
            $condition['product_id']=array('in',$proids);
        }

        $s_yuyue=I('get.s_yuyue');
        $e_yuyue=I('get.e_yuyue');
        $search['s_yuyue'] = $s_yuyue;
        $search['e_yuyue'] = $e_yuyue;
        if(!empty($s_yuyue)){
            if(!empty($e_yuyue)){
                $condition['created_at']=array('between',$s_yuyue.",".$e_yuyue);
            }else{
                $condition['created_at']=array('egt',$s_yuyue);
            }
        }else if(!empty($e_yuyue)){
            if(!empty($s_yuyue)){
                $condition['created_at']=array('between',$s_yuyue.",".$e_yuyue);
            }else{
                $condition['created_at']=array('elt',$e_yuyue);
            }
        }

        $s_ruzhu=I('get.s_ruzhu');
        $e_ruzhu=I('get.e_ruzhu');
        if(!empty($s_ruzhu)){
            $search['s_ruzhu'] = $s_ruzhu;
            $condition['begin_time']=array('egt',$s_ruzhu);
        }
        if(!empty($e_ruzhu)){
            $search['e_ruzhu'] = $e_ruzhu;
            $condition['end_time']=array('elt',$e_ruzhu);
        }




        /*分页*/
        $order_status=C('order_status');
        unset($order_status[6]);
        $data=$this->getPage(M($this->table),$condition,$order='id desc',$limit=15,$field='');
        $this->assign(array(
            'data'=>$data,
            'order_sn'=>$order_sn,
            'order_status'=>$order_status,
            'condition'=>$condition,
            'search'=>$search
        ));
        $this->display();

    }
    public function cancel_index(){
        $order_sn=I('get.order_sn');
        $condition['status']=6;
        if(!empty($order_sn)){
            $condition['order_sn']=array('like','%'.$order_sn.'%');
        }

        $real_name=I('get.real_name');
        if(!empty($real_name)){
            $search['real_name'] = $real_name;
            $p_orderids = M("s_order_person")->where("name like '%".$real_name."%'")->getField("order_id",true);
            $p_orderids = $p_orderids?$p_orderids:"0";
            $condition['id']=array('in',$p_orderids);
        }

        $tel=I('get.tel');
        if(!empty($tel)){
            $search['tel'] = $tel;
            $p_orderids = M("s_order_person")->where("tel like '%".$tel."%'")->getField("order_id",true);
            $p_orderids = $p_orderids?$p_orderids:"0";
            $condition['id']=array('in',$p_orderids);
        }

        $product_name=I('get.product_name');
        if(!empty($product_name)){
            $search['product_name'] = $product_name;
            $proids = M("s_product")->where("name like '%".$product_name."%'")->getField("id",true);
            $condition['product_id']=array('in',$proids);
        }

        $s_yuyue=I('get.s_yuyue');
        $e_yuyue=I('get.e_yuyue');
        if(!empty($s_yuyue)){
            $search['s_yuyue'] = $s_yuyue;
            $condition['created_at']=array('egt',$s_yuyue);
        }
        if(!empty($e_yuyue)){
            $search['e_yuyue'] = $e_yuyue;
            $condition['created_at']=array('elt',$s_yuyue);
        }

        $s_ruzhu=I('get.s_ruzhu');
        $e_ruzhu=I('get.e_ruzhu');
        if(!empty($s_ruzhu)){
            $search['s_ruzhu'] = $s_ruzhu;
            $condition['begin_time']=array('egt',$s_ruzhu);
        }
        if(!empty($e_ruzhu)){
            $search['e_ruzhu'] = $e_ruzhu;
            $condition['end_time']=array('elt',$e_ruzhu);
        }

        /*分页*/
        $data=$this->getPage(M($this->table),$condition,$order='id desc',$limit=15,$field='');
        $this->assign(array(
            'data'=>$data,
            'order_sn'=>$order_sn,
        ));
        $this->display();
    }

    public function detail(){
        $id=I('get.id',0,'int');
        if(empty($id)){
            die('数据错误！');
        }
        $order=$this->getSinglebyId($id,$field='');
        $order_person=$this->getData('id asc','',array('order_id'=>$id),'s_order_person');
        $this->assign(array(
           'order'=>$order,
           'order_person'=>$order_person,
        ));
        $this->display();

    }


    public function change_status(){
        $order_id=I('post.order_id',0,'int');
        if(empty($order_id)){
            $this->error('数据错误！');
        }
        $status=I('post.status',0,'int');
        if(empty($status)){
            $this->error('状态不能为空！');
        }
        M()->startTrans();
        $order_initial=$this->getSinglebyId($order_id,$field='status,mid,total');
        $re_order=D($this->table)->editData(array('id'=>$order_id),array('status'=>$status));
        if(!$re_order){
            M()->rollback();
            $this->error("订单状态修改失败");
        }

        /*message*/
        $data_message['mid']=$order_initial['mid'];
        $data_message['type']=2;
        $data_message['content_id']=$status;
        $data_message['created_at']=date("Y-m-d H:i:s",time());
        $re_mes=M('message')->add($data_message);
        if(!$re_mes){
            M()->rollback();
            $this->error("消息添加失败");
        }

        M()->commit();
        $this->success('订单状态修改成功！');
    }

    public function cancel(){
        $order_id=I('post.id',0,'int');
        if(empty($order_id)){
            $this->error('数据错误!');
        }
        $order=$this->getSinglebyId($order_id,$field='status,total,mid');
        if($order['status']==3){
            $this->error('订单已完成，不可取消!');
        }elseif($order['status']==6){
            $this->error('该预约已取消！');
        }
        /*会员减积分*/
        M()->startTrans();
        $re_mem=$this->addNum($order['mid'],'balance',$order['total'],'s_member');
        if(!$re_mem){
            M()->rollback();
            $this->error('会员积分恢复失败!');
        }

        /*message 积分变动*/
        $mrs = sendSysMessage($order['mid'],3,1);

        /*pay_log*/
        $data['mid']=$order['mid'];
        $data['uid']=session('uid');
        $data['process_type']=4;
        $data['order_id']=$order_id;
        $data['amount']=$order['total'];
        $data['balance']=M('s_member')->where(array('id'=>$order['mid']))->getField('balance');
        $data['created_at']=date("Y-m-d H:i:s",time());
        $re_pay=M('s_pay_log')->add($data);
        if(!$re_pay){
            M()->rollback();
            $this->error('积分记录添加失败！');
        }
        /*order*/
        $re_order=D($this->table)->editData(array('id'=>$order_id),array('status'=>6));
        if(!$re_order){
            $this->error('取消失败!');
        }

        /*message*/
        $data_message['mid']=$order['mid'];
        $data_message['type']=2;
        $data_message['content_id']=4;
        $data_message['created_at']=date("Y-m-d H:i:s",time());
        $re_mes=M('message')->add($data_message);
        if(!$re_mes){
            M()->rollback();
            $this->error("消息添加失败");
        }

        M()->commit();
        $this->success('预约取消成功!');
    }

    public function del(){
        $id=I('post.id',0,'int');
        $re=D($this->table)->deleteData(array('id'=>$id));
        if(!$re){
            $this->error('删除失败！');
        }else{
            $this->success('删除成功！');
        }
    }
}
