<?php
/**
 * @param $config 配置文件字段
 * @param $key
 * @param string $field 用于二维数组
 * @return mixed
 */
    function getConfig($config,$key,$field=''){
        $data=C($config);
        if(empty($field)){
            $value=$data[$key];
        }else{
            $value=$data[$key][$field];
        }
        return $value;
    }
    function get_district_name($id){
        $areaOb=M('district');
        $re=$areaOb->field('name')->where("id=%d",$id)->find();
        return $re['name'];
    }

/**  判断是否为否用户组用户
 * @param $admin_id 用户组id
 * @param $field 字段如id，wid
 * @return array
 */
    function is_admin($admin_id,$field){
        $condition=array();
        $userInfo=session('uinfo');
        $usergroup=explode(',',$userInfo['usergroup']);
        if(!in_array($admin_id,$usergroup)){
            $condition[$field]=session('uid');
        }
        return $condition;
    }

    /*获取某一用户组的用户 二维数组*/
    function getUsers($usergroup_id){
        $usersOb=D('AuthGroupAccess');
        $user_ids=$usersOb->getUidsByGroupId($usergroup_id);
        $user_group=array();
        if(!empty($user_ids)){
            foreach($user_ids as $key=>$val){
                $user_group[$key]['uid']=$val;
                $user=M('user')->find($val);
                $user_group[$key]['name']=$user['realname'];
            }
            $return=$user_group;
        }else{
            $return=null;
        }
        return $return;
    }

/**无限极菜单下拉框
 * @param $data
 * @param $pId
 * @param int $deep 层级
 * @param $select 为下拉菜单选中项id
 * @return string
 */
function LimitlessListTypes($data,$pId,$deep=1,$select){
    $list='';
    foreach($data as $k=>$v){
        if($v['pid']==$pId){
            $selected="";
            if($select==$v['id']){
                $selected="selected";
            }
            $v['typename']=str_repeat('&nbsp;&nbsp;', $deep)."|--".$v['typename'];
            $list.=<<<EOF
       <option value="{$v['id']}" {$selected}>{$v['typename']}</option>
EOF;

            $list.=LimitlessListTypes($data,$v['id'],++$deep,$select);
            --$deep;
        }
    }
    return $list;
}

/**
 *  增加天数
 *
 * @param     int  $ntime  当前时间
 * @param     int  $aday   增加天数
 * @return   datetime
 */
function AddDay($ntime, $aday){
    $dayst = 3600 * 24;
    $oktime = $ntime + ($aday * $dayst);
    return date("Y-m-d H:i:s",$oktime);
}

/** 某个字段的查询
 * @param  $table  表名
 * @param $field  字段名
 * @param $condition 数组 查询条件
 * @return mixed
 */
function getFieldShow($table,$field,$condition){
    return M($table)->where($condition)->getField($field);
}

/**
 *  HTML转换为文本
 *
 * @param    string  $str 需要转换的字符串
 * @return   string
 */
function Html2Text($str){
    $str = preg_replace("/<sty(.*)\\/style>|<scr(.*)\\/script>|<!--(.*)-->/isU","",$str);
    $alltext = "";
    $start = 1;
    for($i=0;$i<strlen($str);$i++)
    {
        if($start==0 && $str[$i]==">")
        {
            $start = 1;
        }
        else if($start==1)
        {
            if($str[$i]=="<")
            {
                $start = 0;
                $alltext .= " ";
            }
            else if(ord($str[$i])>31)
            {
                $alltext .= $str[$i];
            }
        }
    }
    $alltext = str_replace("　"," ",$alltext);
    $alltext = preg_replace("/&([^;&]*)(;|&)/","",$alltext);
    $alltext = preg_replace("/[ ]+/s"," ",$alltext);
    return $alltext;
}
/**
 *  中文截取2，单字节截取模式
 *
 * @access    public
 * @param     string  $str  需要截取的字符串
 * @param     int  $slen  截取的长度
 * @param     int  $startdd  开始标记处
 * @return    string
 */
