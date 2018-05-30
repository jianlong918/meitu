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

class ShopproductController extends BaseController{
    protected $table='SProduct';
    public function index(){
        $name=I('get.name');
        $typeid=I('get.typeid');
        $condition['is_del']=0;
        $search['name'] = $name;
        $search['typeid'] = $typeid;
        $types = M("s_type")->select();
        if(!empty($name)){
            $condition['name']=array('like','%'.$name.'%');
        }
        if(!empty($typeid)){
            $condition['typeid']=$typeid;
        }
        /*分页*/
        $data=$this->getPage(M($this->table),$condition,$order='updated_at desc,id desc',$limit=15,$field='');
        $this->assign(array(
            'data'=>$data,
            'search'=>$search,
            'types'=>$types,
        ));
        $this->display();

}
    public function add(){
        /*地区*/
        $model_district = D('District');
        $districts = $model_district->getDistrict(0);
        /*分类*/
        $types=$this->getAll('s_type', '',$field='id,typename,pid');
        $type_list=LimitlessListTypes($types,0,$deep=1);
        $this->assign(array(
            'districts'=>$districts,
            'type_list'=>$type_list,
        ));
        $this->display();
    }



    public function save(){
        $images=I('post.img');
        if(empty($images)){
            $this->error('请上传产品图片！');
        }
        if(empty($_POST['content'])){
            $this->error('基地详情不能为空！');
        }
        $_POST['images']=implode(',',$images);
        $_POST['created_at']=date("Y-m-d H:i:s",time());
        $updated_at=I('post.updated_at');
        if($updated_at==0){
            $_POST['updated_at']=date("Y-m-d H:i:s",time());
        }
        $typeOb=D($this->table);
        if($typeOb->create($_POST)){
            //数据入表
            $re=$typeOb->add();
            if($re){
                $this->success("添加成功","/admin/shopproduct/index");
            }else{
                $this->error("添加失败");
            }

        }else{
            $product=$typeOb->getError();//获取自动验证的错误提示
            $this->error($product);
        }
  }


     public function update(){
         $id=I('get.id',0,'int');
         if(empty($id)){
             die('数据错误！');
         }
         $product=$this->getSinglebyId($id,'*');
         /*地区*/
         $model_district = D('District');
         $districts = $model_district->getDistrict(0);
         if(!empty($product['province_id'])){
             $cities=$model_district->getDistrict($product['province_id']);
         }
         if(!empty($product['city_id'])){
             $areas=$model_district->getDistrict($product['city_id']);
         }
         /*图片*/
         if(!empty($product['images'])){
             $product['img_arr']=explode(',',$product['images']);
         }
         /*分类*/
         $types=$this->getAll('s_type', '',$field='id,typename,pid');
         $type_list=LimitlessListTypes($types,0,$deep=1,$product['typeid']);
         $this->assign(array(
             'product'=>$product,
             'districts'=>$districts,
             'cities'=>$cities,
             'areas'=>$areas,
             'type_list'=>$type_list,
         ));
         $this->display();

    }

    public function usave(){
        $images=I('post.img');
        if(empty($images)){
            $this->error('请上传产品图片！');
        }
        if(empty($_POST['content'])){
            $this->error('产品详情不能为空！');
        }
        $_POST['images']=implode(',',$images);
        $updated_at=I('post.updated_at');
        if($updated_at==0){
            $_POST['updated_at']=date("Y-m-d H:i:s",time());
        }
        $typeOb=D($this->table);
        if($typeOb->create($_POST)){
            //数据入表
            $re=$typeOb->save($_POST);
            if($re!==FALSE){
                $this->success("编辑成功","/admin/shopproduct/index");
            }else{
                $this->error("编辑失败");
            }

        }else{
            $product=$typeOb->getError();//获取自动验证的错误提示
            $this->error($product);
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

    /*批量删除*/
    public function del_many(){
        $ids=I('post.ids');
        if(empty($ids)){
            $this->error('请选择产品！');
        }
        $condition['id']=array('in',$ids);
        $re=D($this->table)->deleteData($condition);
        if(!$re){
            $this->error('删除失败！');
        }
        $this->success('删除成功！');
    }

    public function del_img(){
        $path=I('post.path');
        $id=I('post.id');
        $product=$this->getSinglebyId($id,'images');
        $img_arr=explode(',',$product['images']);
        $img=array($path);
        $img_new=array_diff($img_arr,$img);
        $data['images']=implode(',',$img_new);
        $re=$this->UpdateSinglebyId($id,$data);
        if($re){
            $this->success('删除成功！');
        }else{
            $this->error('删除失败！');
        }
    }
}
