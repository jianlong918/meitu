<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Page;

class PurviewController extends BaseController{
    protected $table='AuthRule';
    public function index(){
        $auth=new \Think\Auth();
        $menuOb=M('AuthRule');
        $menus=$menuOb->order('id asc')->select();
        foreach($menus as $k=>$v){
            if($menus[$k]['status']==0){
                $menus[$k]['status']='禁用';
            }elseif($menus[$k]['status']==1){
                $menus[$k]['status']='启用';
            }
        }

        $menu='';
        foreach($menus as $k=>$v){
            if($v['pid']==0) {
                $menu .= <<<EOF
      <tr class="odd gradeA">
        <td>{$v['id']}</td>
        <td>{$v['pid']}</td>
        <td>{$v['name']}</td>
        <td style="text-align:left">{$v['title']}</td>
        <td class="center">{$v['type']}</td>
        <td>{$v['status']}</td>
        <td>{$v['condition']}</td>
EOF;
             if($auth->check( 'admin/purview/add',  session('uid') )||$auth->check( 'admin/purview/update',  session('uid') )||$auth->check( 'admin/purview/del',  session('uid') ) ){
             $menu.=<<<EOF
             <td class="center">
EOF;
            }
                if($auth->check( 'admin/purview/add',  session('uid') )) {
                    $menu.= <<<EOF
                <a href="/admin/purview/add?pid={$v['id']}" class="badge badge-success">添加子菜单</a>&nbsp;&nbsp;
EOF;
                }
                if($auth->check( 'admin/purview/update',  session('uid') )) {
                    $menu .= <<<EOF
                 <a href="/admin/purview/update?id={$v['id']}" class="badge badge-primary">修改</a>&nbsp;&nbsp;
EOF;
                }
                if($auth->check( 'admin/purview/del',  session('uid') )) {
                    $menu .= <<<EOF
                 <a style="cursor:pointer;" class="badge badge-danger" onclick="del({$v['id']})">删除</a></td>
EOF;
               $menu.="</tr>";
                }
                foreach($menus as $a=>$b){
                    if($b['pid']==$v['id']) {
                        $menu .= <<<EOF
        <tr class="odd gradeA">
             <td>{$b['id']}</td>
             <td>{$b['pid']}</td>
             <td >{$b['name']}</td>
             <td style="text-align:left;text-indent:2em;">{$b['title']}</td>
             <td class="center">{$b['type']}</td>
             <td>{$b['status']}</td>
             <td>{$b['condition']}</td>
EOF;
             if($auth->check( 'admin/purview/add',  session('uid') )||$auth->check( 'admin/purview/update',  session('uid') )||$auth->check( 'admin/purview/del',  session('uid') ) ){
             $menu.=<<<EOF
             <td class="center">
EOF;
             }
             if($auth->check( 'admin/purview/add',  session('uid') )) {
                 $menu .= <<<EOF
             <a style="cursor:pointer;" class="badge badge-success" onclick='add({$b['pid']})'>添加子菜单</a>&nbsp;&nbsp;
EOF;
             }
             if($auth->check( 'admin/purview/update',  session('uid') )) {
                 $menu .= <<<EOF
            <a href = "/admin/purview/update?id={$b['id']}" class="badge badge-primary" > 修改</a>&nbsp;&nbsp;
EOF;
             }
              if($auth->check( 'admin/purview/del',  session('uid') )) {
                    $menu .= <<<EOF
                 <a style="cursor:pointer;" class="badge badge-danger" onclick="del({$b['id']})">删除</a></td>
EOF;
             }
              $menu.="</tr>";

           }
         }
        }
      }
        $this->assign('menu', $menu);// 赋值分页输出
        $this->display("index");
    }

    public function add(){
        if(IS_POST){
            $auth_rule = D($this->table);
            if($auth_rule->create()){
                $result = $auth_rule->add();
                if($result) {
                    $this->success('数据添加成功！',"/admin/purview/index");

                }else{
                    $this->error('数据添加错误！');
                }

            }else{
                $this->error($auth_rule->getError());
            }
            exit;
        }

        $id=I('get.pid',0,'int');
        if($id>0){
            $condition['id']=$id;
            $rule_title=M($this->table)->where($condition)->getField('title');
            $this->assign(array(
                'id'=>$id,
                'rule_title'=>$rule_title,
            ));
        }
        $this->display("add");
    }

    public function update(){
        if(IS_POST){
            $auth_rule = D($this->table);
            if($auth_rule->create()){
                $result = $auth_rule->save();
                if($result!==false) {
                    $this->success('数据编辑成功！',"/admin/purview/index");
                }else{
                    $this->error('数据编辑错误！');
                }
            }else{
                $this->error($auth_rule->getError());
            }
            exit;
        }
        $id = I("get.id",0,"int");
        if(!$id){
            $this->redirect("/admin/purview/index");
        }
        $rules=$this->getSinglebyId($id,'');
        $condition['pid']=0;
        $auth_rules=$this->getData('','',$condition);
        $this->assign(array(
            'rules'=>$rules,
            'pid'=>$rules['pid'],
            'auth_rules'=>$auth_rules,
        ));
        $this->display("update");
    }

    public function del(){
        $id=I('post.id',0,'int');
        if(!$id){
            die('数据有误');
        }
        $condition['pid']=$id;
        $rule_num=$this->getCount($condition);
        if(empty($rule_num)){
            $re=D($this->table)->deleteData(array('id'=>$id));
            if($re){
                $this->success('删除成功！');
            }else{
                $this->error('删除失败！');
            }
        }else{
            $this->error('该菜单有子级菜单，不能删除！');
        }

    }
}