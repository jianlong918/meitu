<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"><meta name="renderer" content="webkit"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="description" content=""><title>后台管理系统</title><link rel="shortcut icon" href="favicon.ico"> <link href="/Public/admin/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet"><link href="/Public/admin/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet"><link href="/Public/admin/js/plugins/fancybox/jquery.fancybox.css" rel="stylesheet"><link href="/Public/admin/css/animate.min.css" rel="stylesheet"><link href="/Public/admin/css/style.min862f.css?v=4.1.0" rel="stylesheet"><link href="/Public/admin/css/plugins/iCheck/custom.css" rel="stylesheet"><script src="/Public/admin/js/jquery.min.js?v=2.1.4"></script>
    

</head>
<body class="gray-bg">


    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>订单编号</th>
                                <th>会员id</th>
                                <th>会员姓名</th>
                                <th>入住房间</th>
                                <th>开始时间</th>
                                <th>结束时间</th>
                                <th>消费积分</th>
                                <th>状态</th>
                                <th>添加时间</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr class="odd gradeA">
                                    <td><?php echo ($order["id"]); ?></td>
                                    <td><?php echo ($order["order_sn"]); ?></td>
                                    <td><?php echo ($order["mid"]); ?></td>
                                    <td><?php echo getFieldShow('s_member','real_name',array('id'=>$order['mid']));?></td>
                                    <td><?php echo getFieldShow('s_product','name',array('id'=>$order['product_id']));?></td>
                                    <td><?php echo ($order["begin_time"]); ?></td>
                                    <td><?php echo ($order["end_time"]); ?></td>
                                    <td><?php echo ($order["total"]); ?></td>
                                    <td><?php echo getConfig('status',$order['status']);?></td>
                                    <td><?php echo ($order["created_at"]); ?></td>
                                </tr>
                            </tbody>
                        </table>
                         </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>姓名</th>
                                    <th>联系方式</th>
                                    <th>身份证号</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(is_array($order_person)): $i = 0; $__LIST__ = $order_person;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="odd gradeA">
                                        <td><?php echo ($vo["name"]); ?></td>
                                        <td><?php echo ($vo["tel"]); ?></td>
                                        <td><?php echo ($vo["id_sn"]); ?></td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <?php if($order["status"] != 6): ?><button type="button" class="change_btn btn btn-w-m btn-danger" data-status="1">&nbsp;处理中</button>
                    <button type="button" class="change_btn btn btn-w-m btn-success" data-status="2">&nbsp;待入住</button>
                    <button type="button" class="change_btn btn btn-w-m btn-primary" data-status="3">&nbsp;已完成</button><?php endif; ?>
                    <button type="button" onclick="history.go(-1)" class="btn btn-w-m btn-default">&nbsp;返回</button>
                </div>
            </div>

        </div>

    </div>
    </div>
    <script>
        $('.change_btn').click(function(){
            var msg='确定要修改预约状态吗？'
            var status=$(this).attr('data-status')
            layer.confirm(msg, {
                        btn: ['确定','取消'], //按钮
                    }, function(index){
                        var order_id="<?php echo ($order["id"]); ?>"
                        $.post("<?php echo U('admin/shoporder/change_status');?>", {"status":status,"order_id":order_id},
                                function(data){
                                    msg_url(data.info);
                                    if(data.status==1){
                                        window.setTimeout("location.reload()",1000);
                                    }
                                }, "json");
                        layer.close(index);
                    }
            );
        })
    </script>

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