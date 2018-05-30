<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"><meta name="renderer" content="webkit"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="description" content=""><title>后台管理系统</title><link rel="shortcut icon" href="favicon.ico"> <link href="/Public/admin/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet"><link href="/Public/admin/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet"><link href="/Public/admin/js/plugins/fancybox/jquery.fancybox.css" rel="stylesheet"><link href="/Public/admin/css/animate.min.css" rel="stylesheet"><link href="/Public/admin/css/style.min862f.css?v=4.1.0" rel="stylesheet"><link href="/Public/admin/css/plugins/iCheck/custom.css" rel="stylesheet"><script src="/Public/admin/js/jquery.min.js?v=2.1.4"></script>
    

</head>
<body class="gray-bg">

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                <div class="ibox-title">
                    <h5>权限菜单管理</h5>
                    <a href="<?php echo U('admin/auth/index');?>" class="btn btn-info btn-xs" style='margin-left: 20px' >权限刷新</a>
                </div>
                <div class="ibox-content">
                    <!-- /.panel-heading -->
                    <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTables-example">
                        <form role="form" class="ajaxform form-horizontal" action="<?php echo U('admin/auth/save_many');?>"  method="post">
                        <thead>
                        <tr>
                            <th>父级权限</th>
                            <th>链接</th>
                            <th>名称</th>
                            <th>状态</th>
                            <th>规则</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($new_rule)): foreach($new_rule as $key=>$rule): ?><tr class="odd gradeX">
                                <td><select name="pid[]" id="pid" >
                                    <option value="">请选择</option>
                                    <option value="0">顶级菜单</option>
                                    <?php if(is_array($auth_rules)): $i = 0; $__LIST__ = $auth_rules;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                </select></td>
                                <td><input style="border:none;width:200px;" name="name[]" type="text" value="<?php echo ($rule); ?>"></td>
                                <td><input name="title[]" type="text" placeholder="请填写名称"></td>
                                <td><select name="status[]"  >
                                    <option value="0">禁用</option>
                                    <option value="1" selected="selected">启用</option>
                                </select></td>
                                <td><input name="condition[]" type="text" placeholder="请填写规则"></td>

                            </tr><?php endforeach; endif; ?>
                        <tr class="odd gradeX">
                            <td colspan="14">
                                <button type="submit" class="btn btn-w-m btn-info" >保存</button>

                            </td>
                        </tr>
                        </tbody>
                        </form>
                    </table>
                    </div>
                </div>
               </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
    <!-- /#page-wrapper -->

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