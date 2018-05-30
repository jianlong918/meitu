<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"><meta name="renderer" content="webkit"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="description" content=""><title>后台管理系统</title><link rel="shortcut icon" href="favicon.ico"> <link href="/Public/admin/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet"><link href="/Public/admin/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet"><link href="/Public/admin/js/plugins/fancybox/jquery.fancybox.css" rel="stylesheet"><link href="/Public/admin/css/animate.min.css" rel="stylesheet"><link href="/Public/admin/css/style.min862f.css?v=4.1.0" rel="stylesheet"><link href="/Public/admin/css/plugins/iCheck/custom.css" rel="stylesheet"><script src="/Public/admin/js/jquery.min.js?v=2.1.4"></script>
    

</head>
<body class="gray-bg">


    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-6" style='width: 100%'>
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>会员管理</h5>
                    </div>

                    <div class="ibox-content">

                        <form role="form" name="searchform" method="get" class="form-inline" >

                            <div class="form-group">
                                <label >会员名</label>
                                <input class="form-control" type="text" name="name" value="<?php echo ($search['real_name']); ?>">
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
                                <th>会员名</th>
                                <th>注册时间</th>
                                <th>到期时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody id="formlist">
                            <?php if(is_array($data["list"])): $i = 0; $__LIST__ = $data["list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="odd gradeA">
                                    <td><?php echo ($vo["id"]); ?></td>
                                    <td><?php echo ($vo["nickname"]); ?></td>
                                    <td><?php echo ($vo["created_at"]); ?></td>
                                    <td><?php echo ($vo["expire_at"]); ?></td>
                                    <td class="center">
                                        <a href="/admin/shopmember/update?id=<?php echo ($vo["id"]); ?>" class="badge badge-danger">编辑</a>&nbsp;&nbsp;
                                    </td>
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
    <div class="form-group" id="pay" style="display: none;">
        <div class="col-sm-10" style="margin-top: 15px;width:230px;">
            <form method="post" action="<?php echo U('admin/shopmember/recharge');?>" class="ajaxform">
                <select name="paytype" id="" class="form-control" style="width:150px;">
                    <option value="1">增加</option>
                    <option value="2">减少</option>
                </select>
                <!--<span style="float:left;margin-top:18px;">积分：</span>-->
                <input class="form-control" id="pay_v" name="pay" placeholder="填写积分数" type="text" style="width:150px;margin-top:10px;height:32px;left: 16px;float:left;">
                 <input type="hidden" name="mid" id="mid">
                <input type="hidden" name="httpref" id="url" value="<?php echo ($_SERVER['REQUEST_URI']); ?>">
                <input type="submit" id='btn' style="display: none">
            </form>
        </div>
    </div>
    <div class="form-group" id="level" style="display: none;">
        <div class="col-sm-10" style="margin-top: 15px;">
            <select class="form-control" id="level_v" style="width:200px;">
                <option value="0">请选择</option>
                <?php if(is_array($level)): $i = 0; $__LIST__ = $level;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["level_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
    </div>
    <script>
        function recharge(id){
            $("#mid").val(id);
            layer.open({
                title:'充值',
                type: 1,
                skin: 'layui-layer-rim', //加上边框
                shade: 0.6,
                area: ['250px', '200px'], //宽高
                content: $('#pay'),
                btn: ['确定']
                ,yes: function(index, layero){
                    var pay=$('#pay_v').val();
                    if(pay==''){
                        msg_url('请输入充值金额！');
                        return false;
                    }
                    $("#btn").click();
                }
            });
        }

        function change_level(id){
            layer.open({
                title:'会员等级',
                type: 1,
                skin: 'layui-layer-rim', //加上边框
                shade: 0.6,
                area: ['250px', '170px'], //宽高
                content: $('#level'),
                btn: ['确定']
                ,yes: function(index, layero){
                    var level_id=$('#level_v').val();
                    if(level_id==''){
                        msg_url('请选择会员等级！');
                        return false;
                    }

                    $.post("<?php echo U('admin/shopmember/change_level');?>", {"id":id,"level_id":level_id},
                            function(data){
                                msg_url(data.info);
                                if(data.status==1){
                                    window.setTimeout("location.reload()",1000);
                                }
                            }, "json");
                    layer.close(index);
                }

            });
        }
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