<?php
namespace app\admin\validate;
use think\Validate;
class Citys extends Validate{
    protected $rule = [
        ['name','require','城市名不能为空'],
        ['name','unique:citys','该城市已被添加'],
        ['parent_id','number|min:0','必须为数字|状态范围不合法'],
        ['status','number|in:-1,0,1','状态非法'],
        ['id','number'],
        ['listorder','number'],

    ];
    protected $scene = [
        'add'=>['parent_id','id','name'],
        'status'=>['status','id']
    ];
}