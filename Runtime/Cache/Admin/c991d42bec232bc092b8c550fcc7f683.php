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
                        编辑文章
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form role="form" class="ajaxform form-horizontal" action="<?php echo U('admin/newsarticle/usave');?>"  method="post">
                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label"><span style="color:#F77DA6;">*</span>文章标题</label>
                                        <div class="col-sm-10">
                                            <input class="form-control"  type="text"   name="title" value="<?php echo ($article["title"]); ?>" style="max-width:300px;">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label">简略标题</label>
                                        <div class="col-sm-10">
                                            <input class="form-control"  type="text"  name="shorttitle" value="<?php echo ($article["shorttitle"]); ?>" style="max-width:300px;">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label">自定义属性</label>
                                        <div class="col-sm-10">
                                            <div class="checkbox i-checks">
                                                <label>
                                                    <?php if(is_array($flag)): $k = 0; $__LIST__ = $flag;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><input type="checkbox" name="flag[]" value="<?php echo ($key); ?>" <?php if(in_array(($key), is_array($article["flag"])?$article["flag"]:explode(',',$article["flag"]))): ?>checked<?php endif; ?> ><?php echo ($vo); ?>&nbsp;&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label">TAG标签</label>
                                        <div class="col-sm-10">
                                            <input class="form-control"  type="text"   name="tags" value="<?php echo ($article["tags"]); ?>" style="max-width:300px;float: left;">
                                            <span style="float: left;padding-top:8px;">(用中文符号'，'号分开，单个标签小于20字节)</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">缩略图</label>
                                        <div class="col-sm-10">
                                            <div id="uploader-demo-pc">
                                                <!--用来存放item-->
                                                <div class="file-item-pc">
                                                    <img class="img" src="<?php echo ($article["litpic"]); ?>" onerror="this.src='/Public/admin/img/no_img.jpg'" width="110px" height="100px" >
                                                    <div class="info" style="display:none;"></div>
                                                    <input type="hidden" class="img_path_pc" name="litpic" value="<?php echo ($product["litpic"]); ?>">
                                                </div>
                                                <div id="filePicker-pc">选择图片</div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php if(!empty($article["img_arr"])): ?><div class="form-group ">
                                            <label  class="col-sm-2 control-label">产品已上传图片</label>
                                            <div class="col-sm-10">
                                                <?php if(is_array($article["img_arr"])): foreach($article["img_arr"] as $k=>$vo): ?><div class="tj" id="li_<?php echo ($k); ?>">
                                                        <img src="<?php echo ($vo); ?>" width="102px" height="102px">
                                                        <input type="hidden" id="li_path_<?php echo ($k); ?>" name="img[]" value="<?php echo ($vo); ?>">
                                                        <button type="button" style="margin-left: 35px;margin-top:5px;" onclick="del_li(<?php echo ($article["id"]); ?>,<?php echo ($k); ?>)">删除</button>
                                                    </div><?php endforeach; endif; ?>
                                            </div>
                                        </div><?php endif; ?>

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
                                            <input class="form-control"  type="text"   name="writer" value="<?php echo ($article["writer"]); ?>" style="max-width:300px;">
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label">点击量</label>
                                        <div class="col-sm-10">
                                            <input class="form-control"  type="text"   name="click" value="<?php echo ($article["click"]); ?>" style="max-width:300px;">
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
                                            <input class="radio i-checks" type="radio" name="notpost" value="0" <?php if($article["notpost"] == 0): ?>checked<?php endif; ?> > 允许评论

                                            <input class="radio i-checks" type="radio" name="notpost" value="1" <?php if($article["notpost"] == 1): ?>checked<?php endif; ?>  > 禁止评论
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label">文章权重</label>
                                        <div class="col-sm-10">
                                            <input class="form-control"  type="text"   name="weight" value="<?php echo ($article["weight"]); ?>" style="max-width:300px;float: left;">
                                            <span style="float: left;padding-top:8px;">（越小越靠前）</span>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label">置顶时间</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="sortup" style="max-width:300px;" >
                                                <option value="0">请选择</option>
                                                <?php if(is_array($sortup)): $k = 0; $__LIST__ = $sortup;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><option value="<?php echo ($key); ?>" <?php if($article["sortup"] == $key): ?>selected<?php endif; ?> ><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label">更新时间</label>
                                        <div class="col-sm-10">
                                            <input class="form-control"  type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})"  name="updated_at" value="<?php echo ($article["updated_at"]); ?>" style="max-width:300px;">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label">关键字</label>
                                        <div class="col-sm-10">
                                            <input class="form-control"  type="text"   name="keywords"  value="<?php echo ($article["keywords"]); ?>" style="max-width:300px;">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label">文章摘要</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" name="description" style="max-width:600px;height: 150px;" ><?php echo ($article["description"]); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label">详情</label>
                                        <div class="col-sm-10">
                                            <script type="text/plain" id="editor" name="content" style="width:95%;height:300px;"><?php echo ($article["body"]); ?></script>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <input type="hidden" name="id" value="<?php echo ($article["id"]); ?>">
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
    <!--单图上传-->
    <script type="text/javascript" src="/Public/js/webuploader/webuploader.js"></script>
    <link rel="stylesheet" href="/Public/js/webuploader/webuploader.css">
    <link rel="stylesheet" href="/Public/js/webuploader/demo.css">
    <script>
        upload_single('#filePicker-pc','file-item-pc','img_path_pc', '<?php echo U("Common/upload");?>','110','100')
    </script>

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
        function del_li(id,num){
            var path=$('#li_path_'+num).val()
            var msg='确定删除吗？'
            layer.confirm(msg, {
                        btn: ['确定','取消'], //按钮
                    }, function(){
                        $.post("<?php echo U('del_img');?>", {type:'extra_licence',id:id,path:path},
                                function(data){
                                    msg_url(data.info)
                                    if(data.status=="1"){
                                        $('#li_'+num).remove()
                                    }

                                }, "json");
                    }
            );
        }
    </script>

</body>
</html>