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
    <div class="jfmxbox">
        <div class="jftop">
            <div class="jfm">
                <div class="jfleft">
                    当前总积分：
                </div>
                <div class="jfright">
                    <?php echo ($balance); ?>
                </div>
            </div>
        </div>
        <p style="height:15px;"></p>
        <div class="jfmain1">
            <div class="jftl">
                <div class="jftlmain">
                    <div class="jftlleft">来源/用途</div>
                    <div class="jftlright">积分变化</div>
                </div>
            </div>

            <?php if(is_array($pay_log)): $i = 0; $__LIST__ = $pay_log;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dl class="botsol">
                <dd class="jfneirong">
                    <div class="nleft">
                        <h4><?php echo ($vo["name"]); ?></h4>
                        <span><?php echo ($vo["created_at"]); ?></span>
                    </div>
                    <div class="nright <?php if(($vo["process_type"] == 1) OR ($vo["process_type"] == 3) OR ($vo["process_type"] == 4)): ?>jfred<?php endif; ?>"><?php if($vo["process_type"] == 2): ?>-<?php else: ?>+<?php endif; echo ($vo["amount"]); ?></div>
                </dd>
            </dl><?php endforeach; endif; else: echo "" ;endif; ?>
            <span id="add_content" style="height: 0px;"></span>
        </div>
    </div>

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
                    $.post("<?php echo U('member/more_paylog');?>", {page: page}, function(data) {
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
    </script>

</body>
</html>