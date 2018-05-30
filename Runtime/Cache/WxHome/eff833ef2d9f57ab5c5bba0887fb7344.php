<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no;" name="viewport">
    <title>无标题文档</title>
    <link  href="/Public/wxhome/css/style.css" rel="stylesheet" type="text/css">
    <link  href="/Public/wxhome/css/swiper.min.css" rel="stylesheet" type="text/css">

    
</head>
<body>

    <style>
        html,body{width:100%; height:100%}
    </style>
    <div class="head" style="padding:14px 0">    <div class="p2" style="top:14px">        <a style="color:#fff;"><img src="/Public/wxhome/img/o1.jpg"></a>    </div>    <p class="p1"><?php echo ($top_title); ?></p></div>
    <p style="height:20px"></p>
    <div class="banner3">
        <img src="/Public/wxhome/img/banner3.jpg" width="100%">
    </div>
    <form>
    <div class="dtop">
        <p class="p1">
            <span class="s1">威海乳山4A级旅游度假区  闻涛美</span>
        </p>
        <p class="p2">
            <label>开始时间：</label><span class="price">300积分／日</span>&nbsp;&nbsp;<span class="price">限住2人</span>
        </p>
        <p class="p2">
            <label>开始时间：</label><input type="text" name="s_time" class="tre" id="beginTime">
        </p>
        <p class="p2" style="border-bottom:none">
            <label>结束时间：</label><input type="text" name="e_time" class="tre" id="endTime">
        </p>
    </div>

    <div class="yuyue">
        <p>需提前至少20天预约</p>
    </div>
    <div class="dtop dtop1">
        <p class="p2">
            <label>真实姓名：</label><input type="text" name="name[]" class="tre" style="background:none">
        </p>
        <p class="p2" >
            <label>联系电话：</label><input type="text" name="tel[]" class="tre" style="background:none">
        </p>
        <p class="p2" style="border-bottom:none">
            <label>身份证号：</label><input type="text" name="id_sn[]" class="tre" style="background:none">
        </p>
    </div>
    </form>

    <a class="add">新增住户</a>
    <p style="height:100px"></p>

    <div class="lfooter">
        <div class="lleft">
            <p>合计：<span>¥ 1200.00（共4天）</span>  </p>
        </div>
        <div class="lright">
            <a id="acce">确认预约</a>
        </div>
    </div>

    <div id="datePlugin"></div>

<script src="http://apps.bdimg.com/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="/Public/js/jquery.form.min.js"></script>
<script src="/Public/js/layer/layer.js"></script>
<script src="/Public/js/common.js"></script>
<script src="/Public/wxhome/js/script.js"></script>

    <script src="/Public/wxhome/js/swiper.min.js"></script>
    <link  href="/Public/wxhome/dateiscroll/common.css" rel="stylesheet" type="text/css">
    <script src="/Public/wxhome/dateiscroll/date.js" ></script>
    <script src="/Public/wxhome/dateiscroll/iscroll.js"></script>
    <script type="text/javascript">
        $(function(){
            $('#beginTime').date({
                fromat: 'yyyy-mm-dd'
            });
            $('#endTime').date({
                fromat: 'yyyy-mm-dd'
            });
        });
    </script>

    <div class="tachubox" style="display:none; z-index:99999999999999999">
        <div class="tanchu">
            <h3><img src="/Public/wxhome/img/logo2.jpg"></h3>
            <div class="zmain">
                <h4>会员需知</h4>
                <p>1.预定（通过易房游平台）</p>
                <p>1.1在线预定</p>
                <p>登录易房游平台会员中心，按照系统提示完成您的预定，在您填写定单时，务必留下准确入住人姓名（请确保与所使用的有效证件信息一致）及联系人手机号码。</p>
                <p>1.2预定时间</p>
                <p>1.2.1入住旅居国际自营旅居基地应提前7日预定，7、8月份和五一、十一黄金周应提前15天预定。</p>
                <p>1.2.2入住旅居国际合作置换基地淡季应提前10天预定，旺季应提前15-20天预定。</p>
                <p>1.2.3一旦预定，48小时内乙方具备撤销权，超过48小时，视为预定费用发生。</p>
                <p>1.2.4预定成功后，系统客服人员会及时安排，48小时后通过系统确认和电话通知预定人，预定人可安排自己行程。</p>
                <p>2.费用说明</p>
                <p>2.1旅居国际自营置换基地费用按照购买服务合同内容实施。</p>
                <p>2.2旅居国际置换基地费用按照平台显示价格为准，此价格为合约价。</p>
            </div>
            <a>同 意</a>
        </div>
    </div>
    <script>
        $(function(){
            $("#acce").click(function(){
                $(".tachubox").show()

            })
            $(".tachubox .tanchu").click(function(e){
                e.stopPropagation();
            })
            $(".tachubox").click(function(){
                $(this).hide()

            })
        })
    </script>


</body>
</html>