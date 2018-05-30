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
    <p style="height:50px"></p>
    <form action="<?php echo U('Wehome/member/editinfo');?>" method="post" class="ajaxform">
    <div class="people">
        <h1><img src="<?php echo ($avator); ?>"></h1>

        <div class="nicheng" style="border-top:solid 1px #dcdcdc;">
            <p><label>微信昵称</label><span  class="rt"  >	<?php echo ($nickname); ?></span></p>

        </div>
        <div class="nicheng" >
            <p><label>会员等级</label><span  class="rt"   ><?php echo ($meminfo["level"]); ?></span></p>
        </div>
        <p style="height:20px"></p>
        <div class="nicheng" style="border-top:solid 1px #dcdcdc;">
            <p><label>真实姓名</label><input type="text" name="real_name" class="rt" placeholder="输入真实姓名" value="<?php echo ($meminfo["real_name"]); ?>" ></p>
        </div>
        <div class="nicheng" >
            <p><label>联系电话</label><input type="number" name="tel" class="rt"  placeholder="输入电话" value="<?php echo ($meminfo["tel"]); ?>"></p>
        </div>
        <div class="nicheng" >
            <p><label>身份证号</label><input type="text" name="id_sn" class="rt"  placeholder="输入身份证号" value="<?php echo ($meminfo["id_sn"]); ?>"></p>
        </div>
        <button class="btn" type="submit">保存编辑信息</button>
    </div>
    </form>
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

</body>
</html>