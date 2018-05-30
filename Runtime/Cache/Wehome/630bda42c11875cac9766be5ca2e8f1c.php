<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no;" name="viewport">
    <title>易房游</title>
    <link  href="/Public/Wehome/css/style.css" rel="stylesheet" type="text/css">

    
</head>
<body>

    <div class="head" style=" padding:14px 0">

        <div class="p2" style="top:14px">
            <a style="color:#fff;" href="javascript:history.go(-1);"><img src="/Public/Wehome/img/o1.jpg"></a>
        </div>
        <p class="p1">消息</p>
        <div class="p4" style="top:14px; right:15px;" id="del">
            编辑
        </div>

    </div>
    <p style="height:60px"></p>
    <?php if(is_array($message)): $i = 0; $__LIST__ = $message;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="shanbox">
        <div class="shan">
            <div class="shanleft">
                <dl>
                    <dt><img src="/Public/Wehome/img/tx1.jpg" width="100%"></dt>
                    <dd>
                        <h3><?php echo ($vo["type"]); ?><span><?php echo ($vo["created_at"]); ?></span></h3>
                        <p><?php echo ($vo["content"]); ?></p>
                    </dd>
                </dl>
            </div>
            <div class="shanright">
                <a href="javascript:void(0)" onclick="del_message(<?php echo ($vo["id"]); ?>)">删除</a>
            </div>
        </div>
    </div><?php endforeach; endif; else: echo "" ;endif; ?>
    <span id="add_content" style="height: 0px;"></span>

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

    <script>
        $(function() {
            /*瀑布流*/
            var page = 1;
            var loading = false;

            $(window).scroll(function() {
                if ($(window).scrollTop() + $(window).height() >= $(document).height() ) {
                    loadMore();
                }
            });

            function loadMore() {
                if (loading === false) {
                    loading = true;
                    $.post("<?php echo U('member/more_message');?>", {page: page}, function(data) {
                        if (data.status==1) {
                            page++;
                            var content=data.content
                            $("#add_content").append(content);
                            loading = false;
                        } else {
                            msg_url(data.info);
                        }
                    }, 'json');
                } else {
                    return;
                }
            }
        });

        function del_message(id){
            $.post("<?php echo U('member/message_del');?>", {"id":id},
                    function(data){
                        msg_url(data.info);
                        if(data.status==1){
                            window.setTimeout("location.reload()",1000);
                        }
                    }, "json");
        }
    </script>
     <script>
        $(document).ready(function() {
            $.post("<?php echo U('message/readmessage');?>");
        });
    </script>

</body>
</html>