function cn_substr($str, $slen, $startdd=0)
{
    $cfg_soft_lang=C('soft_lang');
    if($cfg_soft_lang=='utf-8')
    {
        return cn_substr_utf8($str, $slen, $startdd);
    }
    $restr = '';
    $c = '';
    $str_len = strlen($str);
    if($str_len < $startdd+1)
    {
        return '';
    }
    if($str_len < $startdd + $slen || $slen==0)
    {
        $slen = $str_len - $startdd;
    }
    $enddd = $startdd + $slen - 1;
    for($i=0;$i<$str_len;$i++)
    {
        if($startdd==0)
        {
            $restr .= $c;
        }
        else if($i > $startdd)
        {
            $restr .= $c;
        }

        if(ord($str[$i])>0x80)
        {
            if($str_len>$i+1)
            {
                $c = $str[$i].$str[$i+1];
            }
            $i++;
        }
        else
        {
            $c = $str[$i];
        }

        if($i >= $enddd)
        {
            if(strlen($restr)+strlen($c)>$slen)
            {
                break;
            }
            else
            {
                $restr .= $c;
                break;
            }
        }
    }
    return $restr;
}
/**
 *  utf-8中文截取，单字节截取模式
 *
 * @access    public
 * @param     string  $str  需要截取的字符串
 * @param     int  $slen  截取的长度
 * @param     int  $startdd  开始标记处
 * @return    string
 */
function cn_substr_utf8($str, $length, $start=0)
{
    if(strlen($str) < $start+1)
    {
        return '';
    }
    preg_match_all("/./su", $str, $ar);
    $str = '';
    $tstr = '';

    //为了兼容mysql4.1以下版本,与数据库varchar一致,这里使用按字节截取
    for($i=0; isset($ar[0][$i]); $i++)
    {
        if(strlen($tstr) < $start)
        {
            $tstr .= $ar[0][$i];
        }
        else
        {
            if(strlen($str) < $length + strlen($ar[0][$i]) )
            {
                $str .= $ar[0][$i];
            }
            else
            {
                break;
            }
        }
    }
    return $str;
}

//订单编号生成
function getOrderCode(){
    $orderId = date("YmdHis",time());
    for($i=0;$i<2;$i++){
        $orderId .= rand(0,9);
    }
    return $orderId;
}


//获取聊天页面时间样式
function getChatTime($timestamp){
    $ga = date("w",$timestamp);
    $week = "";
    switch( $ga ){
        case 1 : $week = "周一";break;
        case 2 : $week = "周二";break;
        case 3 : $week = "周三";break;
        case 4 : $week = "周四";break;
        case 5 : $week = "周五";break;
        case 6 : $week = "周六";break;
        case 0 : $week = "周日";break;
        default : $week = "";
    };
    $am = "";
    $h=date('G',$timestamp);
    if (0<$h || $h<=12) $am= '上午';
    if (24<=$h || $h>12) $am= '下午午';
    $time = date("H:i",$timestamp);
    return $week.$am.$time;
}

/*日期格式转换*/
function time_change($time){
    return str_replace("-","/",substr($time,0,10));
}

/*datetime格式时间转换成xx年xx月xx日*/
function time_style($time){
    $year=substr($time,0,4);
    $month=substr($time,5,2);
    $day=substr($time,8,2);
    return $year.'年'.$month.'月'.$day.'日';
}

/**
 * 发送系统消息
 */
function sendSysMessage($mid,$typeId,$messageId){
    if($mid==""||$typeId==""||$messageId==""){
        return false;
    }
    $data_message['mid']=$mid;
    $data_message['type']=$typeId;
    $data_message['content_id']=$messageId;
    $data_message['created_at']=date("Y-m-d H:i:s",time());
    $re_mes=M('message')->add($data_message);
    return $re_mes;
}

function pwdjiami($pwd){
    $salt = "yl";
    return md5($salt.$pwd);
}