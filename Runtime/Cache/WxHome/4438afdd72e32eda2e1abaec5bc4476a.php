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

<div class="head">
<p style="height:40px"></p>
<div class="main2">
    <?php echo ($article['body']); ?>

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