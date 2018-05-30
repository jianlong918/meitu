<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/23
 * Time: 16:00
 */
namespace Admin\Controller;
use Think\Controller;
use Think\Page;

class AuthController extends  BaseController{
    public function index(){
        $modules = array('Admin');  //模块名称
        $i = 0;
        foreach ($modules as $module) {
            $all_controller = $this->getController($module);
            foreach ($all_controller as $controller) {
                $controller_name = $controller;
                $all_action = $this->getAction($module, $controller_name);
                foreach ($all_action as $action) {
                    $controller=lcfirst($controller);
                    $array_del=array('login','index','auth');
                    if(!in_array($controller,$array_del)){
                        $data[$i] = array(
                            'name' => 'admin/'.$controller . '/' . $action,
                            'status' => 1
                        );
                    }
                    $i++;
                }
            }
        }

        foreach($data as $key=>$val){
            $auth_ruleOb=D('AuthRule');
            $auth_rule=$auth_ruleOb->getAuthruleByName($val['name']);
            if(empty($auth_rule)){
                $new_rule[]=$val['name'];
            }

        }


        $auth_ruleOb=D('AuthRule');
        $auth_rules=$auth_ruleOb->getAuthRulebyPid(0);
        $this->assign('auth_rules', $auth_rules);

        $this->assign('new_rule',$new_rule);
        $this->display("index");
    }

    public function save_many(){
        $pid=I('post.pid');
        $name=I('post.name');
        $title=I('post.title');
        $status=I('post.status');
        $condition=I('post.condition');
        //计算数组长度
        $number=count($name);

        $data=array();
        for($i=0;$i<$number;$i++){
            $data[$i]['pid']=$pid[$i];
            $data[$i]['name']=$name[$i];
            $data[$i]['title']=$title[$i];
            $data[$i]['status']=$status[$i];
            $data[$i]['condition']=$condition[$i];
        }

        foreach($data as $k=>$v) {
            $auth['pid'] = $v['pid'];
            $auth['name'] = $v['name'];
            $auth['title'] = $v['title'];
            $auth['status'] = $v['status'];
            $auth['condition'] = $v['condition'];

            $authOb=M('AuthRule');
            $result = $authOb->add($auth);

        }

        if($result){
            $this->success("添加成功","/admin/purview/index");
        }


    }

    //获取所有控制器名称
    protected function getController($module){
        if(empty($module)) return null;
        $module_path = APP_PATH . '/' . $module . '/Controller/';  //控制器路径
        if(!is_dir($module_path)) return null;
        $module_path .= '/*.class.php';
        $ary_files = glob($module_path);
        foreach ($ary_files as $file) {
            if (is_dir($file)) {
                continue;
            }else {
                $files[] = basename($file, C('DEFAULT_C_LAYER').'.class.php');
            }
        }
        return $files;
    }

    //获取所有方法名称  public方法
    protected function getAction($module, $controller){
        if(empty($controller)) return null;
        $content = file_get_contents(APP_PATH . '/'.$module.'/Controller/'.$controller.'Controller.class.php');
        preg_match_all("/.*?public.*?function(.*?)\(.*?\)/i", $content, $matches);
        $functions = $matches[1];
        //排除部分方法
        $inherents_functions = array('_initialize','__construct','getActionName','isAjax','display','show','fetch','buildHtml','assign','__set','get','__get','__isset','__call','error','success','ajaxReturn','redirect','__destruct','_empty');
        foreach ($functions as $func){
            $func = trim($func);
            if(!in_array($func, $inherents_functions)){
                $customer_functions[] = $func;
            }
        }
        return $customer_functions;
    }

    }