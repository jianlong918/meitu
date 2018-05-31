<?php
return array(
    //'配置项'=>'配置值'
    //数据库配置信息
    'DB_TYPE'   => 'mysql', // 数据库类型
     'DB_HOST'   => '192.168.1.236', // 服务器地址
     'DB_NAME'   => 'meinv_data', // 数据库名
     'DB_USER'   => 'jishu', // 用户名
     'DB_PWD'    => '123456', // 密码
//     'DB_HOST'   => 'localhost', // 服务器地址
//     'DB_NAME'   => 'jkcms_data', // 数据库名
//     'DB_USER'   => 'root', // 用户名
//     'DB_PWD'    => 'root',
    'DB_PORT'   => 3306, // 端口
    'DB_PREFIX' => 'yu_', // 数据库表前缀
    'DB_CHARSET'=> 'utf8', // 字符集
    'DB_DEBUG'  =>  TRUE, // 数据库调试模式 开启后可以记录SQL日志 3.2.3新增

    'SHOW_PAGE_TRACE' =>true,
    'DB_FIELDS_CACHE'=>false,
    'URL_MODEL'=>2,
    'LOAD_EXT_CONFIG' => 'sysconfig',

//    'LOG_RECORD' => true, // 开启日志记录
//    'LOG_LEVEL'  =>'EMERG,ALERT,CRIT,ERR', // 只记录EMERG ALERT CRIT ERR 错误
    'DEFAULT_MODULE' => 'Home', //默认版块

    'TOKEN_ON'      =>    true,  // 是否开启令牌验证 默认关闭
    'TOKEN_NAME'    =>    '__hash__',    // 令牌验证的表单隐藏字段名称，默认为__hash__
    'TOKEN_TYPE'    =>    'md5',  //令牌哈希验证规则 默认为MD5
    'TOKEN_RESET'   =>    true,  //令牌验证出错后是否重置令牌 默认为true

);