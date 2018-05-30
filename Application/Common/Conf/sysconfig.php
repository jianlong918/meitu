<?php
return array(
    //'配置项'=>'配置值'
   'flag'=>array(
     'a'=>'特荐',
     'c'=>'推荐',
     'h'=>'头条',
     'p'=>'图片',
   ),
    'sortup'=>array(
      '7'=>'置顶一周',
      '30'=>'置顶一个月',
      '90'=>'置顶三个月',
      '180'=>'置顶半年',
      '360'=>'置顶一年',
    ),
    'click_default'=>array(
        '1'=>50,
        '2'=>200,
    ),

    'description_max'=>'250',
    'soft_lang'=>'utf-8',
    /*预约天数*/
    'book_day'=>'20',
    /*订单状态*/
    'order_status'=>array(
      '1'=>'处理中',
      '2'=>'待入住',
      '3'=>'已完成',
      '6'=>'已取消',
    ),
    /*pay_log类型*/
    'process_type'=>array(
      '1'=>'会员充积分',
      '11'=>'会员减积分',
      '12'=>'积分清零',
      '2'=>'完成预约扣积分',
      '3'=>'会员改变等级积分添加',
      '4'=>'会员取消订单积分恢复',
    ),

    /*系统消息*/
    'message_type'=>array(
        '1'=>'系统消息',
        '2'=>'客服消息',
        '3'=>'积分变动'
    ),
    /*系统消息*/
    'message'=>array(
        '1'=>array(
             '1'=>'您有一条新消息',
        ),
        '2'=>array(
            '1'=>'系统已收到您的订单预约',
            '2'=>'您的预约已处理，等待您的入住',
            '3'=>'您的订单已完成，感谢您的光临',
            '4'=>'您的订单已取消',
        ),
        '3'=>array(
            '1'=>'您的积分已变动，详见积分明细'
        )
    ),
);