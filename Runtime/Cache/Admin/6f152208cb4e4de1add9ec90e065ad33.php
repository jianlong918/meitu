<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    

</head>
<body class="gray-bg">

    <div class="wrapper wrapper-content animated fadeInRight" style="min-height: 250px;">
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        添加广告
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form role="form" class="ajaxform form-horizontal" action="<?php echo U('admin/ads/save');?>"  method="post">
                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label">标题</label>
                                        <div class="col-sm-10">
                                            <input class="form-control"  type="text" name="title" style="max-width:300px;">
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label">位置</label>
                                        <div class="col-sm-10">
                                            <input class="form-control"  type="text" name="position" style="max-width:300px;">
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label">位置标识(英文)</label>
                                        <div class="col-sm-10">
                                            <input class="form-control"  type="text" name="position_sn" style="max-width:300px;">
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label">链接</label>
                                        <div class="col-sm-10">
                                            <input class="form-control"  type="text" name="url" style="max-width:300px;">
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label">排序</label>
                                        <div class="col-sm-10">
                                            <input class="form-control"  type="text" name="sortrank" style="max-width:300px;">
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label">广告图片(640*430)</label>
                                        <div class="col-sm-10">
                                            <div id="uploader-demo">
                                                <!--用来存放item-->
                                                <div class="file-item">
                                                    <img class="img" src="<?php echo ($ads["img"]); ?>" onerror="this.src='/Public/admin/img/no_img.jpg'" style="height: 100px;" >
                                                    <div class="info" style="display:none;"></div>
                                                    <input type="hidden" class="img_path" name="img" value="<?php echo ($ads["img"]); ?>">
                                                </div>
                                                <div id="filePicker">选择图片</div>
                                            </div>
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
<script src="/Public/js/layer/layer.js"></script>
<script src="/Public/js/common.js"></script>
<script src="/Public/admin/js/plugins/iCheck/icheck.min.js"></script>
<script>
    $(document).ready(function(){$(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",})});
</script>









    <script type="text/javascript" src="/Public/js/webuploader/webuploader.js"></script>
    <script type="text/javascript" src="/Public/js/webuploader/upload_single.js"></script>
    <script type="text/javascript" src="/Public/js/datepicker/WdatePicker.js"></script>
    <link rel="stylesheet" href="/Public/js/webuploader/webuploader.css">
    <link rel="stylesheet" href="/Public/js/webuploader/demo.css">
    <script>
        upload_single('#filePicker','file-item','img_path', '<?php echo U("Common/upload");?>','150','100')
    </script>

</body>
</html>