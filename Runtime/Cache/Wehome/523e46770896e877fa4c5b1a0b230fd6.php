<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no;" name="viewport">
    <title>易房游</title>
    <link  href="/Public/Wehome/css/style.css" rel="stylesheet" type="text/css">

    
</head>
<body>

<div class="head">    <div class="p2">        <a href="<?php echo U('Wehome/index/p_list_index');?>"> <img src="/Public/Wehome/img/logoleft.jpg"></a>    </div>    <p class="p1"><img src="/Public/Wehome/img/logo.jpg"></p>    <div class="p3">        <a href="<?php echo U('Wehome/search/index');?>"><img src="/Public/Wehome/img/logorihgt1.jpg"></a>    </div>    <div class="p4">        <a href="<?php echo U('Wehome/member/message');?>" style="position: relative;">        	 <img src="/Public/Wehome/img/logoright2.jpg">        	 <span style="width: 7px;; height: 7px; background: #fff ;position: absolute; right: -1px; top: -5px; border-radius: 50%;display: none;" id="isread"></span>        </a>          </div></div>
    <p style="height:43px"></p>

    <div class="btop">
        <div class="usermain">
            <dl>
                <dt><img src="<?php echo ($avator); ?>" width="100%"></dt>
                <dd>
                    <p class="p1" style="margin-top: 50%;"><?php echo ($nickname); ?></p>
                </dd>
            </dl>

        </div>
    </div>

    <div class="usernav">
        <ul>
            <li class="li1" onclick="location.href='<?php echo U('Wehome/member/info');?>'">
                <a >我的资料</a>
            </li>
            <li class="li5" level_id="<?php echo ($minfo["level_id"]); ?>">
                <a >我的积分</a>
            </li>
        </ul>

        <ul>
            <li class="li2" onclick="location.href='<?php echo U('Wehome/order/index');?>'">
                <a >我的预约</a>
            </li>
            <li class="li3" onclick="location.href='<?php echo U('Wehome/Newsarticle/index',array('id'=>8));?>'">
                <a >会员须知</a>
            </li>
        </ul>
        <ul>
            <li class="li4" onclick="location.href='<?php echo U('Wehome/Newsarticle/index',array('id'=>9));?>'">
                <a >联系我们</a>
            </li>

        </ul>


        <p>
            <a  href="<?php echo U('/Wehome/member/logout');?>" class="layout">清空缓存</a>
        </p>



    </div>
    <p style="height:70px"></p>
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

    <!--onclick="location.href='<?php echo U('Wehome/member/balance');?>'"-->
    <script>
        $(".li5").click(function(){
            var levelid = $(this).attr("level_id");
            if(levelid==0){
                var cont = "<img src=\"/Public/Wehome/img/r1.jpg\" width=\"100%\" class=\"top\" ><p style='padding-top: 15%;font-size: 13px;margin-bottom: 10px;'> 您目前不是易房游线下协议会员<br>若您在线下签署过合作协议，<br>请于我的资料模块补全您的身份信息，<br>或咨询：400-661-000</p><a href=\"<?php echo U('/Wehome/member/info');?>\">我知道了</a><img src=\"/Public/Wehome/img/r1.jpg\" width=\"100%\" class=\"bottom\">";
                acce_alert(cont);
            }else{
                location.href="<?php echo U('Wehome/member/balance');?>";
            }

        })

    </script>

</body>
</html>