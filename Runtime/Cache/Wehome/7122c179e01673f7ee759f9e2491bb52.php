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
    <?php if(!empty($products)): if(is_array($products)): $i = 0; $__LIST__ = $products;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="seaacce">
        <a href="<?php echo U('Wehome/index/p_detail',array('id'=>$vo['id']));?>">
        <dl>
            <dt><img src="<?php echo ($vo["litpic"]); ?>" width="100%"></dt>
            <dd>
                <h4><?php echo ($vo["name"]); ?></h4>
                <h5>[<?php echo getFieldShow('s_type','typename',array('id'=>$vo['typeid']));?>]</h5>
                <p>
                    <span class="s1">￥300/日</span>
                    <span class="s2"><img src="/Public/Wehome/img/s1.jpg"></span>
                </p>
            </dd>
        </dl>
        </a>
    </div><?php endforeach; endif; else: echo "" ;endif; ?>
    <?php else: ?>
        <p style="height:70px;text-align: center;margin-top: 50px;" >对不起，没有你要的搜索结果~~</p><?php endif; ?>

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

</body>
</html>