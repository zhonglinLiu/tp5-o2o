<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
/*
 * 显示状态
 */
function status($status){
    if($status==1){
        return '<span class="label label-success radius" >正常</span>';
    }else if($status==0){
        return '<span class="label label-warning radius">待审</span>';
    }else if($status==2){
        return '<span class="label label-warning radius">停用</span>';
    }else{
        return '<span class="label label-danger radius">删除</span>';
    }
}

function pay_status($status){
    if($status==0){
        return '<span class="label label-warning radius" >待支付</span>';
    }
    if($status==1){
        return '<span class="label label-info radius" >支付成功</span>';
    }
    if($status==2){
        return '<span class="label label-danger radius" >支付失败</span>';
    }
    if($status==3){
        return '<span class="label label-info radius" >已发货</span>';
    }
    if($status==4){
        return '<span class="label label-success radius" >已收货</span>';
    }
}


function doCurl($url,$type=0){
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_HEADER,0);
    if($type==0){
        curl_setopt($ch,CURLOPT_POST,0);
    }else{
        curl_setopt($ch,CURLOPT_POST,1);
    }
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

/*
 * 通用分页样式
 */
function renderPagination($pagination){
    if(empty($pagination)){
        return '';
    }
    $param = request()->param();
    return '<div class="cl pd-5 bg-1 bk-gray mt-20 o2o-pager">'.$pagination->appends($param)->render().'</div>';
}
/*
 * 首页通用店数
 */
function getCommonUseStores($ids){
    if(empty($ids)){
        return '';
    }
    if(preg_match('/,/',$ids)){
        return count(explode(',',$ids));
    }
    return 1;
}

/*
数组转对象
 */
function array_to_object($arr) {
    if (gettype($arr) != 'array') {
        return;
    }
    foreach ($arr as $k => $v) {
        if (gettype($v) == 'array' || getType($v) == 'object') {
            $arr[$k] = (object)array_to_object($v);
        }
    }
 
    return (object)$arr;
}

