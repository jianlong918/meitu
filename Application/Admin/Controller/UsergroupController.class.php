<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/10
 * Time: 13:39
 */
namespace Admin\Controller;
use Think\Controller;
use Think\Page;

class UsergroupController extends BaseController{
    protected $table='AuthGroup';
    public function index(){
        $data=$this->getPage(M($this->table),$condition='',$order='id desc',$limit=15,$field='');
        $this->assign(array(
            'list'=>$data['list'],
            'count'=>$data['count'],
            'page'=>$data['page'],
        ));
        $this->display("index");
    }

    public function add(){
        if(IS_POST){
            $auth_group = D($this->table);
            if($auth_group->create()){
                $result = $auth_group->add();
                if($result) {
                    $this->success('数据添加成功！',"/admin/usergroup/index");

                }else{
                    $this->error('数据添加错误！');
                }

            }else{
                $this->error($auth_group->getError());
            }
            exit;
        }
        $this->display("add");
    }

    public function update(){
        if(IS_POST){
            $auth_group = D($this->table);
            if($auth_group->create()){
                $result = $auth_group->save();
                if($result!==false) {
                    $this->success('数据编辑成功！',"/admin/usergroup/index");
                }else{
                    $this->error('数据编辑错误！');
                }
            }else{
                $this->error($auth_group->getError());
            }
            exit;
        }
        $id = I("get.id",0,"int");
        if(!$id){
            $this->redirect("/admin/usergroup/index");
        }
        $auth_group=$this->getSinglebyId($id,$field='');
        $this->assign('rules',$auth_group);
        $this->display("update");
    }

    public function del(){
        $id=I('post.id',0,'int');
        if(!$id){
            die('数据有误');
        }
        $re=D($this->table)->deleteData(array('id'=>$id));
        if($re){
            $this->success("删除成功","/admin/usergroup/index");
        }else{
            $this->error('删除失败');
        }
    }

    public function purview(){
        $id=I('get.id',0,'int');
        if(empty($id)){
            die('数据有误');
        }
        $map['id']=$id;
        $rules=M($this->table)->where($map)->getField('rules');
        $rules=explode(',',$rules);
        $menuOb=M('AuthRule');
        $condition['status']=1;
        $menus=$menuOb->order('id asc')->where($condition)->select();
        $menu='';
        $i=1;
        foreach($menus as $k=>$v){
            if($v['pid']==0){
                $checked='';
                if(in_array($v['id'],$rules)) {
                    $checked = "checked";
                }
                $menu.=<<<EOF
        <tr><td style="text-align: left"><input type=checkbox name="optid[]" id="parent{$i}" value={$v['id']} {$checked} onclick="check1({$i})">{$i}{$v['title']}</td></tr><tr class="odd gradeX"><td style="text-align: left">
EOF;

                foreach($menus as $a=>$b){
                    if($b['pid']==$v['id']){
                        $checked='';
                        if(in_array($b['id'],$rules)) {
                            $checked = "checked";
                        }
                        $menu.=<<<EOF
        <input type=checkbox name="optid[]" value={$b['id']} id="son{$b['id']}" class="son{$i}" {$checked} onclick="check({$b['id']})">{$b['title']}
EOF;
                        unset($menus[$a]);
                   }

                }
                unset($menus[$k]);
                $menu.='</td></tr>';
                $i++;
            }

        }
        $this->assign(array(
            'menu'=>$menu,
            'id'=>$id,
        ));
        $this->display("purview");
    }

    public function save(){
        $usergroup_id=I('post.id',0,'int');
        $ids=I('post.optid');
        $ids=implode(',',$ids);
        if(!empty($ids)){
            $data['rules']=$ids;
            $res=$this->UpdateSinglebyId($usergroup_id,$data);
        }else{
            $this->error("授权设置不能为空");
        }

       if($res!==false){
            $this->success("授权成功","/admin/usergroup/index");
        }else{
            $this->error("授权失败");

        }
    }
}