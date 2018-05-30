<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no;" name="viewport">
    <title>易房游</title>
    <link  href="/Public/Wehome/css/style.css" rel="stylesheet" type="text/css">

    
</head>
<body>

    <style>
        html,body{width:100%; height:100%}
    </style>
    <div class="head" style="padding:12px 0">    <div class="p2" style="top:12px">        <a style="color:#fff;" href="javascript:history.go(-1);"><img src="/Public/Wehome/img/o1.jpg"></a>    </div>    <p class="p1"><?php echo ($top_title); ?></p></div>

    <p style="height:20px"></p>
    <div class="banner3">
        <img src="<?php echo ($product["litpic"]); ?>" width="100%">
    </div>
    <div class="dtop">
        <p class="p1" style="border-bottom:none">
            <span class="s1" style="color:#646464"><?php echo ($product["name"]); ?></span>
            <span class="s2" style="color:<?php echo ($order["color"]); ?>"><?php echo ($order["order_status"]); ?></span>
        </p>

    </div>
    <div class="dtop" style="border-top:none">
        <p class="p2">
            <label>开始时间：</label><input type="text" class="tre" style="background:none" value="<?php echo ($order["begin_time"]); ?>" readonly>

        </p>
        <p class="p2" >
            <label>结束时间：</label><input type="text" class="tre" style="background:none" value="<?php echo ($order["end_time"]); ?>" readonly>
        </p>
        <p class="p2" style="border-bottom:none">
            <label>合计费用：</label><input type="text" class="tre" style="background:none" value="<?php echo ($order["total"]); ?>积分（ 共<?php echo ($order["person_num"]); ?>人-居住<?php echo ($order["day_num"]); ?>天）" readonly>
        </p>
    </div>


    <?php if(is_array($order_person)): $i = 0; $__LIST__ = $order_person;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="yuyue" style="height:10px"></div>
    <div class="dtop">
        <p class="p2">
            <label>真实姓名：</label><input type="text" class="tre" style="background:none" value="<?php echo ($vo["name"]); ?>" readonly>

        </p>
        <p class="p2">
            <label>联系电话：</label><input type="text" class="tre" style="background:none" value="<?php echo ($vo["tel"]); ?>" readonly>
        </p>
        <p class="p2" style="border-bottom:none">
            <label>身份证号：</label><input type="text" class="tre" style="background:none" value="<?php echo ($vo["id_sn"]); ?>" readonly>
        </p>
    </div><?php endforeach; endif; else: echo "" ;endif; ?>
    <div class="con">
        <ul>
            <li class="li1"><a href="<?php echo U('feedback/index');?>">联系客服</a></li>
            <?php if($order["status"] == 1): ?><li class="li2"><a href="javascript:void(0)" id="cancel" data-id="<?php echo ($order["id"]); ?>">取消预约</a></li><?php endif; ?>
        </ul>

    </div>
    <p style="height:90px"></p>
<?php $img1=""; $img2=""; $img3=""; $url = $_SERVER['REQUEST_URI']; $orderurl = strpos($url,"order"); $memberurl = strpos($url,"member"); $articlurl = strpos($url,"article"); if($orderurl>0){ $img2 = "style=\"background-image: url('/Public/Wehome/img/f2_1.png')\""; }else if($memberurl>0 || $articlurl>0){ $img3 = "style=\"background-image: url('/Public/Wehome/img/f3_1.png')\""; }else{ $img1 = "style=\"background-image: url('/Public/Wehome/img/f1_1.png')\""; } ?>
<div class="footer">
    <ul>
        <li class="li1" >
            <a href="/" <?php echo ($img1); ?>>首页</a>
        </li>
        <li class="li2" >
            <a href="<?php echo U('Wehome/order/index');?>" <?php echo ($img2); ?>>我的预约</a>
        </li>
        <li class="li3" >
            <a href="<?php echo U('Wehome/member/index');?>" <?php echo ($img3); ?>>会员中心</a>
        </li>
    </ul>
</div>
<script>
    var Str = location.href;
    var order = Str.indexOf("order",0);
    var member = Str.indexOf("member",0);
    if(order>0){
        document.querySelector("li a").style.backgroundImage="url("+currentImage+")";
    }
</script>


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

    <script>
        $('#cancel').click(function(){
            var id=$(this).attr('data-id')
            layer.open({
                content: '您确定要取消该预约吗？'
                ,btn: ['确定', '取消']
                ,yes: function(index){
                    $.post("<?php echo U('order/cancel');?>", {"id":id},
                            function(data){
                                msg_url(data.info,'',1);
                            }, "json");
                    layer.close(index);
                }
            });

        })

    </script>

</body>
</html>