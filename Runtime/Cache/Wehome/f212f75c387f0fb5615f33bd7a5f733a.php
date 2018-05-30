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


    <div class="tabbox">
        <div class="tableft">
            <ul>
                <?php if(is_array($types)): $i = 0; $__LIST__ = $types;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li  <?php if($i == 1): ?>class="cur"<?php endif; ?> ><?php echo ($vo["typename"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
            <div class="tabright">
                <?php if(is_array($types_product)): $i = 0; $__LIST__ = $types_product;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><!--tab-->
                <div class="tabmain" <?php if($i == 1): ?>style="display:block"<?php endif; ?> >
                    <?php if(is_array($vo['product'])): $i = 0; $__LIST__ = $vo['product'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$son_vo): $mod = ($i % 2 );++$i;?><dl>
                        <dt><a href="<?php echo U('p_detail',array('id'=>$son_vo['id']));?>" ><img src="<?php echo ($son_vo["litpic"]); ?>" width="100%"></a></dt>
                        <dd><?php echo (mb_substr($son_vo["name"],0,22,'UTF-8')); ?></dd>
                    </dl><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <!--tab--><?php endforeach; endif; else: echo "" ;endif; ?>
             </div>




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

</body>
</html>