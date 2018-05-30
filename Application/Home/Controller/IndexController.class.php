<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends BaseController {
    protected $table='s_product';
    public function index(){
        $banners=$this->getData($order='sortrank asc','',array('position_sn'=>'banner_top'),$table='ads');
        $types=$this->getData($order='sortrank asc','6','',$table='s_type');
        $products=M($this->table)->where(array('is_recommend'=>1))->getField('id,name,typeid,litpic');
        $this->assign(array(
           'banners'=>$banners,
           'types'=>$types,
           'products'=>$products,
        ));
        $this->display();
    }

    public function p_list(){
        $typeid=I('get.typeid',0,'int');
        if(empty($typeid)){
            die('数据错误');
        }
        $typename = getFieldShow('s_type','typename',array('id'=>$typeid));
        $products=M($this->table)->where(array('typeid'=>$typeid))->getField('id,name,typeid,litpic');
        $this->assign(array(
            'top_title' => $typename,
            'products'=>$products,
        ));
        $this->display();
    }

    public function p_list_index(){
        $top_title = "地产分类";
        $types=$this->getData($order='sortrank asc','6','',$table='s_type');
        $types_product=$types;
        foreach($types_product as $k=>$v){
            $types_product[$k]['product']=M($this->table)->where(array('typeid'=>$v['id']))->getField('id,name,litpic');
        }
        $this->assign(array(
            'top_title' => $top_title,
            'types'=>$types,
            'types_product'=>$types_product,
        ));
        $this->display();
    }

    public function p_detail(){
        $id=I('get.id',0,'int');
        if(empty($id)){
            die('数据错误');
        }
        $book_day=C('book_day');
        $product=$this->getSinglebyId($id,$field='*');
        $product['type']=getFieldShow('s_type','typename',array('id'=>$product['typeid']));
        $product['province']=getFieldShow('district','name',array('id'=>$product['province_id']));
        $product['city']=getFieldShow('district','name',array('id'=>$product['city_id']));
        $product['area']=getFieldShow('district','name',array('id'=>$product['area_id']));
        $img_arr=explode(',',$product['images']);
        /*推荐图片*/
        $condition['typeid']=$product['typeid'];
        $condition['is_recommend']=1;
        $condition['id']=array('neq',$id);
        $product_add=M($this->table)->where($condition)->limit(2)->getField('id,name,litpic');
        $this->assign(array(
            'top_title' => $product['type'],
            'product'=>$product,
            'book_day'=>$book_day,
            'img_arr'=>$img_arr,
            'product_add'=>$product_add,
        ));
        $this->display();
    }
}