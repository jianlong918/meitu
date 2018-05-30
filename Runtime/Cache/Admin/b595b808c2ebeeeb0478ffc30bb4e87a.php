<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"><meta name="renderer" content="webkit"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="description" content=""><title>后台管理系统</title><link rel="shortcut icon" href="favicon.ico"> <link href="/Public/admin/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet"><link href="/Public/admin/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet"><link href="/Public/admin/js/plugins/fancybox/jquery.fancybox.css" rel="stylesheet"><link href="/Public/admin/css/animate.min.css" rel="stylesheet"><link href="/Public/admin/css/style.min862f.css?v=4.1.0" rel="stylesheet"><link href="/Public/admin/css/plugins/iCheck/custom.css" rel="stylesheet"><script src="/Public/admin/js/jquery.min.js?v=2.1.4"></script>
    <style>
        .nav-header .dropdown-menu{min-width: 114px;}
    </style>
</head>
    <body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
    <div id="wrapper">
        <!--左侧导航开始-->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="nav-close"><i class="fa fa-times-circle"></i>
            </div>
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element" style="margin:0 auto;">
                            <span><img alt="image" class="img-circle" src="/Public/admin/img/profile_small.jpg" width="64"/></span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                               <span class="block m-t-xs"><strong class="font-bold"><?php echo ($user["username"]); ?></strong></span>
                                <span class="text-muted text-xs block"><?php echo getFieldShow('auth_group','title',array('id'=>$user['usergroup']));?><b class="caret"></b></span>
                                </span>
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                
                                <li><a class="J_menuItem" href="/Admin/User/update?id=<?php echo ($user["id"]); ?>">个人资料</a>
                                </li>                                
                                <li class="divider"></li>
                                <li><a href="/Admin/login/logout">安全退出</a>
                                </li>
                            </ul>
                        </div>
                        <div class="logo-element">YL
                        </div>
                    </li>

                    <li>
                        <a href="<?php echo U('index/index');?>">
                            <i class="fa fa-home"></i>
                            <span class="nav-label">主页</span>
                        </a>
                    </li>

                    <?php if($auth->check( 'admin/user', session('uid') )){ ?>
                    <li>
                        <a href="#">
                            <i class="fa fa-user"></i>
                            <span class="nav-label">用户管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <?php if($auth->check( 'admin/user/index', session('uid') )){ ?>
                            <li>
                                <a class="J_menuItem" href="<?php echo U('admin/user/index');?>">用户管理</a>
                            </li>
                            <?php } ?>
                            <?php if($auth->check( 'admin/usergroup/index', session('uid') )){ ?>
                            <li>
                                <a class="J_menuItem" href="<?php echo U('admin/usergroup/index');?>">用户组</a>
                            </li>
                            <?php } ?>
                            <?php if($auth->check( 'admin/purview/index', session('uid') )){ ?>
                            <li>
                                <a class="J_menuItem" href="<?php echo U('admin/purview/index');?>">权限菜单</a>
                            </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php } ?>

                    <?php if($auth->check( 'admin/news', session('uid') )){ ?>
                    <li>
                        <a href="#">
                            <i class="fa fa-dashboard"></i>
                            <span class="nav-label">文章模块管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <?php if($auth->check( 'admin/newstype', session('uid') )){ ?>
                            <li>
                                <a class="J_menuItem" href="<?php echo U('admin/newstype/index');?>">栏目管理</a>
                            </li>
                            <?php } ?>
                            <?php if($auth->check( 'admin/newsarticle', session('uid') )){ ?>
                            <li>
                                <a class="J_menuItem" href="<?php echo U('admin/newsarticle/index');?>">文章管理</a>
                            </li>
                            <?php } ?>
                            <?php if($auth->check( 'admin/newstags', session('uid') )){ ?>
                            <li>
                                <a class="J_menuItem" href="<?php echo U('admin/newstags/index');?>">Tags标签管理</a>
                            </li>
                            <?php } ?>
                            <?php if($auth->check( 'admin/newsarticle/recycle', session('uid') )){ ?>
                            <li>
                                <a class="J_menuItem" href="<?php echo U('admin/newsarticle/recycle');?>">文章回收站</a>
                            </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php } ?>

                    <?php if($auth->check( 'admin/shop', session('uid') )){ ?>
                    <li>
                        <a href="#">
                            <i class="fa fa-dashboard"></i>
                            <span class="nav-label">商城模块管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <?php if($auth->check( 'admin/shoptype', session('uid') )){ ?>
                            <li>
                                <a class="J_menuItem" href="<?php echo U('admin/shoptype/index');?>">栏目管理</a>
                            </li>
                            <?php } ?>
                            <?php if($auth->check( 'admin/shopproduct', session('uid') )){ ?>
                            <li>
                                <a class="J_menuItem" href="<?php echo U('admin/shopproduct/index');?>">产品管理</a>
                            </li>
                            <?php } ?>
                            <?php if($auth->check( 'admin/shoporder', session('uid') )){ ?>
                            <li>
                                <a class="J_menuItem" href="<?php echo U('admin/shoporder/index');?>">预约管理</a>
                            </li>
                            <?php } ?>
                            <?php if($auth->check( 'admin/shoporder/cancel_index', session('uid') )){ ?>
                            <li>
                                <a class="J_menuItem" href="<?php echo U('admin/shoporder/cancel_index');?>">已取消预约管理</a>
                            </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php } ?>

                    <?php if($auth->check( 'admin/shopmember', session('uid') )){ ?>
                    <li>
                        <a href="#">
                            <i class="fa fa-dashboard"></i>
                            <span class="nav-label">会员模块管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <?php if($auth->check( 'admin/shopmember', session('uid') )){ ?>
                            <li>
                                <a class="J_menuItem" href="<?php echo U('admin/shopmember/index');?>">会员管理</a>
                            </li>
                            <?php } ?>
                            <?php if($auth->check( 'admin/shoplevel', session('uid') )){ ?>
                            <li>
                                <a class="J_menuItem" href="<?php echo U('admin/shoplevel/index');?>">会员等级管理</a>
                            </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php } ?>

                    <?php if($auth->check( 'admin/ads', session('uid') )){ ?>
                    <li>
                        <a class="J_menuItem" href="<?php echo U('admin/ads/index');?>">
                            <i class="fa fa-columns"></i>
                            <span class="nav-label">banner管理</span>
                        </a>
                    </li>
                    <?php } ?>

                    <?php if($auth->check( 'admin/feedback', session('uid') )){ ?>
                    <li>
                        <a class="J_menuItem" href="<?php echo U('admin/feedback/index');?>">
                            <i class="fa fa-home"></i>
                            <span class="nav-label">留言管理</span>
                        </a>
                    </li>
                    <?php } ?>

                    <?php if($auth->check( 'admin/reply', session('uid') )){ ?>
                    <li>
                        <a class="J_menuItem" href="<?php echo U('admin/reply/index');?>">
                            <i class="fa fa-home"></i>
                            <span class="nav-label">自动回复</span>
                        </a>
                    </li>
                    <?php } ?>

                    <?php if($auth->check( 'admin/ask', session('uid') )){ ?>
                    <li>
                        <a class="J_menuItem" href="<?php echo U('admin/ask/index');?>">
                            <i class="fa fa-home"></i>
                            <span class="nav-label">反馈问题管理</span>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </nav>
        <!--左侧导航结束-->
        <!--右侧部分开始-->
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header"><a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                        
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li class="dropdown hidden-xs">
                            <a class="right-sidebar-toggle" aria-expanded="false">
                                <i class="fa fa-tasks"></i> 主题
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="row content-tabs">
                <!--<button class="roll-nav roll-left J_tabLeft"><i class="fa fa-backward"></i>
                </button>
                <nav class="page-tabs J_menuTabs">
                    <div class="page-tabs-content">
                        <a href="javascript:;" class="active J_menuTab" data-id="index_v1.html">首页</a>
                    </div>
                </nav>
                <button class="roll-nav roll-right J_tabRight"><i class="fa fa-forward"></i>
                </button>
                <div class="btn-group roll-nav roll-right">
                    <button class="dropdown J_tabClose" data-toggle="dropdown">关闭操作<span class="caret"></span>

                    </button>
                    <ul role="menu" class="dropdown-menu dropdown-menu-right">
                        <li class="J_tabShowActive"><a>定位当前选项卡</a>
                        </li>
                        <li class="divider"></li>
                        <li class="J_tabCloseAll"><a>关闭全部选项卡</a>
                        </li>
                        <li class="J_tabCloseOther"><a>关闭其他选项卡</a>
                        </li>
                    </ul>
                </div>-->
                <a href="/Admin/Login/logout" class="roll-nav roll-right J_tabExit"><i class="fa fa fa-sign-out"></i> 退出</a>
            </div>
            <div class="row J_mainContent" id="content-main">
                <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="<?php echo U('user/index');?>" frameborder="0" data-id="index_v1.html" seamless></iframe>
            </div>
            
        </div>
        <!--右侧部分结束-->
        <!--右侧边栏开始-->
        <div id="right-sidebar">
            <div class="sidebar-container">

                <ul class="nav nav-tabs navs-3">

                    <li class="active">
                        <a data-toggle="tab" href="#tab-1">
                            <i class="fa fa-gear"></i> 主题
                        </a>
                    </li>                    
                </ul>

                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                        <div class="sidebar-title">
                            <h3> <i class="fa fa-comments-o"></i> 主题设置</h3>
                            <small><i class="fa fa-tim"></i> 你可以从这里选择和预览主题的布局和样式，这些设置会被保存在本地，下次打开的时候会直接应用这些设置。</small>
                        </div>
                        <div class="skin-setttings">
                            <div class="title">主题设置</div>
                            <div class="setings-item">
                                <span>收起左侧菜单</span>
                                <div class="switch">
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="collapsemenu">
                                        <label class="onoffswitch-label" for="collapsemenu">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="setings-item">
                                <span>固定顶部</span>

                                <div class="switch">
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="fixednavbar" class="onoffswitch-checkbox" id="fixednavbar">
                                        <label class="onoffswitch-label" for="fixednavbar">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="setings-item">
                                <span>
                        固定宽度
                    </span>

                                <div class="switch">
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="boxedlayout" class="onoffswitch-checkbox" id="boxedlayout">
                                        <label class="onoffswitch-label" for="boxedlayout">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="title">皮肤选择</div>
                            <div class="setings-item default-skin nb">
                                <span class="skin-name ">
                         <a href="#" class="s-skin-0">
                             默认皮肤
                         </a>
                    </span>
                            </div>
                            <div class="setings-item blue-skin nb">
                                <span class="skin-name ">
                        <a href="#" class="s-skin-1">
                            蓝色主题
                        </a>
                    </span>
                            </div>
                            <div class="setings-item yellow-skin nb">
                                <span class="skin-name ">
                        <a href="#" class="s-skin-3">
                            黄色/紫色主题
                        </a>
                    </span>
                            </div>
                        </div>
                    </div>    
                    
                </div>

            </div>
        </div>
        <!--右侧边栏结束-->
       
    </div>
    <script src="/Public/admin/js/jquery.min.js?v=2.1.4"></script>
    <script src="/Public/admin/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="/Public/admin/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/Public/admin/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="/Public/admin/js/plugins/layer/layer.min.js"></script>
    <script src="/Public/admin/js/hplus.min.js?v=4.1.0"></script>

    <script type="text/javascript" src="/Public/admin/js/contabs.min.js"></script>
    <script src="/Public/admin/js/plugins/pace/pace.min.js"></script>

    </body>
</html>