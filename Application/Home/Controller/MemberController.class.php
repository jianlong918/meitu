<?php
namespace Home\Controller;
use Think\Controller;
use Think\Page;

class MemberController extends BaseController{
    protected $table='SMember';

    public function _initialize(){
        $minfo = session('uinfo');
    }
    //频道封面栏目
    public function index(){

        $minfo = session('uinfo');
        $mid = $minfo['id'];		if(empty($mid)){exit;}
        $m_member = M("s_member");
        $minfo = $m_member->find($mid);        $this->assign(array(
            //'top_title' => $top_title,
            'minfo'=>$minfo
        ));
        $this->display();
    }

    public function info(){
        $top_title = "完善资料";
        $mid = session("mid");
        $avator = session("wx_avator");
        $nickname = session("wx_nickname");
        $m_member = $this->getSinglebyId($mid);
        $m_member['level'] = getFieldShow('s_level','level_name',array('id'=>$m_member['level_id']));
        $this->assign(array(
            "meminfo"=>$m_member,
            "avator"=>$avator,
            "nickname"=>$nickname,
            'top_title' => $top_title
        ));
        $this->display();
    }

    public function editinfo(){
        session("mid");
        if(IS_POST){
            $m_member = D("SMember");
            if($m_member->create($_POST)) {
                $m_member->id = session("mid");
                $m_member->created_at = date("Y-m-d H:i:s", time());
                $rs = $m_member->filter('strip_tags')->save();
                $this->success("成功");
            }else{
                $this->error($m_member->getError());
            }
        }
    }

    public function balance(){
        $mid = session("mid");
        $balance=M($this->table)->where(array('id'=>$mid))->getField('balance');
        $top_title = "我的积分";
        $this->assign(array(
            'top_title' => $top_title,
            "balance"=>$balance,
            'mid'=>$mid,
        ));
        $this->display();
    }

    public function paylog(){
        $mid = session("mid");
        $condition['mid']=$mid;
        $balance=M($this->table)->where(array('id'=>$mid))->getField('balance');
        $pay_log=$this->getData('id desc','8',$condition,$table='s_pay_log');
        foreach($pay_log as $k=>$v){
            if($v['process_type']==2){
                $product_id=M('s_order')->where(array('id'=>$v['order_id']))->getField('product_id');
                $product_name=M('s_product')->where(array('id'=>$product_id))->getField('name');
                $pay_log[$k]['name']=$product_name.'预约';
            }elseif($v['process_type']==1 || $v['process_type']==3){
                $pay_log[$k]['name']='系统发放';
            }elseif($v['process_type']==4){
                $product_id=M('s_order')->where(array('id'=>$v['order_id']))->getField('product_id');
                $product_name=M('s_product')->where(array('id'=>$product_id))->getField('name');
                $pay_log[$k]['name']=$product_name.'预约取消';
            }
        }

        $top_title = "积分明细";
        $this->assign(array(
            'top_title' => $top_title,
            "mid"=>$mid,
            "balance"=>$balance,
            'pay_log'=>$pay_log,
        ));
        $this->display();
    }

    public function more_paylog(){
        $page=I('post.page');
        $list_num=8;
        $mid = session("mid");
        $start_num=$page*$list_num;
        $more=M('s_pay_log')->where("mid=".$mid)->limit($start_num.','.$list_num)->order('id desc')->select();
        $content='';
        foreach($more as $k=>$v){
            switch($v['process_type']){
                case 1:
                    $more[$k]['name']='系统发放';
                    $more[$k]['sign']='+';
                    $more[$k]['class']='nright jfred';
                    break;
                case 2:
                    $product_id=M('s_order')->where(array('id'=>$v['order_id']))->getField('product_id');
                    $product_name=M('s_product')->where(array('id'=>$product_id))->getField('name');
                    $more[$k]['name']=$product_name.'预约';
                    $more[$k]['sign']='-';
                    $more[$k]['class']='nright';
                    break;
                case 3:
                    $more[$k]['name']='系统发放';
                    $more[$k]['sign']='+';
                    $more[$k]['class']='nright jfred';
                    break;
                case 4:
                    $product_id=M('s_order')->where(array('id'=>$v['order_id']))->getField('product_id');
                    $product_name=M('s_product')->where(array('id'=>$product_id))->getField('name');
                    $more[$k]['name']=$product_name.'预约取消';
                    $more[$k]['sign']='+';
                    $more[$k]['class']='nright jfred';
                    break;
            }
            $content.=<<<EOF
        <dl class="botsol">
                <dd class="jfneirong">
                    <div class="nleft">
                        <h4>{$more[$k]['name']}</h4>
                        <span>{$v['created_at']}</span>
                    </div>
                    <div class="{$more[$k]['class']}">{$more[$k]['sign']}{$v['amount']}</div>
                </dd>
            </dl>
EOF;
        }
        $ajaxdata['status']=1;
        $ajaxdata['content']=$content;
        $this->ajaxReturn($ajaxdata);
    }

