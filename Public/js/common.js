jQuery(document).ready(function($){
    $('.ajaxform').submit(function()//提交表单
    {
        var options = {
            url:$(this).attr('action'), //提交给哪个执行
            type:'POST',
            dataType: 'json',
            success: showResponse //回调函数
        };

        if(typeof(check_1)=="function"){

            var rs = check_1();
            if(!rs){
                return false;
            }
        }

        layer.load();
        $(this).ajaxSubmit(options);
        return false; //为了不刷新页面,返回false，
    });
});
function showResponse(responseText, statusText, xhr, form){
    if(statusText=='success'){
        layer.closeAll('loading');
       // var arr = responseText;//u71d5u5b50这个是php中自动转换的
       // var dataObj = eval("("+arr+")");//这里要加上加好括号和双引号的原因我也不知道，就当是json语法，只能死记硬背了
       // msg_url(dataObj.info,dataObj.url);
        msg_url(responseText.info,responseText.url);
    }
}
function msg_url(info,url){
    layer.msg(info,{time:1000},function(){
        if(url!=""&& typeof(url)!="undefined"){
            location.href = url;
            return false;
        }
    });
}

function confirm_del(obj){
    msg = $(obj).attr('data-msg');
    url = $(obj).attr('data-url');
    id = $(obj).attr('data-id');
    layer.confirm(msg, {
        btn: ['确定','取消'], //按钮
    }, function(){
        $.post(url, { id:id },
            function(data){
                if(data.status==1){
                    msg_url(data.info);
                    window.setTimeout("location.reload()",1000);
                }else{
                    msg_url(data.info);
                }
            }, "json");
    }
    );
}
