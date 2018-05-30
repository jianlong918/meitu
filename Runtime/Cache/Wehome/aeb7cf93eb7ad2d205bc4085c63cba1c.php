<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no;" name="viewport">
    <title>易房游</title>
    <link  href="/Public/Wehome/css/style.css" rel="stylesheet" type="text/css">

    
</head>
<body>

<div class="head" style="padding:14px 0">
    <p style="height:50px"></p>
    <style>
        .diz ul li p{padding-left:0}
    </style>
    <div class="main5">
        <h1><img src="/Public/Wehome/img/logo2.jpg"></h1>
    </div>
    <div class="banner5">
        <!--百度地图容器-->
        <div style="width:100%;height:200px;border:#ccc solid 1px;" id="dituContent"></div>
        <script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script>
        <script type="text/javascript">
            //创建和初始化地图函数：
            function initMap(){
                createMap();//创建地图
                setMapEvent();//设置地图事件
                addMapControl();//向地图添加控件
                addMarker();//向地图中添加marker
            }

            //创建地图函数：
            function createMap(){
                var map = new BMap.Map("dituContent");//在百度地图容器中创建一个地图
                var point = new BMap.Point(121.640988,36.819094);//定义一个中心点坐标
                map.centerAndZoom(point,15);//设定地图的中心点和坐标并将地图显示在地图容器中
                window.map = map;//将map变量存储在全局
            }

            //地图事件设置函数：
            function setMapEvent(){
                map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
                map.enableScrollWheelZoom();//启用地图滚轮放大缩小
                map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
                map.enableKeyboard();//启用键盘上下左右键移动地图
            }

            //地图控件添加函数：
            function addMapControl(){
                //向地图中添加缩放控件
                var ctrl_nav = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_LARGE});
                map.addControl(ctrl_nav);
                //向地图中添加比例尺控件
                var ctrl_sca = new BMap.ScaleControl({anchor:BMAP_ANCHOR_BOTTOM_LEFT});
                map.addControl(ctrl_sca);
            }

            //标注点数组
            var markerArr = [{title:"易房游",content:"联系电话：4006288808<br/>地址：山东省威海市银滩旅游度假区银海路银港东旅居国际城",point:"121.645192|36.817548",isOpen:0,icon:{w:23,h:25,l:46,t:21,x:9,lb:12}}
            ];
            //创建marker
            function addMarker(){
                for(var i=0;i<markerArr.length;i++){
                    var json = markerArr[i];
                    var p0 = json.point.split("|")[0];
                    var p1 = json.point.split("|")[1];
                    var point = new BMap.Point(p0,p1);
                    var iconImg = createIcon(json.icon);
                    var marker = new BMap.Marker(point,{icon:iconImg});
                    var iw = createInfoWindow(i);
                    var label = new BMap.Label(json.title,{"offset":new BMap.Size(json.icon.lb-json.icon.x+10,-20)});
                    marker.setLabel(label);
                    map.addOverlay(marker);
                    label.setStyle({
                        borderColor:"#808080",
                        color:"#333",
                        cursor:"pointer"
                    });

                    (function(){
                        var index = i;
                        var _iw = createInfoWindow(i);
                        var _marker = marker;
                        _marker.addEventListener("click",function(){
                            this.openInfoWindow(_iw);
                        });
                        _iw.addEventListener("open",function(){
                            _marker.getLabel().hide();
                        })
                        _iw.addEventListener("close",function(){
                            _marker.getLabel().show();
                        })
                        label.addEventListener("click",function(){
                            _marker.openInfoWindow(_iw);
                        })
                        if(!!json.isOpen){
                            label.hide();
                            _marker.openInfoWindow(_iw);
                        }
                    })()
                }
            }
            //创建InfoWindow
            function createInfoWindow(i){
                var json = markerArr[i];
                var iw = new BMap.InfoWindow("<b class='iw_poi_title' title='" + json.title + "'>" + json.title + "</b><div class='iw_poi_content'>"+json.content+"</div>");
                return iw;
            }
            //创建一个Icon
            function createIcon(json){
                var icon = new BMap.Icon("http://app.baidu.com/map/images/us_mk_icon.png", new BMap.Size(json.w,json.h),{imageOffset: new BMap.Size(-json.l,-json.t),infoWindowOffset:new BMap.Size(json.lb+5,1),offset:new BMap.Size(json.x,json.h)})
                return icon;
            }

            initMap();//创建和初始化地图
        </script>
    </div>

    <div class="diz">
        <?php echo ($article['content']); ?>

        <a href="<?php echo U('Wehome/ask/index');?>">问题反馈</a>
    </div>


    <p style="height:90px"></p>
<p style="height:90px"></p>
<?php $img1=""; $img2=""; $img3=""; $url = $_SERVER['REQUEST_URI']; $orderurl = strpos($url,"order"); $memberurl = strpos($url,"member"); $articlurl = strpos($url,"article"); if($orderurl>0){ $img2 = "style=\"background-image: url('/Public/Wehome/img/f2_1.png')\""; }else if($memberurl>0 || $articlurl>0){ $img3 = "style=\"background-image: url('/Public/Wehome/img/f3_1.png')\""; }else{ $img1 = "style=\"background-image: url('/Public/Wehome/img/f1_1.png')\""; } ?>
<div class="footer">
    <ul>
        <li class="li1" >
            <a href="/" <?php echo ($img1); ?>>首页</a>
        </li>
        <li class="li2" >
            <a href="<?php echo U('Wehome/order/index');?>" <?php echo ($img2); ?>>我的预约</a>
        </li>
        <li class="li3" >
            <a href="<?php echo U('Wehome/member/index');?>" <?php echo ($img3); ?>>会员中心</a>
        </li>
    </ul>
</div>
<script>
    var Str = location.href;
    var order = Str.indexOf("order",0);
    var member = Str.indexOf("member",0);
    if(order>0){
        document.querySelector("li a").style.backgroundImage="url("+currentImage+")";
    }
</script>


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