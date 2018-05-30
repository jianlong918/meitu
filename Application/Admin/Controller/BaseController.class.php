<?php

namespace Admin\Controller;
use Think\Page;
use Think\Auth;
use Think\Controller;

class BaseController extends Controller {

    public function _initialize(){
        $auth=new Auth();
        if(!$auth->check( MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME,  session('uid') )){
           redirect("/Admin/login/index");
        }
        if(!session('uid')){
            redirect("/Admin/login/index");
        }
        $this->assign('auth',$auth);
    }

    protected function getAll($table='', $order = '',$field='*'){
        $table = $table==''?$this->table:$table;
        $allOb = M($table);
        if (!empty($order)) {
            $all = $allOb->order($order)->field($field)->select();
        } else {
            $all = $allOb->field($field)->select();
        }

        return $all;
    }

    protected function getSinglebyId($id,$field='',$table=''){
        $table = $table==''?$this->table:$table;
        $singleOb=M($table);
        $single=$singleOb->where('id=%d',$id)->field($field)->find();
        return $single;

    }

    protected function getSinglebyMid($mid,$field='',$table=''){
        $table = $table==''?$this->table:$table;
        $singleOb=M($table);
        $single=$singleOb->where('mid=%d',$mid)->field($field)->find();
        return $single;

    }

    protected function getData($order,$limit,$condition,$table=''){
        $table = $table==''?$this->table:$table;
        $dataOb=M($table);
        $data=$dataOb->where($condition)->order($order)->limit($limit)->select();
        return $data;
    }

    protected function getCount($condition,$table=''){
        $table = $table==''?$this->table:$table;
        $dataOb=M($table);
        $data=$dataOb->where($condition)->count();
        return $data;
    }

    /**
     * @param $id
     * @param $data 数组
     * @param string $table 表名
     * @return bool
     */
    protected function UpdateSinglebyId($id,$data,$table=''){
        $table = $table==''?$this->table:$table;
        $singleOb=M($table);
        $re=$singleOb->where("id=%d",array($id))->save($data);
        return $re;
    }

    protected function UpdateSinglebyMid($mid,$data,$table=''){
        $table = $table==''?$this->table:$table;
        $singleOb=M($table);
        $re=$singleOb->where("mid=%d",array($mid))->save($data);
        return $re;
    }

    protected function addNum($id,$field,$num,$table){
        $table = $table==''?$this->table:$table;
        $singleOb=M($table);
        $result = $singleOb->where('id=%d',$id)->setInc($field, $num);
        return $result;
    }

    protected function reduceNum($id,$field,$num,$table){
        $table = $table==''?$this->table:$table;
        $singleOb=M($table);
        $result = $singleOb->where('id=%d',$id)->setDec($field, $num);
        return $result;
    }

    /**
     * 获取分页数据
     * @param  subject  $model  model对象
     * @param  array    $map    where条件
     * @param  string   $order  排序规则
     * @param  integer  $limit  每页数量
     * @param  integer  $field  $field
     * @return array            分页数据
     */
    protected function getPage($model,$map,$order='',$limit=10,$field=''){
        $count=$model
            ->where($map)
            ->count();
        $page=new Page($count,$limit);
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        // 获取分页数据
        if (empty($field)) {
            $list=$model
                ->where($map)
                ->order($order)
                ->limit($page->firstRow.','.$page->listRows)
                ->select();
        }else{
            $list=$model
                ->field($field)
                ->where($map)
                ->order($order)
                ->limit($page->firstRow.','.$page->listRows)
                ->select();
        }
        $data=array(
            'list'=>$list,
            'count'=>$count,
            'page'=>$page->show()
        );
        return $data;
    }
}