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
                        <h5>产品管理</h5>
                        <?php if($auth->check( 'admin/shopproduct/add', session('uid') )){ ?>
                        <a href="<?php echo U('admin/shopproduct/add');?>" class="btn btn-info btn-xs" style='margin-left: 20px'>添加</a>
                        <?php } ?>
                        <?php if($auth->check( 'admin/shopproduct/del_many', session('uid') )){ ?>
                        <a href="javascript:void(0)" onclick="confirm_del_many()" class="btn btn-danger btn-xs" style='margin-left: 20px'>删除</a>
                        <?php } ?>
                    </div>

                    <div class="ibox-content">

                        <form role="form" name="searchform" method="get" class="form-inline" >
                            <div class="form-group">
                                <label >产品名称</label>
                                <input class="form-control" type="text" name="name" value="<?php echo ($search["name"]); ?>">
                            </div>
                            <div class="form-group">
                                <label >产品分类</label>
                                <select name="typeid" id="" class="form-control">
                                    <option value="0">请选择</option>
                                    <?php if(is_array($types)): $i = 0; $__LIST__ = $types;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if($vo["id"] == $search["typeid"] ): ?>selected<?php endif; ?>><?php echo ($vo["typename"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
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
                                <th><input type="checkbox" onclick="checkAll(this)" ></th>
                                <th>id</th>
                                <th>产品名称</th>
                                <th>是否推荐</th>
                                <th>分类</th>
                                <th>所需积分</th>
                                <th>限制人数</th>
                                <th>更新时间</th>
                                <?php if($auth->check( 'admin/shopproduct/update', session('uid') )||$auth->check( 'admin/shopproduct/del', session('uid') )){ ?>
                                <th>操作</th>
                                <?php } ?>
                            </tr>
                            </thead>
                            <tbody id="formlist">
                            <?php if(is_array($data["list"])): $i = 0; $__LIST__ = $data["list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="odd gradeA">
                                    <td><input type="checkbox" name="ids[]" value=<?php echo ($vo["id"]); ?>></td>
                                    <td><?php echo ($vo["id"]); ?></td>
                                    <td><?php echo ($vo["name"]); ?></td>
                                    <td>
                                        <?php if(!empty($vo["is_recommend"])): ?>是
                                        <?php else: ?>
                                            否<?php endif; ?>
                                    </td>
                                    <td><?php echo getFieldShow('s_type','typename',array('id'=>$vo['typeid']));?></td>
                                    <td><?php echo ($vo["price"]); ?></td>
                                    <td><?php echo ($vo["max_num"]); ?></td>
                                    <td><?php echo ($vo["updated_at"]); ?></td>
                                    <?php if($auth->check( 'admin/shopproduct/update', session('uid') )||$auth->check( 'admin/shopproduct/del', session('uid') )){ ?>
                                    <td class="center">
                                        <?php if($auth->check( 'admin/shopproduct/update', session('uid') )){ ?>
                                        <a href="/admin/shopproduct/update?id=<?php echo ($vo["id"]); ?>" class="badge badge-primary">修改</a>&nbsp;&nbsp;
                                        <?php } ?>
                                        <?php if($auth->check( 'admin/shopproduct/del', session('uid') )){ ?>
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
    <script>
        function confirm_del_many(status){
            var data=checked_data();
            if(data==''){
                msg_url('请选择至少一个产品！')
                return false;
            }else{
                var msg ='确定删除吗？';
                layer.confirm(msg, {
                            btn: ['确定','取消'], //按钮
                        }, function(index){
                            $.post("<?php echo U('admin/shopproduct/del_many');?>", {"ids":data},
                                    function(data){
                                        msg_url(data.info);
                                        if(data.status==1){
                                            window.setTimeout("location.reload()",1000);
                                        }
                                    }, "json");
                            layer.close(index);
                        }
                );
            }
        }

        function checkAll(t,tname){
            tname = tname?tname:'ids[]';
            var tcheck = $(t).is(':checked');
            $("input[name='"+tname+"']").prop('checked', tcheck);
        }

        function checked_data(){
            var data= $("#formlist").find("input:checked").map(function(index,elem) {
                return $(elem).val();
            }).get().join(',');
            return data;
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