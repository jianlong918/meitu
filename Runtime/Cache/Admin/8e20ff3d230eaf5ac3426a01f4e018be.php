<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"><meta name="renderer" content="webkit"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="description" content=""><title>后台管理系统</title><link rel="shortcut icon" href="favicon.ico"> <link href="/Public/admin/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet"><link href="/Public/admin/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet"><link href="/Public/admin/js/plugins/fancybox/jquery.fancybox.css" rel="stylesheet"><link href="/Public/admin/css/animate.min.css" rel="stylesheet"><link href="/Public/admin/css/style.min862f.css?v=4.1.0" rel="stylesheet"><link href="/Public/admin/css/plugins/iCheck/custom.css" rel="stylesheet"><script src="/Public/admin/js/jquery.min.js?v=2.1.4"></script>
    

</head>
<body class="gray-bg">

    <div class="wrapper wrapper-content animated fadeInRight" style="min-height: 250px;">
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        添加产品
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form role="form" class="ajaxform form-horizontal" action="<?php echo U('admin/shopproduct/save');?>"  method="post">
                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label"><span style="color:#F77DA6;">*</span>产品名称</label>
                                        <div class="col-sm-10">
                                            <input class="form-control"  type="text"   name="name" style="max-width:300px;">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label"><span style="color:#F77DA6;">*</span>所属栏目</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="typeid" style="max-width:300px;" >
                                                <option value="0">请选择</option>
                                                <?php echo ($type_list); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">是否推荐</label>
                                        <div class="col-sm-10" style="line-height: 33px; height: 33px;">

                                            <input class="radio i-checks" type="radio" name="is_recommend" value="1"> 是

                                            <input class="radio i-checks" type="radio" name="is_recommend" value="0" > 否
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label">所需积分</label>
                                        <div class="col-sm-10">
                                            <input class="form-control"  type="text"   name="price" style="max-width:300px;">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label">市场价格</label>
                                        <div class="col-sm-10">
                                            <input class="form-control"  type="text"   name="market_price" style="max-width:300px;">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label">限住人数</label>
                                        <div class="col-sm-10">
                                            <input class="form-control"  type="text"   name="max_num" style="max-width:300px;">
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label">年预定次数</label>
                                        <div class="col-sm-10">
                                            <input class="form-control"  type="text"   name="order_num" style="max-width:300px;">
                                        </div>
                                    </div>
									<div class="form-group ">
                                        <label  class="col-sm-2 control-label"></label>
                                        <div class="col-sm-10">
                                            	建议图片尺寸 425*285 或 同比例图片 若图片尺寸比例不统一 会出现对不齐 不美观的情况
                                        </div>
                                    </div>	
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">缩略图</label>
                                        <div class="col-sm-10">
                                        <div id="uploader-demo-pc">
                                            <!--用来存放item-->
                                            <div class="file-item-pc">
                                                <img class="img" src="<?php echo ($product["litpic"]); ?>" onerror="this.src='/Public/admin/img/no_img.jpg'" width="110px" height="100px">
                                                <div class="info" style="display:none;"></div>
                                                <input type="hidden" class="img_path_pc" name="litpic" value="<?php echo ($product["litpic"]); ?>">
                                            </div>
                                            <div id="filePicker-pc">选择图片</div>
                                        </div>
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label">产品图片集</label>
                                        <div id="uploader_product" class="pic_box">
                                            <!--用来存放item-->
                                            <div id="fileList1" class="uploader-list"></div>
                                            <div id="filePicker_product" style='margin-left: 100px;margin-top: -30px;' >选择图片</div>

                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label">所在地区</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="province_id" id="province_id" style="max-width:150px;float:left;">
                                                <option value="0">请选择</option>
                                                <?php if(is_array($districts)): $i = 0; $__LIST__ = $districts;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                            </select>
                                            <select class="form-control" id="city_id"  name="city_id"  style="max-width:150px;display: none;float:left;margin-left: 10px;">
                                            </select>
                                            <select class="form-control" id="area_id"  name="area_id"  style="max-width:150px;display: none;float:left;margin-left: 10px;">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label">详细地址</label>
                                        <div class="col-sm-10">
                                            <input class="form-control"  type="text"   name="address" style="max-width:300px;">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label">更新时间</label>
                                        <div class="col-sm-10">
                                            <input class="form-control"  type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})"  name="updated_at" style="max-width:300px;">
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label">入住须知</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" name="description" style="max-width:600px;height: 150px;" ></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label">基地详情</label>
                                        <div class="col-sm-10">
                                            <script type="text/plain" id="editor" name="content" style="width:95%;height:300px;"></script>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-w-m btn-info"><i class="fa fa-check"></i>&nbsp;提交</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.col-lg-6 (nested) -->
                            <div class="col-lg-6">

                            </div>
                            <!-- /.col-lg-6 (nested) -->
                        </div>
                        <!-- /.row (nested) -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>


