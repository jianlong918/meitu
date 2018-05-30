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
        html,body{width:100%; height:100%}
    </style>
    <div class="head" style="padding:12px 0">    <div class="p2" style="top:14px">        <a style="color:#fff;" href="javascript:history.go(-1);"><img src="/Public/Wehome/img/o1.jpg"></a>    </div>    <p class="p1"><?php echo ($top_title); ?></p></div>
    <p style="height:20px"></p>
    <div class="banner3">
        <img src="<?php echo ($product["litpic"]); ?>" width="100%">
    </div>
    <style>


        /*.dtop input{*/
            /*-webkit-user-select:none;*/
        /*}*/

        /*.dtop .p2 input.name_0,.dtop .p2 input.tel_0,.dtop .p2 input.sn_0{*/
            /*-webkit-user-select:auto;*/

        /*}*/

    </style>
    <form class="ajaxform1" action="<?php echo U('wehome/order/save');?>"  method="post">
        <div class="dtop">
            <p class="p1">
                <span class="s1"><?php echo ($product["name"]); ?></span>
            </p>
            <p class="p2">
                <label>房间价格：</label><span class="price"><span class="jifen"><?php echo ($product["price"]); ?></span>积分／日</span>
                &nbsp;&nbsp;<span class="price">限住<?php echo ($product["max_num"]); ?>人</span>
            </p>
            <p class="p2" style="position: relative">
                <label>开始时间：</label><input type="text"  readonly="" name="begin_time" class="tre" id="beginTime"  >
                <span style="width: 100%; display: block; height: 41px; position: absolute; left: 0; top: 0; " id="beginTime1"></span>
            </p>
            <p class="p2" style="border-bottom:none" style="position: relative">
                <label>结束时间：</label><input type="text"  readonly="" name="end_time" class="tre" id="endTime" >
                <span style="width: 100%; display: block; height: 41px; position: absolute; left: 0; top: 0; " id="endTime1"></span>
            </p>
        </div>

        <div class="yuyue">
            <p>需提前至少20天预约</p>
        </div>

        <div class="dtop dtop1" index="1">
            <p class="p2">
                <label>真实姓名：</label><input type="text" name="name[]" class="tre name name_0" style="background:none">
                <span style="width:20px; display: block; height: 100%; position: absolute;right: 0;  vertical-align: middle;" class="cha" onclick="cha(this);"><img width="80%" src="/Public/Wehome/img/cha.png" style=" margin-top: 12px;"></span>
            </p>
            <p class="p2" >
                <label>联系电话：</label><input type="number" name="tel[]" class="tre tel tel_0" style="background:none">
            </p>
            <p class="p2" style="border-bottom:none">
                <label>身份证号：</label><input type="number" name="id_sn[]" class="tre sn sn_0" style="background:none">
            </p>
        </div>

        <a class="add">新增住户</a>
        <p style="height:100px"></p>

        <div class="lfooter">
            <div class="lleft">
                <p>合计：<span><font class="sum1"></font>积分（共<font class="sum3"></font>人-居住<font class="sum2"></font>天）</span>  </p>
            </div>
            <div class="lright">
                <input type="hidden" value="<?php echo ($product["id"]); ?>" name="product_id">
                <a id="acce">确认预约</a>
            </div>
        </div>

        <div class="tachubox" style="display:none; z-index:99999999999999999">
            <div class="tanchu">
                <h3><img src="/Public/Wehome/img/logo2.jpg"></h3>
                <div class="zmain">
                    <h4>会员需知</h4>
                   <?php echo ($xuzhi); ?>
                </div>

                <button class="agree" type="submit">同 意</button>
            </div>

        </div>
    </form>

    <div id="datePlugin"></div>

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



    <link  href="/Public/Wehome/dateiscroll/common.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="/Public/Wehome/dateiscroll/date.js" ></script>
    <script type="text/javascript" src="/Public/Wehome/dateiscroll/iscroll.js" ></script>
    <script type="text/javascript">
        var date_rs;
        var jifen = $(".jifen").text();
        var maxpeople = <?php echo ($product["max_num"]); ?>;
        var people=$(".dtop1").length;
        var o = 1
        $(function(){
            $(".sum3").text(o)
            $(document).on("keyup",".dtop1",function(){
//                if($(this).find("input").val()!=""){
//                    $(".sum3").text($(".dtop1").length)
//
//                }
//                else{
//
//                    $(".sum3").text($(".dtop1").length-1)
//                }

            })
            $('#beginTime1').date({
                fromat: 'yyyy-mm-dd'
            },function(e){
                $("#beginTime").val(e);
                checkdate();
            });
            $('#endTime1').date({
                fromat: 'yyyy-mm-dd'
            },function(e){
                $("#endTime").val(e);
                checkdate();
            });
        });



        function checkdate(){

            var cnum = Math.ceil(o/maxpeople);
           // var chengji = jifen*cnum
           // alert(cnum);
            if($("#beginTime").val()!=""&&$("#endTime").val()!=""){
                var sta = $("#beginTime").val();
                var end =$("#endTime").val();
                var dateFrom = new Date(sta);
                var dateTo   = new Date(end);
                date_rs = dateTo-dateFrom;
                if(date_rs<=0){
                    msg_url('入住时间应该大于一天')
                }else{
                    var date_sum = parseInt(date_rs/(1000*60*60*24));
                    $(".sum2").text(date_sum);
                    var sum1 = jifen*date_sum*cnum;
                    $(".sum1").text(sum1);
                }


            }
        }

    </script>


    <script>


            $("#acce").click(function(){

                var endTime = $("#endTime").val();
                var beginTime = $("#beginTime").val();
                var mydate = new Date();
                var year1 = mydate.getFullYear();
                var month1 = (mydate.getMonth()+1);
                var day1 = (mydate.getDate());
                if(month1<10){
                    month1 = "0"+month1;
                }
                if(day1<10){
                    day1 = "0"+day1;
                }
                var nowdate1 = year1+"-"+month1+"-"+day1;
                var dateFrom = new Date(beginTime);
                var nowdate =  new Date(nowdate1);

                var daters = parseInt((dateFrom - nowdate)/(1000*60*60*24));

                var length=$(".dtop1").length;

                if($('#beginTime').val()==''){
                    msg_url('请填写开始时间！')
                    return false
                }
                if(daters<20){
                    msg_url('请提前20天预约！')
                    return false
                }

                if($('#endTime').val()==''){
                    msg_url('请填写结束时间！')
                    return false
                }



                if($('.dtop1').eq($(".dtop1").length-1).find("p").find("input.name").val()==""){

                    msg_url('请填写真实姓名！')
                    return false

                }
                if($('.dtop1').eq($(".dtop1").length-1).find("input.tel").val()==""){
                    msg_url('请填写联系方式！')
                    return false

                }
                if(!/^1[34578]\d{9}$/.test($('.dtop1').eq($(".dtop1").length-1).find("input.tel").val())){
                    msg_url('联系方式格式错误！')
                    return false

                }

                if($('.dtop1').eq($(".dtop1").length-1).find("input.sn").val()==""){
                    msg_url('请填写身份证号！')
                    return false

                }
                if(!/^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X|x)$/.test($('.dtop1').eq($(".dtop1").length-1).find("input.sn").val())){
                    msg_url('身份证号格式错误！')
                    return false

                }

                $(".tachubox").show()

            })
            $(".tachubox .tanchu").click(function(e){
                e.stopPropagation();
            })
            $(".tachubox").click(function(){
                $(this).hide()

            })


            $(".add").click(function(){
                if($("#endTime").val()==""||$("#startTime").val()==""){
                    alert("请填写日期");
                    return false
                }
                if($('.dtop1').eq($(".dtop1").length-1).find("p").find("input.name").val()==""){

                    msg_url('请填写真实姓名！')
                    return false

                }
                if($('.dtop1').eq($(".dtop1").length-1).find("input.tel").val()==""){
                    msg_url('请填写联系方式！')
                    return false

                }
                if(!/^1[34578]\d{9}$/.test($('.dtop1').eq($(".dtop1").length-1).find("input.tel").val())){
                    msg_url('联系方式格式错误！')
                    return false

                }

                if($('.dtop1').eq($(".dtop1").length-1).find("input.sn").val()==""){
                    msg_url('请填写身份证号！')
                    return false

                }
                if(!/^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X|x)$/.test($('.dtop1').eq($(".dtop1").length-1).find("input.sn").val())){
                    msg_url('身份证号格式错误！')
                    return false

                }

                else{
                    o++
                    $(".sum3").text(o)

                    var cnum = Math.ceil(o/maxpeople);

                    var sta = $("#beginTime").val();
                    var end =$("#endTime").val();
                    var dateFrom = new Date(sta);
                    var dateTo   = new Date(end);
                    date_rs = dateTo-dateFrom;

                    var date_sum = parseInt(date_rs/(1000*60*60*24));
                    $(".sum2").text(date_sum);
                    var sum1 = jifen*date_sum*cnum;
                    $(".sum1").text(sum1);

                }

                var add1 = '<div class="dtop dtop1"><p class="p2"><label>真实姓名：</label><input type="text" name="name[]" class="tre name" style="background:none"><span style="width:20px; display: block; height: 100%; position: absolute;right: 0;  vertical-align: middle;" class="cha" onclick="cha(this);"><img width="80%" src="/Public/Wehome/img/cha.png"  style=" margin-top: 12px;"></span></p><p class="p2" > ' +
                        '<label>联系电话：</label><input type="text" name="tel[]" class="tre tel" style="background:none"></p>' +
                        '<p class="p2" style="border-bottom:none">' +
                        '<label>身份证号：</label><input type="text" name="id_sn[]" class="tre sn" style="background:none"></p></div>';
                $(this).before(add1)
                ++i




            })


            $(function(){
                $(document).on("click",".dtop1 img",function(){
                    if(o>1){
                        o--
                    }else{
                        alert("至少住一人")
                    }

                    var cnum = Math.ceil(o/maxpeople);

                        var sta = $("#beginTime").val();
                        var end =$("#endTime").val();
                        var dateFrom = new Date(sta);
                        var dateTo   = new Date(end);
                        date_rs = dateTo-dateFrom;

                            var date_sum = parseInt(date_rs/(1000*60*60*24));
                            $(".sum2").text(date_sum);
                            var sum1 = jifen*date_sum*cnum;
                            $(".sum1").text(sum1);

                            $(".sum3").text(o);



                })


            })

        function cha(a){
            var att = $(a).parent().parent();
            var index = att.attr("index");
            if(index!=1){
                att.remove();
                i = i-1;
            }
        }
    </script>

    <script>
        jQuery(document).ready(function($){
            $('.ajaxform1').submit(function()//提交表单
            {
                var options = {
                    url:$(this).attr('action'), //提交给哪个执行
                    type:'POST',
                    dataType: 'json',
                    success: showResponse1 //回调函数
                };

                //  layer.open({type: 2});
                $(this).ajaxSubmit(options);
                return false; //为了不刷新页面,返回false，
            });
        });
        function showResponse1(responseText, statusText, xhr, form){
            if(statusText=='success'){
                //  layer.closeAll('loading');
                $(".tachubox").hide()
                if(responseText.status==1){
                    var cont = "<img src=\"/Public/Wehome/img/r1.jpg\" width=\"100%\" class=\"top\"><p> 您的预约已提交<br>旅居国际客服将在24小时内与您联系<br>或致电旅居国际免费客服热线：<br>400-628-8808</p><a href=\"<?php echo U('Wehome/order/index');?>\">查看预约</a><img src=\"/Public/Wehome/img/r1.jpg\" width=\"100%\" class=\"bottom\">";
                    acce_alert(cont);
                }else{
                    msg_url(responseText.info,responseText.url);
                }
            }
        }
    </script>

</body>
</html>