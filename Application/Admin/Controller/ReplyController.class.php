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

class ReplyController extends BaseController{
    protected $table='Autoreply';
    public function index(){
        /*分页*/
        $data=$this->getPage(M($this->table),'',$order='id desc',$limit=15,$field='');
        $this->assign(array(
            'data'=>$data,
        ));
        $this->display();
    }

    public function add(){
        $this->display();
    }

    public function save(){
        $replyOb=D($this->table);
        if($replyOb->create($_POST)){
            //数据入表
            $re=$replyOb->add();
            if($re){
                $this->success("添加成功","/admin/reply/index");
            }else{
                $this->error("添加失败");
            }

        }else{
            $reply_error=$replyOb->getError();//获取自动验证的错误提示
            $this->error($reply_error);
        }
    }

    public function update(){
        $id=I('get.id',0,'int');
        if(empty($id)){
            die('数据错误!');
        }
        $reply=$this->getSinglebyId($id);
        $this->assign(array(
           'reply'=>$reply,
        ));
        $this->display();

    }

    public function usave(){
        $replyOb=D($this->table);
        if($replyOb->create($_POST)){
            //数据入表
            $re=$replyOb->save();
            if($re!==FALSE){
                $this->success("编辑成功","/admin/reply/index");
            }else{
                $this->error("编辑失败");
            }

        }else{
            $reply_error=$replyOb->getError();//获取自动验证的错误提示
            $this->error($reply_error);
        }
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
