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

<div class="head">    <div class="p2">        <a href="<?php echo U('Wehome/index/p_list_index');?>"> <img src="/Public/Wehome/img/logoleft.jpg"></a>    </div>    <p class="p1"><img src="/Public/Wehome/img/logo.jpg"></p>    <div class="p3">        <a href="<?php echo U('Wehome/search/index');?>"><img src="/Public/Wehome/img/logorihgt1.jpg"></a>    </div>    <div class="p4">        <a href="<?php echo U('Wehome/member/message');?>" style="position: relative;">        	 <img src="/Public/Wehome/img/logoright2.jpg">        	 <span style="width: 7px;; height: 7px; background: #fff ;position: absolute; right: -1px; top: -5px; border-radius: 50%;display: none;" id="isread"></span>        </a>          </div></div>

    <p style="height:44px"></p>
    <div class="banner">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php if(is_array($banners)): $i = 0; $__LIST__ = $banners;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="swiper-slide">
                    <?php if(!empty($vo["url"])): ?><a href="<?php echo ($vo["url"]); ?>">
                        <img src="<?php echo ($vo["img"]); ?>" width="100%">
                    </a>
                    <?php else: ?>
                        <img src="<?php echo ($vo["img"]); ?>" width="100%"><?php endif; ?>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
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

    <div class="nav">
        <?php if(is_array($types)): $i = 0; $__LIST__ = $types;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('index/p_list',array('typeid'=>$vo['id']));?>" class="a<?php echo ($i); ?>"><?php echo ($vo["typename"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
        <a href="<?php echo U('feedback/index');?>" class="a7">客服中心</a>
        <a href="<?php echo U('Wehome/Newsarticle/index',array('id'=>7));?>" class="a8">关于旅居</a>
    </div>
    <div class="main">
        <h4>热门推荐</h4>

        <?php if(is_array($products)): $i = 0; $__LIST__ = $products;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('index/p_detail',array('id'=>$vo['id']));?>">
        <dl>
            <dt><img src="<?php echo ($vo["litpic"]); ?>" width="100%"></dt>
            <dd>
                <h3><?php echo (mb_substr($vo["name"],0,22,'UTF-8')); ?></h3>
                <p>
                    <span class="s1">[<?php echo getFieldShow('s_type','typename',array('id'=>$vo['typeid']));?>]</span>
                    <span class="s2"><img src="/Public/Wehome/img/s1.jpg"></span>
                </p>
            </dd>
        </dl>
         </a><?php endforeach; endif; else: echo "" ;endif; ?>
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

    <script src="/Public/Wehome/js/swiper.min.js"></script>

</body>
</html>