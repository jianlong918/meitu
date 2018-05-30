<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no;" name="viewport">
    <title>易房游</title>
    <link  href="/Public/Wehome/css/style.css" rel="stylesheet" type="text/css">

    
</head>
<body>

    <div class="head">
    <form action="<?php echo U('search/index');?>"  method="get" >
        <div class="p1">
            <input class="text" placeholder="输入关键字进行搜索" name="keywords" style=" margin-left:5%; width:60%">
            <input type="image" src="/Public/Wehome/img/j1.jpg" class="sub" >
        </div>

        <div class="p4" style="top:15px; right:20px">
            <input type="button" value="取消" style="background:0; border:0; color:#fff" onclick="javascript:history.go(-1);">
        </div>
    </form>
</div>

    <p style="height:50px"></p>


    <div class="hotkword">
        <h3>热门关键词</h3>
        <ul>
            <?php if(is_array($hot_keywords)): $i = 0; $__LIST__ = $hot_keywords;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                    <a href="/Wehome/Search/index?keywords=<?php echo ($vo["word"]); ?>"><?php echo ($vo["word"]); ?></a>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>

    <div class="his">
        <h3>历史搜索</h3>
        <ul>
            <?php if(is_array($history_keywords)): $i = 0; $__LIST__ = $history_keywords;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                    <a href="/Wehome/Search/index?keywords=<?php echo ($vo["word"]); ?>"><?php echo ($vo["word"]); ?></a>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>

    </div>

    <div class="qingkong">
        <p><a id="clear">清空历史搜索</a></p>
    </div>
    <p style="height:70px"></p>

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
        $(function(){
            if("<?php echo (session('mid')); ?>"!=''){
                $('#clear').click(function(){
                    var status="<?php echo ($status); ?>"
                    $.post("<?php echo U('clear_history');?>",{"status":status},
                            function(data){
                                window.setTimeout("location.reload()",1000);
                            }, "json");
                })
            }
        });
    </script>

</body>
</html>