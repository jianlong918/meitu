<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no;" name="viewport">
    <title></title>
    <link rel="stylesheet" href="/Public/flyres/layui/css/layui.css">
    <link rel="stylesheet" href="/Public/flyres/css/global.css">
</head>
<body class="fly-full">
<div class="fly-header layui-bg-black">
    <div class="layui-container">
        <a class="fly-logo" href="/">
            <img src="/Public/flyres/images/logo.png" alt="layui">
        </a>
        <ul class="layui-nav fly-nav layui-hide-xs">
            <li class="layui-nav-item">
                <a href="/">交流</a>
            </li>
            <li class="layui-nav-item layui-this">
                <a href="">案例</a>
            </li>
            <li class="layui-nav-item">
                <a href="http://www.layui.com/" target="_blank">框架</a>
            </li>
        </ul>

        <ul class="layui-nav fly-nav-user">

            <!-- 未登入的状态 -->
            <li class="layui-nav-item">
                <a class="iconfont icon-touxiang layui-hide-xs" href="../user/login.html"></a>
            </li>
            <li class="layui-nav-item">
                <a href="../user/login.html">登入</a>
            </li>
            <li class="layui-nav-item">
                <a href="../user/reg.html">注册</a>
            </li>
            <li class="layui-nav-item layui-hide-xs">
                <a href="" onclick="layer.msg('正在通过QQ登入', {icon:16, shade: 0.1, time:0})" title="QQ登入" class="iconfont icon-qq"></a>
            </li>
            <li class="layui-nav-item layui-hide-xs">
                <a href="" onclick="layer.msg('正在通过微博登入', {icon:16, shade: 0.1, time:0})" title="微博登入" class="iconfont icon-weibo"></a>
            </li>

            <!-- 登入后的状态 -->
            <!--
            <li class="layui-nav-item">
              <a class="fly-nav-avatar" href="javascript:;">
                <cite class="layui-hide-xs">贤心</cite>
                <i class="iconfont icon-renzheng layui-hide-xs" title="认证信息：layui 作者"></i>
                <i class="layui-badge fly-badge-vip layui-hide-xs">VIP3</i>
                <img src="https://tva1.sinaimg.cn/crop.0.0.118.118.180/5db11ff4gw1e77d3nqrv8j203b03cweg.jpg">
              </a>
              <dl class="layui-nav-child">
                <dd><a href="../user/set.html"><i class="layui-icon">&#xe620;</i>基本设置</a></dd>
                <dd><a href="../user/message.html"><i class="iconfont icon-tongzhi" style="top: 4px;"></i>我的消息</a></dd>
                <dd><a href="../user/home.html"><i class="layui-icon" style="margin-left: 2px; font-size: 22px;">&#xe68e;</i>我的主页</a></dd>
                <hr style="margin: 5px 0;">
                <dd><a href="" style="text-align: center;">退出</a></dd>
              </dl>
            </li>
            -->
        </ul>
    </div>
</div>
<div class="fly-case-header">
    <p class="fly-case-year">2017</p>
    <a href="/case/{{ year }}/">
        <img class="fly-case-banner" src="/Public/flyres/images/case.png" alt="发现 Layui 年度最佳案例">
    </a>
    <div class="fly-case-btn">
        <a href="javascript:;" class="layui-btn layui-btn-big fly-case-active" data-type="push">提交案例</a>
        <a href="" class="layui-btn layui-btn-primary layui-btn-big">我的案例</a>

        <a href="http://fly.layui.com/jie/11996/" target="_blank" style="padding: 0 15px; text-decoration: underline">案例要求</a>
    </div>
</div>

<div class="fly-main" style="overflow: hidden;">

    <div class="fly-tab-border fly-case-tab">
    <span>
      <a href="" class="tab-this">2017年度</a>
      <a href="">2016年度</a>
    </span>
    </div>
    <div class="layui-tab layui-tab-brief">
        <ul class="layui-tab-title">
            <li class="layui-this"><a href="">按提交时间</a></li>
            <li><a href="">按点赞排行</a></li>
        </ul>
    </div>

    <ul class="fly-case-list">
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li data-id="">
            <a class="fly-case-img" href="<?php echo U('news/view',array('id'=>$vo['id']));?>" target="_blank" >
                <img src="/Public/flyres/images/fly.jpg" alt="<?php echo ($vo["title"]); ?>">
            </a>
            <h2><a href="<?php echo U('news/view',array('id'=>$vo['id']));?>" target="_blank"><?php echo (mb_substr($vo["title"],0,22,'UTF-8')); ?></a></h2>
            <!--<p class="fly-case-desc"><?php echo ($vo["description"]); ?></p>-->
            <div class="fly-case-info">
                <p class="layui-elip" style="font-size: 12px;"><span style="color: #666;">贤心</span> 2017-11-30</p>
                <p>获得<a class="fly-case-nums fly-case-active" href="javascript:;" data-type="showPraise" style=" padding:0 5px; color: #01AAED;">666</a>个赞</p>
                <button class="layui-btn layui-btn-primary fly-case-active" data-type="praise">点赞</button>
                <!-- <button class="layui-btn  fly-case-active" data-type="praise">已赞</button> -->
            </div>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>

    <!-- <blockquote class="layui-elem-quote layui-quote-nm">暂无数据</blockquote> -->

    <div style="text-align: center;">
        <div class="laypage-main">

            <?php echo ($page); ?>
        </div>
    </div>

</div>
<div class="fly-footer">
    <p><a href="http://fly.layui.com/" target="_blank">Fly社区</a> 2017 &copy; <a href="http://www.layui.com/" target="_blank">layui.com 出品</a></p>
    <p>
        <a href="http://fly.layui.com/jie/3147/" target="_blank">付费计划</a>
        <a href="http://www.layui.com/template/fly/" target="_blank">获取Fly社区模版</a>
        <a href="http://fly.layui.com/jie/2461/" target="_blank">微信公众号</a>
    </p>
</div>
</body>
</html>