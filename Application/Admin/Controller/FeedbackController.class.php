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

class FeedbackController extends BaseController{
    protected $table='Feedback';
    public function index(){
        $condition['adminid']=array('eq',0);
        /*分页*/
        $data=$this->getPage(M($this->table),$condition,$order='id desc',$limit=15,$field='');
        foreach( $data['list'] as $key=>$val ){
            $condition_reply['mid']=$val['mid'];
            $condition_reply['adminid']=array('neq',0);
            $reply=M($this->table)->where($condition_reply)->getField('id');
            if(!empty($reply)){
                $data['list'][$key]['flag']=true;
            }else{
                $data['list'][$key]['flag']=false;
            }

        }
        $this->assign(array(
            'data'=>$data,
        ));
        $this->display();

    }

    public function reply_index(){
        $mid=I('get.mid',0,'int');
        if(empty($mid)){
            die('数据错误');
        }
        $condition['mid']=$mid;
        $data=$this->getPage(M($this->table),$condition,$order='id desc',$limit=15,$field='');
        $this->assign(array(
            'data'=>$data,
        ));
        $this->display();

    }

    public function reply(){
        $id=I('post.id',0,'int');
        if(empty($id)){
            $this->error('数据错误');
        }
        $mid=I('post.mid',0,'int');
        if(empty($mid)){
            $this->error('会员id不能为空！');
        }
        M()->startTrans();
        $content=trim(I('post.content'));
        $data['mid']=$mid;
        $data['adminid']=session('uid');
        $data['reply_id']=$id;
        $data['content']=$content;
        $data['created_at']=date("Y-m-d H:i:s",time());
        $re_reply=M($this->table)->add($data);
        if(!$re_reply){
            M()->rollback();
            $this->error('回复添加失败！');
        }

        /*message*/
        $data_message['mid']=$mid;
        $data_message['type']=1;
        $data_message['content_id']=1;
        $data_message['created_at']=date("Y-m-d H:i:s",time());
        $re_mes=M('message')->add($data_message);
        if(!$re_mes){
            M()->rollback();
            $this->error("消息添加失败");
        }
        M()->commit();
        $this->success('回复添加成功！');
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

    public function del_many(){
        $ids=I('post.ids');
        if(empty($ids)){
            $this->error('请选择留言！');
        }
        $condition['id']=array('in',$ids);
        $re=D($this->table)->deleteData($condition);
        if(!$re){
            $this->error('删除失败！');
        }
        $this->success('删除成功！');
    }

}
