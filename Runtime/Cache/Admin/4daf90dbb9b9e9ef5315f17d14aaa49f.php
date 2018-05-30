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
                        <h5>流水明细</h5>
                    </div>

                    <div class="ibox-content">

                        <form role="form" name="searchform" method="get" class="form-inline" >

                            <div class="form-group">
                                <label >类型</label>
                                <select class="form-control" name="type" >
                                    <option value="0">请选择</option>
                                    <?php if(is_array($process_type)): $i = 0; $__LIST__ = $process_type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" <?php if($key == $type): ?>selected<?php endif; ?>><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <input type="hidden" name="id" value="<?php echo ($_GET['id']); ?>">
                                <button type="submit" class="btn btn-outline btn-success" >搜索</button>
                            </div>


                        </form>
                        <p style="line-height: 10px;"></p>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>会员id</th>
                                    <!--<th>会员姓名</th>-->
                                    <th>操作人</th>
                                    <th>类别</th>
                                    <th>订单编号</th>
                                    <th>金额</th>
                                    <th>余额</th>
                                    <th>添加时间</th>
                                </tr>
                                </thead>
                                <tbody id="formlist">
                                <?php if(is_array($data["list"])): $i = 0; $__LIST__ = $data["list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="odd gradeA">
                                        <td><?php echo ($vo["id"]); ?></td>
                                        <td><?php echo ($vo["mid"]); ?></td>
                                        <!--<td><?php echo getFieldShow('s_member','nickname',array('id'=>$vo['mid']));?></td>-->
                                        <td><?php echo getFieldShow('user','username',array('id'=>$vo['uid']));?></td>
                                        <td><?php echo getConfig('process_type',$vo['process_type']);?></td>
                                        <td><?php echo getFieldShow('s_order','order_sn',array('id'=>$vo['order_id']));?></td>
                                        <td>
                                            <?php if(($vo["process_type"] == 2) OR ($vo["process_type"] == 11)): ?>-<?php else: ?>+<?php endif; ?>
                                            <?php echo ($vo["amount"]); ?>
                                        </td>
                                        <td><?php echo ($vo["balance"]); ?></td>
                                        <td><?php echo ($vo["created_at"]); ?></td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-12" style="float: none">
                            <div class="pagination" >共<?php echo ($data["count"]); ?>条</div>
                            <button type="button" style="margin-left: 50px;" onclick="history.go(-1)" class="btn btn-w-m btn-default">&nbsp;返回</button>
                            <ul class="pagination" id="page" style="float: right"><?php echo ($data["page"]); ?></ul>
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