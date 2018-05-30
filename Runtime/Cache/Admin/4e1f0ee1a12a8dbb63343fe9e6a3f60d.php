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
                        添加用户
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form role="form" class="ajaxform form-horizontal" action="<?php echo U('admin/user/save');?>"  method="post">
                                    <div class="form-group ">
                                        <label  class="col-sm-2 control-label"><span style="color:#F77DA6;">*</span>用户名</label>
                                        <div class="col-sm-10">
                                            <input class="form-control"  type="text"   name="username" style="max-width:300px;">

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"><span style="color:#F77DA6;">*</span>用户组</label>
                                        <div class="col-sm-10" style="line-height: 33px; height: 33px;" >
                                              <?php if(is_array($usergroup)): $i = 0; $__LIST__ = $usergroup;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><input type="radio" class="radio i-checks" name="usergroup" value="<?php echo ($vo["id"]); ?>" ><?php echo ($vo["title"]); ?>&nbsp;&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"><span style="color:#F77DA6;">*</span>密码</label>
                                        <div class="col-sm-10">
                                            <input class="form-control"  type="password"  name="password"  style="max-width:300px;">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">邮箱</label>
                                        <div class="col-sm-10">
                                            <input class="form-control"  type="text"  name="email" style="max-width:300px;">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"><span style="color:#F77DA6;">*</span>真实姓名</label>
                                        <div class="col-sm-10">
                                            <input class="form-control"  type="text"  name="realname" style="max-width:300px;">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">性别</label>
                                        <div class="col-sm-10" style="line-height: 33px; height: 33px;">

                                            <input class="radio i-checks" type="radio" name="sex" value="1"> 男

                                            <input class="radio i-checks" type="radio" name="sex" value="2" > 女

                                            <input class="radio i-checks"  type="radio" name="sex" value="0" checked="checked"> 保密

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">联系电话</label>
                                        <div class="col-sm-10">
                                            <input class="form-control"  type="text"  name="tel" style="max-width:300px;">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"><span style="color:#F77DA6;">*</span>手机</label>
                                        <div class="col-sm-10">
                                            <input class="form-control"  type="text"  name="mobile" style="max-width:300px;">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">传真</label>
                                        <div class="col-sm-10">
                                            <input class="form-control"  type="text"  name="fax" style="max-width:300px;">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">联系地址</label>
                                        <div class="col-sm-8">
                                            <input class="form-control"  type="text"   name="address" style="max-width:300px;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">状态</label>
                                        <div class="col-sm-8" style="line-height: 33px; height: 33px;">

                                            <input class="radio i-checks" type="radio" name="status" value="1" checked="checked" > 启用

                                            <input class="radio i-checks" type="radio" name="status" value="0" > 禁用
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










</body>
</html>