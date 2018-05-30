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

class NewstypeController extends BaseController{
    protected $table='NType';
    public function index(){
        $data=$this->getData('sortrank asc','','');
        if(is_array($data)&&!empty($data)){
            $show=$this->LimitlessTypes($data,0);
            $this->assign('show',$show);
        }
        $this->display();
    }

    public function add(){
            $id=I('get.pid',0,'int');
            if($id>0){
                $type=$this->getSinglebyId($id,'typename');
                $typename=$type['typename'];
                $this->assign('typename',$typename);
            }
            $this->assign(array(
                'id'=>$id,
            ));
            $this->display();
    }

    public function save(){
        $typeOb=D($this->table);
        if($typeOb->create($_POST)){
            //数据入表
            $re=$typeOb->add();
            if($re){
                $this->success("添加成功","/admin/newstype/index");
            }else{
                $this->error("添加失败");
            }

        }else{
            $dealer=$typeOb->getError();//获取自动验证的错误提示
            $this->error($dealer);
        }
    }


    public function update(){
        $id=I('get.id',0,'int');
        if(empty($id)){
            die('数据有误！');
        }
        $type=$this->getSinglebyId($id,'');
        $types=$this->getAll('', '',$field='id,typename,pid');
            if(is_array($types)&&!empty($types)){
                $pid=M($this->table)->where(array('id'=>$id))->getField('pid');
                $res=LimitlessListTypes($types,0,1,$pid);
                $this->assign('res',$res);
            }
        $this->assign(array(
            'type'=>$type,
        ));
        $this->display();

    }

    public function usave(){
        $typeOb=D($this->table);
        if($typeOb->create($_POST)){
            //数据入表
            $re=$typeOb->save();
            if($re!==false){

                $this->success("修改成功","/admin/newstype/index");
            }else{

                $this->error("修改失败");
            }

        }else{
            $message=$typeOb->getError();//获取自动验证的错误提示
            $this->error($message);
        }
    }


    public function del(){
        $id=I('post.id',0,'int');
        $type=M($this->table)->where(array('pid'=>$id))->getField('id');
        if(empty($type)){
            $re=M($this->table)->where("id=%d",array($id))->delete();
            if($re){
                $ajaxdata["info"]="删除成功";
                $ajaxdata["status"]=1;
            }else{
                $ajaxdata["info"]="删除失败";
                $ajaxdata["status"]=0;
            }
        }else{
            $ajaxdata["info"]="该分类有子级分类，不能删除";
            $ajaxdata["status"]=-1;
        }

        $this->ajaxReturn($ajaxdata);
    }


    /*递归获取栏目*/
    private function LimitlessTypes($data,$pId,$deep=1){
        $auth=new \Think\Auth();
        $html='';
        foreach($data as $k=>$v){
            if($v['pid']==$pId){
                $v['typename']=str_repeat('&nbsp;&nbsp;', $deep).$v['typename'];
                $previewurl = "";
                if($v['ispart']==1){
                    $previewurl = U("Wehome/Newsarticle/index",array("id"=>$v['id']));
                }
                    $html.=<<<EOF
                           <tr class="odd gradeX">
                           <td>{$v['id']}</td>
                           <td style="text-align:left;">{$v['typename']}</td>
                           <td style="text-align:left;">{$v['sortrank']}</td>
EOF;
                    if($auth->check( 'admin/newstype/add',  session('uid') )||$auth->check( 'admin/newstype/update',  session('uid') )||$auth->check( 'admin/newstype/del',  session('uid') ) ){
                    $html.=<<<EOF
                           <td class="center">
EOF;
                    if($auth->check( 'admin/newstype/add',  session('uid') )) {
                    $html .= <<<EOF
                           <a href="/admin/newstype/add?pid={$v['id']}" class="badge badge-success">添加子分类</a>&nbsp;&nbsp;
EOF;
                    }
                    if($auth->check( 'admin/newstype/update',  session('uid') )) {
                    $html .= <<<EOF
                           <a href="/admin/newstype/update?id={$v['id']}" class="badge badge-primary">修改</a>&nbsp;&nbsp;
EOF;
                    }
                    if($auth->check( 'admin/newstype/del',  session('uid') )) {
                    $html .= <<<EOF
                           <a href="javascript:void(0);"  class="badge badge-danger" onclick="confirm_del(this)" data-url="/admin/newstype/del" data-id="{$v['id']}" data-msg="确定要删除吗" >删除</a>
EOF;
                    }
                    $html .= <<<EOF
                           <a href="{$previewurl}" class="badge badge-danger"  target="_blank" >预览</a>
EOF;
                    $html.= "</td>";
                    }
                    $html.="</tr>";

                    $html.=$this->LimitlessTypes($data,$v['id'],++$deep);
                    --$deep;
            }
        }
        return $html;
    }

}
