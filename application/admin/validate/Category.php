<?php
namespace app\admin\validate;
use think\Validate;
class Category extends Validate{
    protected $rule = [
        ['name','require|max:50','名称不能为空|长度不能大于10'],
        ['parent_id','number|min:0','状态必须是数字|状态范围不合法'],
        ['id','number'],
        ['status','number|in:-1,0,1'],
        ['listorder','number'],
    ];
    protected $scene = [
        'add'=>['name','parent_id','id'],
        'listorder'=>['listorder','id'],
        'status'=>['id','status'],
    ];
}
