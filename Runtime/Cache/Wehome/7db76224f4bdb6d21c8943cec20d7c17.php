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
    body{height: 500px;}
    .liuyan{padding-bottom: 30px;}
</style>
<div id="pullrefresh" class="mui-content mui-scroll-wrapper" >
    <div class="mui-scroll">
        <style>
            .data dl dt.right .dtright p{ background: #f8ecec; display: inline-block; float: right;border:solid 1px #d3d3d3;border-radius:5px;}
            .data dl dt.left .dtright p{ background: #fff; display: inline-block; float: left;border:solid 1px #d3d3d3;border-radius:5px;}
        </style>
        <!--数据列表-->
        <ul class="mui-table-view mui-table-view-chevron" style="border: none">
            <li style="background: #f5f5f5">
                <div class="liuyan">
                    <div class="data">

                        <dl id="feedlist">
                            <?php if(!empty($reply)): ?><p style="clear: both"></p>
                                <dt class="left">
                                <div class="dtleft">
                                    <img src="/Public/Wehome/img/e1.jpg" width="41">
                                </div>
                                <div class="dtright">
                                    <img src="/Public/Wehome/img/jo1.png" class="po">
                                    <p><span><?php echo ($reply["content"]); ?></span></p>
                                </div>
                                </dt><?php endif; ?>
                            <?php if(is_array($feedbacks)): $i = 0; $__LIST__ = $feedbacks;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><p style="clear: both"></p>
                                <?php if(!empty($vo["created_at"])): ?><h5 style="clear: both; "><span><?php echo ($vo["created_at"]); ?></span></h5><?php endif; ?>
                                <p style="clear: both"></p>
                            <dt class="<?php if($vo["adminid"] != 0): ?>left <?php else: ?>right<?php endif; ?>">
                                <div class="dtleft">
                                    <img src="/Public/Wehome/img/e1.jpg" width="41">
                                </div>
                                <div class="dtright">
                                    <img src="/Public/Wehome/img/<?php if($vo["adminid"] != 0): ?>jo1.png <?php else: ?>jo2.png<?php endif; ?>" class="po">
                                    <p><span><?php echo ($vo["content"]); ?></span></p>
                                </div>
                            </dt><?php endforeach; endif; else: echo "" ;endif; ?>
                            

							
                        </dl>


                    </div>
                </div>
            </li>
        </ul>

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

    <link  href="/Public/js/mui/css/mui.min.css" rel="stylesheet" type="text/css">
    <script src="/Public/js/mui/js/mui.min.js"></script>
    <script>
        document.onreadystatechange = subSomething;//当页面加载状态改变的时候执行这个方法.
        function subSomething()
        {
            if(document.readyState == "complete"){ //当页面加载状态为完全结束时进入
               var scroll = mui('.mui-scroll-wrapper').scroll({indicators: false});
                scroll.scrollToBottom(1);
            }
        }
        mui.init({
            pullRefresh: {
                container: '#pullrefresh',
                down: {
                    callback: pulldownRefresh
                },

            }
        });

        /**
         * 下拉刷新具体业务实现
         */
        var page=1;
        function pulldownRefresh() {
            var content="";
            $.post("<?php echo U('load_more');?>", {page: page, limit: 10}, function(data) {
                if (data.status==1) {
                    page++;
                    content=data.content;
                    setTimeout(function() {
                       $("#feedlist p").first().before(content);
                        mui('#pullrefresh').pullRefresh().endPulldownToRefresh(); //refresh completed
                    }, 1000);
                } else {
                    msg_url(data.info);
                }
            }, 'json');

        }
    </script>

</body>
</html>