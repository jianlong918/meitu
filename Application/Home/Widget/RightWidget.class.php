<?php
namespace Home\Widget;
use Think\Controller;

class RightWidget  extends Controller{
    public function right1(){

        $this->assign(array(
        ));
        $this->display('widget:right1');
    }

}
