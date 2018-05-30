<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no;" name="viewport">
    <title>易房游</title>
    <link  href="/Public/Wehome/css/style.css" rel="stylesheet" type="text/css">

    
    <link  href="/Public/Wehome/css/swiper.min.css" rel="stylesheet" type="text/css">

</head>
<body>

<div class="head" style="padding:12px 0">    <div class="p2" style="top:14px">        <a style="color:#fff;" href="javascript:history.go(-1);"><img src="/Public/Wehome/img/o1.jpg"></a>    </div>    <p class="p1"><?php echo ($top_title); ?></p></div>
<p style="height:48px"></p>

    <div class="banner">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php if(is_array($img_arr)): $i = 0; $__LIST__ = $img_arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="swiper-slide"><img src="<?php echo ($vo); ?>" width="100%"></div><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
        </div>

        <!-- Swiper JS -->
        <script src="/Public/Wehome/js/swiper.min.js"></script>

        <!-- Initialize Swiper -->
        <script>
            var swiper = new Swiper('.swiper-container', {
                pagination: '.swiper-pagination',
                paginationClickable: true,
                spaceBetween: 30,
                autoplay: 3000,//自动播放

                autoplayDisableOnInteraction : false,//自动播放时候会停止 默认为true停止   设置成假 会自动
            });
        </script>
    </div>


    <div class="xiangqing">
        <div class="xq1">
            <h3><?php echo ($product["name"]); ?></h3>
            <h4><?php echo ($product["price"]); ?>积分／日</h4>
            <h5><?php echo ($product["market_price"]); ?>积分</h5>
            <p>年预定<?php echo ($product["order_num"]); ?>次</p>

            <div class="tiz">
                需提前至少<?php echo ($book_day); ?>天预约
            </div>
        </div>

    </div>

    <div class="xiangqing">
        <div class="xq1">
            <p style="height:10px;"></p>
            <h2>入住须知</h2>
            <div class="info">
                <style>
                    pre {
                        white-space: pre-wrap;
                        word-wrap: break-word;
                        font-size:15px;
                        line-height: 22px;
                        letter-spacing: 0px;
                        color:#646464;;
                        font-family: "Microsoft YaHei", "微软雅黑";
                    }
                </style>
                <pre><?php echo ($product["description"]); ?></pre>
            </div>

            <div class="tiz1">
                <?php echo ($product["province"]); echo ($product["city"]); echo ($product["area"]); echo ($product["address"]); ?>
            </div>
        </div>

    </div>


    <div class="xiangqing" style="padding-bottom:10px">
        <div class="xq1">
            <p style="height:10px;"></p>
            <h2>基地详情</h2>
            <?php echo ($product["content"]); ?>
        </div>

    </div>

    <div class="tuijian">
        <h1 style="text-align:center"><img src="/Public/Wehome/img/jian.jpg" width="50%"></h1>
        <?php if(is_array($product_add)): $i = 0; $__LIST__ = $product_add;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dl>
            <dt><a href="<?php echo U('p_detail',array('id'=>$vo['id']));?>"><img src="<?php echo ($vo["litpic"]); ?>" width="100%"></a></dt>
            <dd><a href="<?php echo U('p_detail',array('id'=>$vo['id']));?>"><?php echo ($vo["name"]); ?></a></dd>
        </dl><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <p style="height:90px"></p>

    <div class="yyfooter">
        <div class="footerleft">
            <a href="<?php echo U('Wehome/feedback/index');?>">客服</a>
        </div>
        <div class="footerright">
            <a href="<?php echo U('order/add',array('product_id'=>$product['id']));?>">立即预约</a>
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