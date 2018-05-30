<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    

</head>
<body class="gray-bg">

    <body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">        
        <div class="row">
            <div class="col-sm-6" style='width: 100%'>
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>用户组管理</h5>
                        <?php if($auth->check( 'admin/usergroup/add', session('uid') )){ ?>
                    <a href="<?php echo U('admin/usergroup/add');?>" class="btn btn-info btn-xs" style='margin-left: 20px'>添加</a>
                    <?php } ?>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>名称</th>
                                    <th>状态</th>
                                    <?php if($auth->check( 'admin/usergroup/update', session('uid') )||$auth->check( 'admin/usergroup/del', session('uid') )||$auth->check( 'admin/usergroup/purview', session('uid') )){ ?>
                                    <th>操作</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="odd gradeX">
                                <td><?php echo ($vo["id"]); ?></td>
                                <td><?php echo ($vo["title"]); ?></td>
                                <td><?php if($vo["status"] == 1): ?>启用 <?php elseif($vo["status"] == 0): ?>禁用<?php endif; ?></td>
                                <?php if($auth->check( 'admin/usergroup/update', session('uid') )||$auth->check( 'admin/usergroup/del', session('uid') )||$auth->check( 'admin/usergroup/purview', session('uid') )){ ?>
                                <td class="center">
                                    <?php if($auth->check( 'admin/usergroup/update', session('uid') )){ ?>
                                    <a href="/admin/usergroup/update?id=<?php echo ($vo["id"]); ?>" class="badge badge-primary">修改</a>&nbsp;&nbsp;
                                    <?php } ?>
                                    <?php if($auth->check( 'admin/usergroup/del', session('uid') )){ ?>
                                    <a href="javascript:void(0);" class="badge badge-danger" onclick="confirm_del(this)" data-url="<?php echo u('del');?>" data-id="<?php echo ($vo["id"]); ?>" data-msg="确定要删除吗">删除</a>&nbsp;&nbsp;
                                    <?php } ?>
                                    <?php if($auth->check( 'admin/usergroup/purview', session('uid') )){ ?>
                                    <a a href="/admin/usergroup/purview?id=<?php echo ($vo["id"]); ?>" class="badge badge-success">权限操作</a>&nbsp;&nbsp;
                                    <?php } ?>
                                </td>
                                <?php } ?>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                        </div>
                        <div class="col-lg-12">
                            <div class="pagination" >共<?php echo ($count); ?>条</div>
                            <ul class="pagination"><?php echo ($page); ?></ul>
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











</body>
</html>