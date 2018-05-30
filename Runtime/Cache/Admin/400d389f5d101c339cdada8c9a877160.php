<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"><meta name="renderer" content="webkit"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="description" content=""><title>后台管理系统</title><link rel="shortcut icon" href="favicon.ico"> <link href="/Public/admin/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet"><link href="/Public/admin/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet"><link href="/Public/admin/js/plugins/fancybox/jquery.fancybox.css" rel="stylesheet"><link href="/Public/admin/css/animate.min.css" rel="stylesheet"><link href="/Public/admin/css/style.min862f.css?v=4.1.0" rel="stylesheet"><link href="/Public/admin/css/plugins/iCheck/custom.css" rel="stylesheet"><script src="/Public/admin/js/jquery.min.js?v=2.1.4"></script>
    
    <link href="/Public/admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
    <link href="/Public/admin/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">


</head>
<body class="gray-bg">

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-8">
                <h1 class="page-header"></h1>
                <div class="panel panel-default">
                    <div class="panel-heading">
            <b>权限管理</b>&nbsp;&nbsp;&nbsp;
                </div>
                <form action="<?php echo U('admin/usergroup/save');?>" class="ajaxform" method="post">
                <div class="panel panel-default">

                    <!-- /.panel-heading -->

                    <table class="table  table-bordered table-hover" id="dataTables-example" style="border-width:1px; width:100%;">
                        <input type="hidden" value="<?php echo ($id); ?>" name="id"/>
                        <?php echo ($menu); ?>
                        <tr><td colspan="7" align="center"><button type="submit" class="btn btn-w-m btn-info"><i class="fa fa-check"></i>&nbsp;提交</button></td></tr>
                    </table>



                </div>
                </form>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        </div>
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









    <script>
        function check(id){
            var classname=$("#son"+id).attr("class");
            var number=classname.substr(3);
            if($("#son"+id).is(':checked')){
                $("#parent"+number).prop('checked', 'true');
            }
        }

        function check1(i){
            if($("#parent"+i).is(':checked')){
                $(".son"+i).prop('checked', 'true');
            }

            if(!$("#parent"+i).is(':checked')){
                $(".son"+i).removeAttr("checked");
            }
        }
    </script>


</body>
</html>