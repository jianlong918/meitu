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

<div class="head" style=" padding:14px 0">    <div class="p2" style="top:14px">        <a style="color:#fff;"><img src="/Public/wxhome/img/o1.jpg"></a>    </div>    <p class="p1"><?php echo ($top_title); ?></p>    <div class="p4" style="top:14px;">        <img src="/Public/wxhome/img/logoright2.jpg">    </div></div><p style="height:40px"></p>
<p style="height:40px"></p>
<div class="main2">
    <h1><img src="/Public/wxhome/img/logo2.jpg"></h1>
    <div class="main2-1">
        <h3><?php echo ($article['typename']); ?></h3>
        <div class="wen">
            <?php echo ($article['content']); ?>
        </div>
    </div>

</div>

<p style="height:90px"></p>
<div class="footer">
    <ul>
        <li class="li1">
            <a href="">首页</a>
        </li>
        <li class="li2">
            <a href="">我要预约</a>
        </li>
        <li class="li3">
            <a href="">会员中心</a>
        </li>
    </ul>
</div>
<script src="/Public/wxhome/js/jquery-1.9.1.min.js"></script>
<script src="/Public/wxhome/js/swiper.min.js"></script>
<script src="/Public/wxhome/js/script.js"></script>

</body>
</html>