    public function message(){
        $mid = session("mid");
        $condition['mid']=$mid;
        $message=$this->getData('id desc','9',$condition,$table='message');
        foreach($message as $k=>$v){
            $message[$k]['content']=getConfig('message',$v['type'],$v['content_id']);
            $message[$k]['created_at']=substr($v['created_at'],0,10);
            $message[$k]['type']=getConfig('message_type',$v['type']);
        }
        $this->assign(array(
            "mid"=>$mid,
            'message'=>$message,
        ));
        $this->display();
    }

    public function more_message(){
        $page=I('post.page');
        $mid = session("mid");
        $list_num=9;
        $start_num=$page*$list_num;
        $more=M('message')->where("mid=".$mid)->limit($start_num.','.$list_num)->order('id desc')->select();
        $content='';
        foreach($more as $k=>$v){
            $more[$k]['content']=getConfig('message',$v['type'],$v['content_id']);
            $more[$k]['created_at']=substr($v['created_at'],0,10);
            $more[$k]['type']=getConfig('message_type',$v['type']);
            $content.=<<<EOF
       <div class="shanbox">
        <div class="shan">
            <div class="shanleft">
                <dl>
                    <dt><img src="/Public/Wehome/img/tx1.jpg" width="100%"></dt>
                    <dd>
                        <h3>{$more[$k]['type']}<span>{$more[$k]['created_at']}</span></h3>
                        <p>{$more[$k]['content']}</p>
                    </dd>
                </dl>
            </div>
            <div class="shanright" style='line-height: 75px;'>
                <a href="javascript:void(0)" onclick='del_message({$v['id']})' >删除</a>
            </div>
        </div>
    </div>
EOF;
        }
        $ajaxdata['status']=1;
        $ajaxdata['content']=$content;
        $this->ajaxReturn($ajaxdata);
    }

    public function message_del(){
        $id=I('post.id',0,'int');
        if(empty($id)){
            $this->error('数据错误！');
        }
        $re=M('Message')->where(array('id'=>$id))->delete();
        if(!$re){
            $this->error('删除失败！');
        }
        $this->success('删除成功！');
    }

    public function logout(){
        session(null);
        redirect("/Wehome/index/index");
    }

    public function reg(){
        if(IS_POST){
            $uname = I("post.name");
            $pwd = I("post.pwd");
            $m_member = D("SMember");
            //数据入表
            $data = array(
                "nickname"=>$uname,
                "passwd"=>pwdjiami($pwd)
            );

            if (!$m_member->create($data)){
                $dealer=$m_member->getError();//获取自动验证的错误提示
                $this->error($dealer);
            }else{
                $m_member->created_at = date("Y-m-d H:i:s",time());
                $m_member->expire_at = date("Y-m-d H:i:s",time());
                $re=$m_member->add();
                if($re){
                    $this->success("添加成功",U('member/login'));
                }
                $this->error("添加失败");
            }
        }
        $this->display();
    }

    public function login(){
        if(IS_POST){
            $uname = I("post.name");
            $pwd = I("post.pwd");
            $m_member_rs = M("s_member")->where(array("nickname"=>$uname,"passwd"=>pwdjiami($pwd)))->find();
            if($m_member_rs){
                session('uinfo', $m_member_rs);
                $this->success("登陆成功",U('member/index'));
            }else{
                $this->error("帐号密码错误");
            }
        }
        $this->display();
    }
}
