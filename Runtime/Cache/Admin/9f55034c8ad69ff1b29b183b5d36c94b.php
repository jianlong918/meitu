<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html><html><head>    <meta charset="utf-8"><meta name="renderer" content="webkit"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="description" content=""><title>后台管理系统</title><link rel="shortcut icon" href="favicon.ico"> <link href="/Public/admin/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet"><link href="/Public/admin/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet"><link href="/Public/admin/js/plugins/fancybox/jquery.fancybox.css" rel="stylesheet"><link href="/Public/admin/css/animate.min.css" rel="stylesheet"><link href="/Public/admin/css/style.min862f.css?v=4.1.0" rel="stylesheet"><link href="/Public/admin/css/plugins/iCheck/custom.css" rel="stylesheet"><script src="/Public/admin/js/jquery.min.js?v=2.1.4"></script></head><body class="gray-bg">    <div class="middle-box text-center loginscreen  animated fadeInDown">        <div id="msie">            <div>                <h1 class="logo-name">YL</h1>            </div>            <h3>管理系统登录</h3>            <form class="m-t ajaxform" role="form" action="<?php echo U('login/index');?>">                <div class="form-group">                    <input type="text" class="form-control" name='username' placeholder="用户名" required="">                </div>                <div class="form-group">                    <input type="password" class="form-control" name='password' placeholder="密码" required="">                </div>                <button type="submit" class="btn btn-primary block full-width m-b">登 录</button><!--                <p class="text-muted text-center"> <a href="login.html#"><small>忘记密码了？</small></a> | <a href="register.html">注册一个新账号</a>-->                </p>            </form>        </div>    </div>    <script>        function IEVersion(){var userAgent=navigator.userAgent;var isIE=userAgent.indexOf("compatible")>-1&&userAgent.indexOf("MSIE")>-1;var isEdge=userAgent.indexOf("Edge")>-1&&!isIE;var isIE11=userAgent.indexOf("Trident")>-1&&userAgent.indexOf("rv:11.0")>-1;if(isIE){var reIE=new RegExp("MSIE (\\d+\\.\\d+);");reIE.test(userAgent);var fIEVersion=parseFloat(RegExp["$1"]);if(fIEVersion==7){return 7}else{if(fIEVersion==8){return 8}else{if(fIEVersion==9){return 9}else{if(fIEVersion==10){return 10}else{return 6}}}}}else{if(isEdge){return"edge"}else{if(isIE11){return 11}else{return -1}}}}var version=IEVersion();if(version==6||version==7||version==8){document.getElementById("msie").innerHTML="<br><br>您的浏览器版本过低，请升级浏览器，或使用谷歌、火狐、360极速等浏览器.<br><br>如果是双核浏览器请切换至极速模式。"};    </script>    <script src="/Public/admin/js/jquery.min.js?v=2.1.4"></script>    <script src="/Public/admin/js/bootstrap.min.js?v=3.3.6"></script>    <script src="/Public/js/jquery.form.min.js"></script>    <script src="/Public/js/layer/layer.js"></script>    <script src="/Public/js/common.js"></script></body><script type="text/javascript">    if( $.browser.msie )    {        $('#msie').html('<h3 style="color:white">不支持IE系浏览器<br/><br/>请换用Chome、Firefox或者Safari</h3>');    }</script><!-- Mirrored from www.zi-han.net/theme/hplus/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:18:23 GMT --></html>