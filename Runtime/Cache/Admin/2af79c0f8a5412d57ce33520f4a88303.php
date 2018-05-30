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
                        <h5>会员等级管理</h5>
                        <?php if($auth->check( 'admin/shoplevel/add', session('uid') )){ ?>
                        <a href="<?php echo U('admin/shoplevel/add');?>" class="btn btn-info btn-xs" style='margin-left: 20px'>添加</a>
                        <?php } ?>
                    </div>

                    <div class="ibox-content">
                        <p style="line-height: 10px;"></p>
                        <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>等级名称</th>
                                    <th>会员积分</th>
                                    <th>添加时间</th>
                                    <?php if($auth->check( 'admin/shoplevel/update', session('uid') )||$auth->check( 'admin/shoplevel/del', session('uid') )){ ?>
                                    <th>操作</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php if(is_array($data["list"])): $i = 0; $__LIST__ = $data["list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="odd gradeA">
                                            <td><?php echo ($vo["id"]); ?></td>
                                            <td><?php echo ($vo["level_name"]); ?></td>
                                            <td><?php echo ($vo["amount"]); ?></td>
                                            <td><?php echo ($vo["created_at"]); ?></td>
                                            <?php if($auth->check( 'admin/shoplevel/update', session('uid') )||$auth->check( 'admin/shoplevel/del', session('uid') )){ ?>
                                            <td class="center">
                                                <?php if($vo['id']!=1){ ?>
                                                    <?php if($auth->check( 'admin/shoplevel/update', session('uid') )){ ?>
                                                    <a href="/admin/shoplevel/update?id=<?php echo ($vo["id"]); ?>" class="badge badge-primary">修改</a>&nbsp;&nbsp;
                                                    <?php } ?>
                                                    <?php if($auth->check( 'admin/shoplevel/del', session('uid') )){ ?>
                                                    <a href="javascript:void(0);" class="badge badge-danger" onclick="confirm_del(this)" data-url="<?php echo u('del');?>" data-id="<?php echo ($vo["id"]); ?>" data-msg="确定要删除吗">删除</a>&nbsp;&nbsp;
                                                    <?php } ?>
                                                <?php } ?>
                                            </td>
                                            <?php } ?>
                                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                        </div>
                        <div class="col-lg-12" style="float: none">
                            <div class="pagination" >共<?php echo ($data["count"]); ?>条</div>
                            <ul class="pagination" id="page" style="float: right"><?php echo ($data["page"]); ?></ul>
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