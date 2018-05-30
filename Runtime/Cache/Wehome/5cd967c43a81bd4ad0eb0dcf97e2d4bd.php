<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no;" name="viewport">
    <title>易房游</title>
    <link  href="/Public/Wehome/css/style.css" rel="stylesheet" type="text/css">

    
</head>
<body>

<div class="head" style="padding:12px 0">    <div class="p2" style="top:14px">        <a style="color:#fff;" href="javascript:history.go(-1);"><img src="/Public/Wehome/img/o1.jpg"></a>    </div>    <p class="p1"><?php echo ($top_title); ?></p></div>

    <p style="height:70px"></p>
    <style>

    </style>

    <div class="myjf">
        <h4><img src="/Public/Wehome/img/qianbi.jpg"></h4>
        <h5><?php echo ($balance); ?></h5>

        <div class="jfmain">
            <h3>积分说明</h3>
            <p style="margin-top:10px">1、积分是线下协议会员购买的会员服务体现</p>
            <p>2、积分可用于在商城内预约旅居地产、民宿客栈、星级酒店、海景洋房、特色小镇、养老基地等。</p>
            <a href="<?php echo U('Wehome/member/paylog');?>">积分明细</a>
        </div>

    </div>

<script src="http://apps.bdimg.com/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="/Public/js/jquery.form.min.js"></script>
<script src="/Public/js/layer_mobile/layer.js"></script>
<script src="/Public/js/commonwehome.js"  charset="gb2312"></script>
<script src="/Public/Wehome/js/script.js"></script>
<div class="tykbox" style="display:none">
    <div class="tyk">

    </div>
</div>
<script>
    function acce_alert(c){
        $(".tyk").html(c);
        $(".tykbox").show()
    }
    function acce_hide(){
        $(".tykbox").hide();
    }
</script>

</body>
</html>