<script src="/Public/admin/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/Public/admin/js/content.min.js?v=1.0.0"></script>
<script src="/Public/js/jquery.form.min.js"></script>
<script type="text/javascript" src="/Public/js/datepicker/WdatePicker.js"></script>
<script src="/Public/js/layer/layer.js" charset="utf-8"></script>
<script src="/Public/js/common.js" charset="utf-8"></script>
<script src="/Public/admin/js/plugins/iCheck/icheck.min.js"></script>
<script>
    $(document).ready(function(){$(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",})});
</script>









    <script type="text/javascript" charset="utf-8" src="/Public/js/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/Public/js/ueditor/ueditor.all.js"></script>

    <script type="text/javascript" src="/Public/js/webuploader_many/upload_img.js"></script>
    <script type="text/javascript" src="/Public/js/webuploader/upload_single.js"></script>
    <script type="text/javascript" src="/Public/js/datepicker/WdatePicker.js"></script>
    <!--单图上传-->
    <script type="text/javascript" src="/Public/js/webuploader/webuploader.js"></script>
    <link rel="stylesheet" href="/Public/js/webuploader/webuploader.css">
    <link rel="stylesheet" href="/Public/js/webuploader/demo.css">
    <script>
        upload_single('#filePicker-pc','file-item-pc','img_path_pc', '<?php echo U("Common/upload");?>','110','100')
    </script>
    <!--多图上传-->
    <script type="text/javascript" src="/Public/js/webuploader_many/webuploader.js"></script>
    <link rel="stylesheet" href="/Public/js/webuploader_many/webuploader.css">
    <link rel="stylesheet" href="/Public/js/webuploader_many/demo.css">
    <script>
        upload_img('#filePicker_product','#uploader_product',"file-item-li thumbnail","img[]",'<?php echo U("Common/upload");?>')
    </script>
    <script>
        var ue = UE.getEditor('editor',{
            autoHeightEnabled: true,
            autoFloatEnabled: true,
            //initialFrameWidth: 373,
            initialFrameHeight:668,
            toolbars: [
                ['fullscreen', 'source', 'undo', 'redo','simpleupload','insertvideo','justifyleft','justifyright','justifycenter','justifyjustify','bold', 'italic', 'underline', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc'],
            ]
        });

        // 选择不同的省的时候
        $("#province_id").change(function(){
            var province_id = $("#province_id").val();
            if (province_id != 0) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo U('admin/common/getcity');?>",
                    data: "province_id="+province_id,
                    success: function(msg){
                        $("#city_id").css("display", "");
                        $("#city_id").empty();
                        $("#city_id").append(msg);
                    }
                });
            } else {
                $("#city_id").css("display", "none").empty();
            }
        });
        // 选择不同的城市的时候
        $("#city_id").change(function(){
            var city = $("#city_id").val();
            if (city != 0) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo U('admin/common/getarea');?>",
                    data: "city_id=" + city,
                    success: function (msg) {
                        $("#area_id").css("display", "");
                        $("#area_id").empty();
                        $("#area_id").append(msg);
                    }
                });
            }else{
                $("#area_id").css("display", "none").empty();
            }
        });
    </script>

</body>
</html>