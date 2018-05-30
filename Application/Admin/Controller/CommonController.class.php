<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/9
 * Time: 16:19
 */
namespace Admin\Controller;
use Think\Controller;
use Think\Page;

class CommonController extends BaseController{
    /*图片上传 ajax*/
    public function upload() {
        $response=array();
        if($_FILES){
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->savePath = 'images/';
            // 上传文件
            $info=$upload->upload();
            if (!$info) {
                $this->error($upload->getError());
            }
            if($_FILES['file']['size']){
                $response['filepath']='/Uploads/'.$info['file']['savepath'].$info['file']['savename'];
            }
            $this->ajaxReturn($response);
        }
    }

    public function getCity(){
        $province_id = I("post.province_id",0);
        $model_district = D('District');
        $str = '<option value=0>请选择</option>';
        if ($province_id != 0) {
            $province = $model_district->getDistrict($province_id);
            foreach($province as $val) {
                $str .= '<option value='.$val['id'].'>'.$val['name'].'</option>';
            }
        }
        echo $str;
        exit;
    }

    public function getArea(){
        $city_id = I("post.city_id",0);
        $model_district = D('District');
        $str = '<option value=0>请选择</option>';
        if ($city_id != 0) {
            $city = $model_district->getDistrict($city_id);
            foreach($city as $val) {
                $str .= '<option value='.$val['id'].'>'.$val['name'].'</option>';
            }
        }
        echo $str;
        exit;
    }

}

