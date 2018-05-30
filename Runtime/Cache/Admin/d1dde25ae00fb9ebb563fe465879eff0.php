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
                        <h5>反馈问题管理</h5>
                    </div>

                    <div class="ibox-content">
                        <p style="line-height: 10px;"></p>
                        <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>会员id</th>
                                <th>会员姓名</th>
                                <th style="width: 550px;">反馈内容</th>
                                <th>添加时间</th>
                                <?php if($auth->check( 'admin/ask/del', session('uid'))){ ?>
                                <th>操作</th>
                                <?php } ?>
                            </tr>
                            </thead>
                            <tbody id="formlist">
                            <?php if(is_array($data["list"])): $i = 0; $__LIST__ = $data["list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="odd gradeA">
                                    <td><?php echo ($vo["id"]); ?></td>
                                    <td><?php echo ($vo["mid"]); ?></td>
                                    <td><?php echo getFieldShow('s_member','real_name',array('id'=>$vo['mid']));?></td>
                                    <td><?php echo ($vo["content"]); ?></td>
                                    <td><?php echo ($vo["created_at"]); ?></td>
                                    <?php if($auth->check( 'admin/ask/del', session('uid') )){ ?>
                                    <td class="center">
                                        <if condition="$vo.flag eq true">
                                        <?php if($auth->check( 'admin/ask/del', session('uid') )){ ?>
                                        <a href="javascript:void(0);" class="badge badge-danger" onclick="confirm_del(this)" data-url="<?php echo u('del');?>" data-id="<?php echo ($vo["id"]); ?>" data-msg="确定要删除吗">删除</a>&nbsp;&nbsp;
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
<script src="/Public/js/layer/layer.js"></script>
<script src="/Public/js/common.js"></script>
<script src="/Public/admin/js/plugins/iCheck/icheck.min.js"></script>
<script>
    $(document).ready(function(){$(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",})});
</script>









</body>
</html>