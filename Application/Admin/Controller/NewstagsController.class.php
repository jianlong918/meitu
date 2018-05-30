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

class NewstagsController extends BaseController{
    protected $table='NTagindex';
    protected $table_list='NTaglist';
    protected $sign=',';
    public function index(){
       $condition=array();
        /*分页*/
        $data=$this->getPage(M($this->table),$condition,$order='id desc',$limit=15,$field='');
        $this->assign(array(
            'data'=>$data,
        ));
        $this->display();

    }


     public function update(){
        $id=I('post.id',0,'int');
        if(empty($id)){
            $this->error('数据错误！');
        }
        $count=I('post.count');
        if(!preg_match('/^\+?(0|[1-9][0-9]*)$/',$count)){
            $this->error('点击数格式错误');
        }
        $re=M($this->table)->where(array('id'=>$id))->save(array('count'=>$count));
        if($re===FALSE){
            $this->error('操作失败');
        }else{
            $this->success('操作成功');
        }

    }

    public function del(){
        $id=I('post.id');
        $re_index=M($this->table)->where(array('tag'=>$id))->delete();
        if(!$re_index){
            $this->error('删除index失败！');
        }
        $re_list=M($this->table_list)->where(array('tag'=>$id))->delete();
        if(!$re_list){
            $this->error('删除list失败！');
        }
        $this->success('删除成功！');
    }



}
