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

class AskController extends BaseController{
    protected $table='Ask';
    public function index(){
        /*分页*/
        $data=$this->getPage(M($this->table),'',$order='id desc',$limit=15,$field='');
        $this->assign(array(
            'data'=>$data,
        ));
        $this->display();
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
