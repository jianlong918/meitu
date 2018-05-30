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
                        添加文章
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form role="form" class="ajaxform form-horizontal" action="<?php echo U('admin/newsarticle/save');?>"  method="post">
                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label"><span style="color:#F77DA6;">*</span>文章标题</label>
                                        <div class="col-sm-10">
                                            <input class="form-control"  type="text"   name="title" style="max-width:300px;">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label">简略标题</label>
                                        <div class="col-sm-10">
                                            <input class="form-control"  type="text"   name="shorttitle" style="max-width:300px;">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label">自定义属性</label>
                                        <div class="col-sm-10">
                                            <div class="checkbox i-checks">
                                                <label>
                                                  <?php if(is_array($flag)): $k = 0; $__LIST__ = $flag;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><input type="checkbox" name="flag[]" value="<?php echo ($key); ?>" ><?php echo ($vo); ?>&nbsp;&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label">TAG标签</label>
                                        <div class="col-sm-10">
                                            <input class="form-control"  type="text"   name="tags" style="max-width:300px;float: left;">
                                            <span style="float: left;padding-top:8px;">(用中文符号'，'号分开，单个标签小于20字节)</span>
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
                                        <label  class="col-sm-2 control-label">作者</label>
                                        <div class="col-sm-10">
                                            <input class="form-control"  type="text"   name="writer" style="max-width:300px;">
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label">点击量</label>
                                        <div class="col-sm-10">
                                            <input class="form-control"  type="text"   name="click" style="max-width:300px;">
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
                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label">评论选项</label>
                                        <div class="col-sm-10" style="line-height: 33px; height: 33px;" >
                                            <input class="radio i-checks" type="radio" name="notpost" value="0"> 允许评论

                                            <input class="radio i-checks" type="radio" name="notpost" value="1" > 禁止评论
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label">文章权重</label>
                                        <div class="col-sm-10">
                                            <input class="form-control"  type="text"   name="weight" style="max-width:300px;float: left;">
                                            <span style="float: left;padding-top:8px;">（越小越靠前）</span>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label">置顶时间</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="sortup" style="max-width:300px;" >
                                                <option value="0">请选择</option>
                                                <?php if(is_array($sortup)): $k = 0; $__LIST__ = $sortup;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><option value="<?php echo ($key); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label">更新时间</label>
                                        <div class="col-sm-10">
                                            <input class="form-control"  type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})"  name="updated_at" style="max-width:300px;">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label">关键字</label>
                                        <div class="col-sm-10">
                                            <input class="form-control"  type="text"   name="keywords" style="max-width:300px;">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label">文章摘要</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" name="description" style="max-width:600px;height: 150px;" ></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label">详情</label>
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
    <script>
        var ue = UE.getEditor('editor',{
            autoHeightEnabled: true,
            autoFloatEnabled: true,
            //initialFrameWidth: 373,
            initialFrameHeight:668,
            toolbars: [
                ['fullscreen', 'source', 'undo', 'redo','simpleupload','insertimage','insertvideo','justifyleft','justifyright','justifycenter','justifyjustify','bold', 'italic', 'underline', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc'],
            ]
        });
    </script>
    <script type="text/javascript" src="/Public/js/webuploader_many/upload_img.js"></script>
    <script type="text/javascript" src="/Public/js/webuploader/upload_single.js"></script>
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

</body>
</html>