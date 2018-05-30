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
<div class="headnav" style="position:fixed; top:33px; left:0; width:100%" >
    <a href="<?php echo U('order/index');?>" <?php if(empty($_GET['status'])): ?>class="ty"<?php endif; ?> >全部</a>
    <a href="<?php echo U('order/index',array('status'=>1));?>" <?php if($_GET['status']== 1): ?>class="ty"<?php endif; ?>  >处理中</a>
    <a href="<?php echo U('order/index',array('status'=>2));?>" <?php if($_GET['status']== 2): ?>class="ty"<?php endif; ?> >待入住</a>
    <a href="<?php echo U('order/index',array('status'=>3));?>" <?php if($_GET['status']== 3): ?>class="ty"<?php endif; ?> >已完成</a>
</div>
    <p style="height:88px"></p>
<?php if(is_array($myorders)): $i = 0; $__LIST__ = $myorders;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="yymain">
    <div class="yytop">
        <div class="yyleft">
            <img src="<?php echo ($vo["litpic"]); ?>" width="100%">
        </div>
        <div class="yycenter">
            <h3><?php echo ($vo["title"]); ?></h3>
            <p class="p1">[<?php echo ($vo["typename"]); ?>]</p>
            <p class="p2"><?php echo ($vo["begin_time"]); ?>～<?php echo ($vo["end_time"]); ?></p>
            <p class="p3">合计：<?php echo ($vo["total"]); ?>积分 (共<?php echo ($vo["person_num"]); ?>人,住<?php echo ($vo["day_num"]); ?>天)</p>

        </div>
        <div class="yyright" style="color:<?php echo ($vo["color"]); ?>">
            <?php echo ($vo["order_status"]); ?>

        </div>
    </div>
    <p style="height:1px; background:#e0e0e0"></p>
    <div class="yybottom">
        <div class="bott">
            <a href="<?php echo U('order/detail',array('id'=>$vo['id']));?>">查看详情</a>
            <a href="<?php echo U('feedback/index');?>">联系客服</a>
        </div>
    </div>
</div><?php endforeach; endif; else: echo "" ;endif; ?>
<p style="height:90px" id="add_content"></p>
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
        $(function() {
            /*瀑布流*/
            var page = 1;
            var loading = false;
            $(window).scroll(function() {
                if ($(window).scrollTop() + $(window).height() >= $(document).height() ) {
                    loadMore();
                }
            });

            function loadMore() {
                if (loading === false) {
                    loading = true;
                    var status="<?php echo ($_GET['status']); ?>"
                    $.post("<?php echo U('order/more_order');?>", {page: page,status:status}, function(data) {
                        if (data.status==1) {
                            page++;
                            var content=data.content
                            $("#add_content").append(content);
                            loading = false;
                        } else {
                            msg_url(data.info);
                        }
                    }, 'json');
                } else {
                    return;
                }
            }
        });
    </script>

</body>
</html>