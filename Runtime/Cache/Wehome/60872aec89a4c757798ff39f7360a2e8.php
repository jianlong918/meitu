<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<head>
    <title>写真图片- 会员注册</title>
    <meta charset="utf8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0 , maximum-scale=1.0, user-scalable=no" />
    <script src="/Public/mn/js/j.js" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            $("#passwordLevel").removeClass().addClass("rank r0");
            $("#vdcode").focus(function(){
                var leftpos = $("#vdcode").position().left;
                var toppos = $("#vdcode").position().top - 42;
                $('#ver_code').css('left', leftpos+'px');
                $('#ver_code').css('top', toppos+'px');
                $('#ver_code').css('visibility','visible');
            });

            /*
             $("#vdcode").blur(function(){
             $('#ver_code').css('visibility','hidden');
             });
             */
        })


    </script>

    <link href="/Public/mn/css/member.css" rel="stylesheet" type="text/css" />
    <link href="/Public/mn/css/public.css" rel="stylesheet" type="text/css" />
    <link href="/Public/mn/css/sive.css" rel="stylesheet" type="text/css" />
</head>
<body>
<header class="tab_head">
    <nav class="h_nav">
        <div class="h_div block">
            <a href="/" ><img src="/Public/mn/picture/logo_2.png" title="ROSI" alt="ROSI" /></a>
        </div>
        <ul class="h_ul block black">
            <li><a href="/">首页<span>|</span></a></li>
            <li><a href="/x/sp/">视频<span>|</span></a></li>
            <li><a href="/x/vr/">V &nbsp;&thinsp;R<span>|</span></a></li>
            <li><a href="/x/app/">口罩<span>|</span></a></li>
            <li><a href="/x/rosi/">内衣<span>|</span></a></li>
            <li class="h_x"><a href="/x/sj/">商家<span >|</span></a></li>
            <li><a href="/x/shop/">商城<span>|</span></a></li>
            <li><a href="/x/sishu/">私属<span>|</span></a></li>
            <li><a href="/model.html">模特<span>|</span></a></li>
            <li><a href="/free.html">样张<span>|</span></a></li>
            <li><a href="/about.html">关于<span>|</span></a></li>
            <li><a href="/member/">会员</a></li>
        </ul>
        <div class="h_R block" id="_userlogin">
            <a href="/member/">登录</a>
            <a href="/member/index_do.php?fmdo=user&dopost=regnew">注册</a>
        </div>
    </nav>
    <nav class="h_nav_p"><p><script src='/Public/mn/js/ym.js' language='javascript'></script></p></nav>
</header>

<div class="body">
    <form method="post" action="<?php echo U(member/register);?>" id="regUser" name="form2" class="ajaxform">

        <ul class="meb_login">
            <li>
                <input class="input_out w200" type="text"  id="txtUsername" name="name" placeholder="账号" onfocus="this.placeholder = '';" onblur="if (this.placeholder == '') {this.placeholder = '账号';}"/><p id="_userid"></p></li>
            <li>
                <input class="input_out w200" type="password"   id="txtPassword" name="pwd" placeholder="密码" onfocus="this.placeholder = '';" onblur="if (this.placeholder == '') {this.placeholder = '密码';}"/></li>
            <li>
                <input class="input_out w200" type="password" id="userpwdok" name="pwd2" placeholder="确认密码" onfocus="this.placeholder = '';" onblur="if (this.placeholder == '') {this.placeholder = '确认密码';}"/><em id="_userpwdok"><font color="red"></font></em></li>
            <!-- <li> -->
            <!-- <input class="input_out w200" name="email" type="text"  id="email" placeholder="电子邮箱" onfocus="this.placeholder = '';" onblur="if (this.placeholder == '') {this.placeholder = '电子邮箱';}"/><p id="_email"></p></li> -->

            <li ><span>&nbsp;</span>
                <input type="checkbox" checked="" value="" id="agree" name="agree"/>
                我已阅读并完全接受服务协议 </li>
            <li><button class="meb_out log_btn" type="submit" id="btnSignCheck" >立刻注册</button></li>
            <li>已有账号，请 <a class="foot_a" href="<?php echo U('member/login');?>" target="_blank">登录</a></li>
        </ul>
    </form>
    <footer>
    <p class="con_foot"><span>声明</span>本站所有图片不含有淫秽\色情内容,如有违反法律请联系站长 rosiimage@gmail.com</p>
    <p class="con_foot"><span>版权</span>本站所有图片均属原创,版权归本站所有,未经同意请勿转载,多谢合作</p>
</footer>
</div>
<script src="/Public/js/jquery.min.js?v=2.1.4"></script>
<script src="/Public/js/jquery.form.min.js"></script>
<script src="/Public/js/layer/layer.js"></script>
<script src="/Public/js/common.js"></script>
</body>
</html>