<?php
namespace app\admin\validate;
use think\Validate;
class Area extends Validate{
    protected $rule = [
        ['id','number'],
        ['parent_id','number|min:0','参数非法|parent_id不能小于1'],
        ['city_id','number','城市id非法'],
        ['name','unique:area','该商圈已被添加'],
        ['status','number|in:-1,0,1','状态非法|状态必须是-1,0,1'],
        ['listorder','number'],
    ];
    protected $scene = [
        'add'=>['city_id','name','parent_id'],
        'status'=>['stauts','id'],
        'listorder'=>['listorder','id'],
    ];

}