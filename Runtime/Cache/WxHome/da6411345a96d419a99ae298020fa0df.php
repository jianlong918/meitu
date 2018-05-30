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

    <div class="head" style="padding:14px 0">    <div class="p2" style="top:14px">        <a style="color:#fff;"><img src="/Public/wxhome/img/o1.jpg"></a>    </div>    <p class="p1"><?php echo ($top_title); ?></p></div>
    <p style="height:55px"></p>
    <div class="liuyan">
        <div class="data">
            <h5><span>星期六  上午10:05</span></h5>
            <dl>
                <dt>
                <div class="dtleft">
                    <img src="/Public/wxhome/img/e1.jpg" width="100%">
                </div>
                <div class="dtright">
                    <img src="/Public/wxhome/img/jo1.png" class="po">
                    <p>您好，欢迎咨询易房游会员客服中心，
                        我们在收到您的留言后会在24小时内
                        予以回复。
                        若有紧急情况请拨打易房游客服电话:
                        400-661-8888</p>
                </div>
                </dt>
                <dd>
                    <div class="ddleft">
                        <img src="/Public/wxhome/img/e1.jpg" width="100%">
                    </div>
                    <div class="ddright">
                        <img src="/Public/wxhome/img/jo2.png" class="po">
                        <p>2222您好，欢迎咨询易房游会员客服中心，
                            我们在收到您的留言后会在24小时内
                            予以回复。</p>
                    </div>
                </dd>
            </dl>
        </div>
        <div class="data">
            <h5><span>星期六  上午10:05</span></h5>
            <dl>
                <dt>
                <div class="dtleft">
                    <img src="/Public/wxhome/img/e1.jpg" width="100%">
                </div>
                <div class="dtright">
                    <img src="/Public/wxhome/img/jo1.png" class="po">
                    <p>您好，欢迎咨询易房游会员客服中心，
                        我们在收到您的留言后会在24小时内
                        予以回复。
                        若有紧急情况请拨打易房游客服电话:
                        400-661-8888</p>
                </div>
                </dt>
                <dd>
                    <div class="ddleft">
                        <img src="/Public/wxhome/img/e1.jpg" width="100%">
                    </div>
                    <div class="ddright">
                        <img src="/Public/wxhome/img/jo2.png" class="po">
                        <p>您好，欢迎咨询易房游会员客服中心，
                            我们在收到您的留言后会在24小时内
                            予以回复。</p>
                    </div>
                </dd>
            </dl>
        </div>
        <div class="data">
            <h5><span>星期六  上午10:05</span></h5>
            <dl>
                <dt>
                <div class="dtleft">
                    <img src="/Public/wxhome/img/e1.jpg" width="100%">
                </div>
                <div class="dtright">
                    <img src="/Public/wxhome/img/jo1.png" class="po">
                    <p>您好，欢迎咨询易房游会员客服中心，
                        我们在收到您的留言后会在24小时内
                        予以回复。
                        若有紧急情况请拨打易房游客服电话:
                        400-661-8888</p>
                </div>
                </dt>
            </dl>
        </div>

    </div>
    <p style="height:70px"></p>
    <form action="<?php echo U('wxhome/feedback/add');?>" id="feedform" method="post">
    <div class="infooter">
        <textarea class="tra" placeholder="请输入您想要咨询的信息"></textarea>
        <p>
            <input type="submit" class="smi">
        </p>
    </div>
    </form>

<script src="http://apps.bdimg.com/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="/Public/js/jquery.form.min.js"></script>
<script src="/Public/js/layer_mobile/layer.js"></script>
<script src="/Public/js/common.js"></script>
<script src="/Public/wxhome/js/script.js"></script>
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
    $('#feedform').submit(function()//提交表单
    {
        var options = {
            url:$(this).attr('action'), //提交给哪个执行
            type:'POST',
            success: showResponse //回调函数
        };
        layer.load();
        $(this).ajaxSubmit(options);
        return false; //为了不刷新页面,返回false，
    });
    function showResponse(responseText, statusText, xhr, form){
        alert(123);
        if(statusText=='success'){
            layer.closeAll('loading');
            msg_url(responseText.info,responseText.url);
        }
    }
    function msg_url(info,url){
        layer.msg(info,{time:1000},function(){
            if(url!=""&& typeof(url)!="undefined"){
                location.href = url;
                return false;
            }
        });
    }
</script>

</body>
</html>