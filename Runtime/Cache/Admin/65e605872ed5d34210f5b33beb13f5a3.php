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
                        <h5>用户管理</h5>
                        <?php if($auth->check( 'admin/user/add', session('uid') )){ ?>
                        <a href="<?php echo U('admin/user/add');?>" class="btn btn-info btn-xs" style='margin-left: 20px'>添加</a>
                        <?php } ?>
                    </div>

                    <div class="ibox-content">



                            <form role="form" name="searchform" method="get" class="form-inline" >

                            <div class="form-group">
                                <label >所有者所在部门</label>
                                <select class="form-control"  name="usergroup" style="width: 100px;">
                                    <option value="0">请选择</option>
                                    <?php if(is_array($user_groups)): $i = 0; $__LIST__ = $user_groups;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" <?php if($key == $condition['usergroup']): ?>selected<?php endif; ?>><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
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
                                    <th>用户名</th>
                                    <th>用户分组</th>
                                    <th>邮箱</th>
                                    <th>真实姓名</th>
                                    <th>手机</th>
                                    <th>电话</th>
                                    <th>注册时间</th>
                                    <th>最后登录</th>
                                    <th>状态</th>
                                    <?php if($auth->check( 'admin/user/update', session('uid') )||$auth->check( 'admin/user/del', session('uid') )||$auth->check( 'admin/user/password', session('uid') )){ ?>
                                    <th>操作</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php if(is_array($data["list"])): $i = 0; $__LIST__ = $data["list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="odd gradeA">
                                            <td><?php echo ($vo["id"]); ?></td>
                                            <td><?php echo ($vo["username"]); ?></td>
                                            <td><?php echo getFieldShow('auth_group','title',array('id'=>$vo['usergroup']));?></td>
                                            <td class="center"><?php echo ($vo["email"]); ?></td>
                                            <td><?php echo ($vo["realname"]); ?></td>
                                            <td><?php echo ($vo["mobile"]); ?></td>
                                            <td><?php echo ($vo["tel"]); ?></td>
                                            <td><?php echo ($vo["created_at"]); ?></td>
                                            <td><?php echo ($vo["lasttime"]); ?></td>
                                            <td><?php if($vo["status"] == 1): ?>启用 <?php elseif($vo["status"] == 0): ?>禁用<?php endif; ?></td>
                                            <?php if($auth->check( 'admin/user/update', session('uid') )||$auth->check( 'admin/user/del', session('uid') )||$auth->check( 'admin/user/password', session('uid') )){ ?>
                                            <td class="center">
                                                <?php if($auth->check( 'admin/user/update', session('uid') )){ ?>
                                                <a href="/admin/user/update?id=<?php echo ($vo["id"]); ?>" class="badge badge-primary">修改</a>&nbsp;&nbsp;
                                                <?php } ?>
                                                <?php if($auth->check( 'admin/user/del', session('uid') )){ ?>
                                                <a href="javascript:void(0);" class="badge badge-danger" onclick="confirm_del(this)" data-url="<?php echo u('del');?>" data-id="<?php echo ($vo["id"]); ?>" data-msg="确定要删除吗">删除</a>&nbsp;&nbsp;
                                                <?php } ?>
                                                <?php if($auth->check( 'admin/user/password', session('uid') )){ ?>
                                                <a href="/admin/user/password?id=<?php echo ($vo["id"]); ?>" class="badge badge-success" >修改密码</a>
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