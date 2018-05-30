<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no;" name="viewport">
    <title>易房游</title>
    <link  href="/Public/Wehome/css/style.css" rel="stylesheet" type="text/css">

    
</head>
<body>

    <div class="head" style="padding:14px 0">    <div class="p2" style="top:14px">        <a style="color:#fff;" href="javascript:history.go(-1);"><img src="/Public/Wehome/img/o1.jpg"></a>    </div>    <p class="p1"><?php echo ($top_title); ?></p></div>

    <p style="height:20px"></p>
    <div class="main">

        <?php if(!empty($products)): if(is_array($products)): $i = 0; $__LIST__ = $products;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('p_detail',array('id'=>$vo['id']));?>">
            <dl>
                <dt><img src="<?php echo ($vo["litpic"]); ?>" width="100%"></dt>
                <dd>
                    <h3><?php echo (mb_substr($vo["name"],0,22,'UTF-8')); ?></h3>
                    <p>
                        <span class="s1">[<?php echo getFieldShow('s_type','typename',array('id'=>$vo['typeid']));?>]</span>
                        <span class="s2"><img src="/Public/Wehome/img/s1.jpg"></span>
                    </p>
                </dd>
            </dl>
             </a><?php endforeach; endif; else: echo "" ;endif; ?>
            <?php else: ?>
            <p style="margin: 0 auto;text-align: center;margin-top: 50px;">还没有发布产品哦！</p><?php endif; ?>


    </div>
    <p style="height:70px"></p>


<script src="http://apps.bdimg.com/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="/Public/js/jquery.form.min.js"></script>
<script src="/Public/js/layer_mobile/layer.js"></script>
<script src="/Public/js/commonwehome.js"></script>
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