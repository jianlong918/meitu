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
                        编辑栏目
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form role="form" class="ajaxform form-horizontal" action="<?php echo U('admin/newstype/usave');?>"  method="post">
                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label"><span style="color:#F77DA6;">*</span>栏目名称</label>
                                        <div class="col-sm-10">
                                            <input class="form-control"  type="text" name="typename" value="<?php echo ($type["typename"]); ?>" style="max-width:300px;">

                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label">上级菜单</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="pid" style="max-width:300px;" >
                                                    <option value="0">顶级菜单</option>
                                                    <?php echo ($res); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">栏目排序</label>
                                        <div class="col-sm-10">
                                            <input class="form-control"  type="text"  name="sortrank"  value="<?php echo ($type["sortrank"]); ?>" style="max-width:300px;">
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label">栏目内容</label>
                                        <div class="col-sm-10">
                                            <script type="text/plain" id="editor" name="content" style="width:90%;height:300px;"><?php echo ($type["content"]); ?></script>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <input  type="hidden"  name="id" value="<?php echo ($type["id"]); ?>">
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
    <script>
        var ue = UE.getEditor('editor',{
            autoHeightEnabled: true,
            autoFloatEnabled: true,
            //initialFrameWidth: 373,
            initialFrameHeight:168,
            toolbars: [
                ['fullscreen', 'source', 'undo', 'redo','simpleupload','insertvideo','justifyleft','justifyright','justifycenter','justifyjustify','bold', 'italic', 'underline', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc'],
            ]
        });
    </script>

</body>
</html>