<?php
namespace Wehome\Controller;
use Think\Controller;
use Think\Page;

class FeedbackController extends BaseController{
    protected $table='feedback';
    public function index(){
        $top_title = "客服留言";
        $this->assign(array(
            'top_title' => $top_title,
        ));
        $this->display();
    }
    public function index_sub(){
        $mid = session("mid");
        $list_num = 6;
        $start_num=0;
        $feedbacks = M('Feedback')->where("mid=".$mid)->limit($start_num.','.$list_num)->order('id desc')->select();
        $feedbacks = array_reverse($feedbacks);
        $t = 0;
        foreach($feedbacks as $k=>$v){
            if($k==0){
                $t = strtotime($v['created_at']);
            }else{
                $t1 = strtotime($v['created_at'])-$t;
                if(abs($t1)<3600){
                    $feedbacks[$k]["created_at"] = "";
                }
            }
			
        }
		$reply = M("autoreply")->order("id desc")->find();
        $this->assign(array(
            'feedbacks'=>$feedbacks,
            "reply"=>$reply
        ));
        $this->display();
    }

    public function add(){
        if(IS_POST){
            $m_feed = D("Feedback");
            if($m_feed->create($_POST)){
                $m_feed->mid = session("mid");
                $m_feed->created_at = date("Y-m-d H:i:s",time());
                $rs = $m_feed->filter('strip_tags')->add();
                if($rs){
                    $ga = date("w");
                    $week = "";
                    switch( $ga ){
                        case 1 : $week = "一";break;
                        case 2 : $week = "二";break;
                        case 3 : $week = "三";break;
                        case 4 : $week = "四";break;
                        case 5 : $week = "五";break;
                        case 6 : $week = "六";break;
                        case 0 : $week = "日";break;
                        default : $week = "";
                    };
                    $am = "";
                    $h=date('G');
                    if (0<$h || $h<=12) $am= '上午';
                    if (24<=$h || $h>12) $am= '下午午';
                    $time = date("H:i",time());
                    $addtime = $week.$am.$time;
                    $avator=session("avator");
                    $content=I("post.content");
                    $rscontent = <<<EOF
<div class="data">
        <h5><span class="time">{$addtime}</span></h5>
        <dl>
            <dt>
            <div class="dtleft">
                <img src="{$avator}" width="100%" class="avator">
            </div>
            <div class="dtright">
                <img src="/Public/Wehome/img/jo1.png" class="po">
                <p class="content">
                {$content}
                </p>
            </div>
            </dt>
        </dl>
</div>
EOF;
                    $rs_data = array(
                        "status"=>1,
                        "info"=>"新增成功",
                        "cont"=>$rscontent,
                    );
                    $this->ajaxReturn($rs_data);
                }
                $this->error('新增失败');
            }else{
                $this->error($m_feed->getError());
            }
        }
    }

    public function load_more(){
        $page=I('post.page');
        $mid = session("mid");
        $list_num = 6;
        $start_num=$page*$list_num;
        $feedbacks = M('Feedback')->where("mid=".$mid)->limit($start_num.','.$list_num)->order('id desc')->select();
        $feedbacks = array_reverse($feedbacks);
        $cont="";
        $avator = session("avator");
        $t = 0;
        foreach($feedbacks as $k=>$v){
            $css_time = "";
            $ctime = getChatTime($v['created_at']);
            if($k==0){
                $t = strtotime($v['created_at']);
                $css_time = " <h5 style='clear: both; '><span>{$ctime}</span></h5>";
            }else{
                $t1 = strtotime($v['created_at'])-$t;
                if(abs($t1)<3600){
                    $feedbacks[$k]["created_at"] = "";
                }else{
                    $css_time = " <h5 style='clear: both; '><span>{$ctime}</span></h5>";
                }
            }

            $css_cls = "right";
            $imge = "jo2.png";
            if($v['adminid']){
                $css_cls = "left";
                $imge = "jo1.png";
            }
            $content = $v['content'];
            $cont .= <<<EOF
             <p style="height: 6px; clear: both"></p>
                {$css_time}
            <p style="height: 5px; clear: both"></p>
             <dt class="{$css_cls}">
                <div class="dtleft">
                    <img src="/Public/Wehome/img/e1.jpg" width="100%">
                </div>
                <div class="dtright">
                    <img src="/Public/Wehome/img/{$imge}" class="po">
                    <p>{$content}</p>
                </div>

            </dt>

EOF;
        }


        $rsdata = array(
            "status"=>1,
            "info"=>"成功",
            "content"=>$cont
        );
        $this->ajaxReturn($rsdata);
    }
}
