<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no;" name="viewport">
    <title>易房游</title>
    <link  href="/Public/Wehome/css/style.css" rel="stylesheet" type="text/css">

    
</head>
<body>

    <style>
        body{background:#f5f5f5}
    </style>
    <div class="head" style="padding:14px 0">    <div class="p2" style="top:14px">        <a style="color:#fff;" href="javascript:history.go(-1);"><img src="/Public/Wehome/img/o1.jpg"></a>    </div>    <p class="p1"><?php echo ($top_title); ?></p></div>
<div style="width: 100%; height: 100%;  left: 0; bottom: 0;  ">

    <div class="infooter" >
        <div class="tra"  >请输入您想要咨询的信息</div>
        <p>
            <input type="button" class="smi" value="提交" style="font-size: 14px;">
        </p>
    </div>


</div>
    <style type="text/css">
        .txrty{ background:#000000; background: rgba(0,0,0,0.5); position:fixed; left:0; top:0; width:100%; height:100%; font-size:14px;z-index: 999;display: none;}
        .txmain{ width:90%; background:#fff; margin:0 auto; margin-top:45%; border-radius:6px; padding-bottom:16px}
        .txtop{position:relative; text-align:center; padding-top:8px;  }
        .txtop a{ position:absolute; left:5%; top:8px}
        .txtop .shk{ position:absolute; right:5%; top:6px; color:#e60619; background:0; border:0; outline:none}
        .txtop .shk1{ position:absolute; left:5%; top:6px; color:#e60619; background:0; border:0; outline:none}
        .txbottom .pl{ width:90%; height:100px;font-size: 12px; resize:none; margin:0 auto; display:block; margin-top:10px; padding:5px 2.5%; outline:none; border:solid 1px  #cccccc; -webkit-appearance: none;}
        .txrty h4{font-size: 15px;color: #666666}
    </style>
    <form action="<?php echo U('Wehome/feedback/add');?>" id="feedform" method="post">
    <div class="txrty">
        <div class="txmain">
            <div class="txtop">
                <input  type="reset" class="shk1" value="关闭">
                <h4>我要评论</h4>
                <input type="submit" class="shk" value="发送">
            </div>
            <div class="txbottom">
                <textarea class="pl" placeholder="说点什么吧..." name="content" style="-webkit-user-select:auto;"></textarea>
            </div>

        </div>
    </div>
    </form>


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

    <link  href="/Public/js/mui/css/mui.min.css" rel="stylesheet" type="text/css">
    <script src="/Public/js/mui/js/mui.min.js"></script>
    <script type="text/javascript">
$(function(){
    $(".infooter").click(function(){
        $(".txrty").show();
    })
    $(".shk1").click(function(){
        $(".txrty").hide();
    })
})
        //启用双击监听
        mui.init({
            gestureConfig:{
                doubletap:true
            },
            subpages:[{
                url:"<?php echo U('Wehome/feedback/index_sub');?>",
                id:"subid",
                styles:{
                    top: '45px',
                    bottom: '80px'
                }
            }]
        });


    </script>
<script>

    $('#feedform').submit(function()//提交表单
    {
        var options = {
            url:$(this).attr('action'), //提交给哪个执行
            type:'POST',
            success: showResponse //回调函数
        };
        $(this).ajaxSubmit(options);
        return false; //为了不刷新页面,返回false，
    });
    function showResponse(responseText, statusText, xhr, form){
        if(statusText=='success'){
         //   layer.closeAll('loading');
          //  msg_url(responseText.info,responseText.url);
          //  $("#bef").before(responseText.cont);
          //  $('body,html').animate({scrollTop:$("#bef").offset().top},1);
            $(".txrty").hide();
            location.reload();
            return false;
        }
    }
    function msg_url(info,url){
        layer.open({
            content: info
            ,skin: 'msg'
            ,time: 1
            ,end: function(index){
                if(url!=""&& typeof(url)!="undefined"){
                    location.href = url;
                    return false;
                }
            }
        });
    }
</script>

</body>
</html>