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
                    <div class="ibox-title">
                        <h5>预约管理</h5>
                    </div>
                    <style>
                        .form-group{margin-top: 3px;}
                    </style>
                    <div class="ibox-content">

                        <form role="form" name="searchform" method="get" class="form-inline" >

                            <div class="form-group">
                                <label >订单编号</label>
                                <input class="form-control" type="text" name="order_sn" value="<?php echo ($search['order_sn']); ?>">
                            </div>

                            <div class="form-group">
                                <label >订单状态</label>
                                <select class="form-control" name="status" >
                                    <option value="0" >请选择</option>
                                    <?php if(is_array($order_status)): $i = 0; $__LIST__ = $order_status;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" <?php if($search['status'] == $key): ?>selected<?php endif; ?> ><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label >姓名</label>
                                <input class="form-control" type="text" name="real_name" value="<?php echo ($search['real_name']); ?>">
                            </div>
                            <div class="form-group">
                                <label >电话</label>
                                <input class="form-control" type="text" name="tel" value="<?php echo ($search['tel']); ?>">
                            </div>
                            <div class="form-group">
                                <label >入住基地</label>
                                <input class="form-control" type="text" name="product_name" value="<?php echo ($search['product_name']); ?>">
                            </div>
                            <div class="form-group">
                                <label >预约时间</label>
                                <input class="form-control" type="text" name="s_yuyue" value="<?php echo ($search['s_yuyue']); ?>" onClick="WdatePicker()">
                                <input class="form-control" type="text" name="e_yuyue" value="<?php echo ($search['e_yuyue']); ?>" onClick="WdatePicker()">
                            </div>
                            <div class="form-group">
                                <label >入住时间</label>
                                <input class="form-control" type="text" name="s_ruzhu" value="<?php echo ($search['s_ruzhu']); ?>" onClick="WdatePicker()">
                                <input class="form-control" type="text" name="e_ruzhu" value="<?php echo ($search['e_ruzhu']); ?>" onClick="WdatePicker()">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-outline btn-success" >搜索</button>
                            </div>


                        </form>
                        <p style="line-height: 10px;"></p>
                        <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>订单编号</th>
                                <th>会员姓名</th>
                                <th>会员电话</th>
                                <th>入住房间</th>
                                <th>开始时间</th>
                                <th>结束时间</th>
                                <th>消费积分</th>
                                <th>状态</th>
                                <?php if($auth->check( 'admin/shoporder/detail', session('uid') )||$auth->check( 'admin/shoporder/cancel', session('uid') )){ ?>
                                <th>操作</th>
                                <?php } ?>
                            </tr>
                            </thead>
                            <tbody id="formlist">
                            <?php if(is_array($data["list"])): $i = 0; $__LIST__ = $data["list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="odd gradeA">
                                    <td><?php echo ($vo["id"]); ?></td>
                                    <td><?php echo ($vo["order_sn"]); ?></td>
                                    <td><?php echo getFieldShow('s_member','real_name',array('id'=>$vo['mid']));?></td>
                                    <td><?php echo ($vo["tel"]); ?></td>
                                    <td><?php echo getFieldShow('s_product','name',array('id'=>$vo['product_id']));?></td>
                                    <td><?php echo ($vo["begin_time"]); ?></td>
                                    <td><?php echo ($vo["end_time"]); ?></td>
                                    <td><?php echo ($vo["total"]); ?></td>
                                    <td><?php echo getConfig('order_status',$vo['status']);?></td>
                                    <?php if($auth->check( 'admin/shoporder/detail', session('uid') )||$auth->check( 'admin/shoporder/cancel', session('uid') )){ ?>
                                    <td class="center">
                                        <?php if($auth->check( 'admin/shoporder/detail', session('uid') )){ ?>
                                        <a href="/admin/shoporder/detail?id=<?php echo ($vo["id"]); ?>" class="badge badge-primary">详情</a>&nbsp;&nbsp;
                                        <?php } ?>
                                        <?php if($auth->check( 'admin/shoporder/cancel', session('uid') )){ ?>
                                        <a href="javascript:void(0);" class="badge badge-danger" onclick="confirm_del(this)" data-url="<?php echo u('cancel');?>" data-id="<?php echo ($vo["id"]); ?>" data-msg="确定要取消吗">取消</a>&nbsp;&nbsp;
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