<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    

</head>
<body class="gray-bg">


    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-6" style='width: 100%'>
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>栏目管理</h5>
                        <?php if($auth->check( 'admin/shoptype/add', session('uid') )){ ?>
                        <a href="<?php echo U('admin/shoptype/add/pid/0');?>" class="btn btn-info btn-xs" style='margin-left: 20px'>添加顶级栏目</a>
                        <?php } ?>
                    </div>
                    
                    <div class="ibox-content">
                        <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>栏目名称</th>
                                    <th>排序</th>
                                    <?php if($auth->check( 'admin/shoptype/update', session('uid') )||$auth->check( 'admin/shoptype/del', session('uid') )||$auth->check( 'admin/shoptype/add', session('uid') )){ ?>
                                    <th>操作</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                               <?php echo ($show); ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>

            </div>

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