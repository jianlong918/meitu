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

      //  layer.open({type: 2});
        $(this).ajaxSubmit(options);
        return false; //为了不刷新页面,返回false，
    });
});
function showResponse(responseText, statusText, xhr, form){
    if(statusText=='success'){
      //  layer.closeAll('loading');
        msg_url(responseText.info,responseText.url);
    }
}
function msg_url(info,url,reload){
    layer.open({
        content: info
        ,skin: 'msg'
        ,time: 2
        ,end: function(index){
            if(url!=""&& typeof(url)!="undefined"){
                location.href = url;
                return false;
            }else if(reload==1){
                location.reload();
            }
        }
    });
}


obj = document.getElementById("isread");
if (obj){
    function Unread()
    {
        $(document).ready(function() {
            $.post("/Wehome/message/isread", '',
                function(data){
                    console.log(data.time); //  2pm
                    if(data.is_read==0){
                        $("#isread").show();
                    }else{
                        $("#isread").hide();
                    }
                }, "json");
        });
    }
    setInterval('Unread()',2000);
}
