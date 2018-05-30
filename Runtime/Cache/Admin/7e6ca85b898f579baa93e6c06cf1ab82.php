<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    

</head>
<body class="gray-bg">


    <div class="wrapper wrapper-content animated fadeInRight">        
        <div class="row">
            <div class="col-sm-6" style='width: 100%;'>
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>权限菜单管理</h5>
                        <?php if($auth->check( 'admin/purview/add', session('uid') )){ ?>
                        <a href="<?php echo U('admin/purview/add?pid=0');?>" class="btn btn-info btn-xs" style='margin-left: 20px'>添加顶级菜单</a>
                        <?php } ?>
                        <a href="<?php echo U('admin/auth/index');?>" class="btn btn-info btn-xs">权限刷新</a>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>上级菜单</th>
                                    <th>链接</th>
                                    <th>名称</th>
                                    <th>类型</th>
                                    <th>状态</th>
                                    <th>规则</th>
                                    <?php if($auth->check( 'admin/purview/add', session('uid') )||$auth->check( 'admin/purview/update', session('uid') )||$auth->check( 'admin/purview/del', session('uid') ) ){ ?>
                                    <th>操作</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>                                
                            <?php echo ($menu); ?>
                            </tbody>
                        </table>
                        </div>
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









    <script>

        function confirm_submit(url,data,success){
            layer.confirm('确定删除吗？', {
                btn: ['确定','取消'], //按钮
            }, function(){
                $.ajax({
                    type:"post",
                    url:url,
                    data:data,
                    success:success
                })
            })
        }

        function del(id){
            confirm_submit("<?php echo U('admin/purview/del');?>","id="+id,showResponse1)
        }

        function add(pid){
            if(pid!=0){
                msg_url('不能添加子权限！')
            }
        }

        function showResponse1(responseText, statusText, xhr, $form){
            if(responseText.status=="0"){
                msg_url(responseText.info);
            }else{
                msg_url(responseText.info);
                window.setTimeout("location.reload()",1000);
            }
        }
    </script>

</body>
</html>