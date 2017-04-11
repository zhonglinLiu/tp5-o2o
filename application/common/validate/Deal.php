<?php
namespace app\common\validate;
use think\Validate;
class Deal extends Validate{
    protected $rule = [
        ['name','require','团购名称不能为空'],
        ['category_id','require','请填写所属分类'],
        ['location_ids','require','请选择参见获得门店'],
        ['image','require','请上传封面图'],
        ['description','require','请填写团购描述'],
        ['start_time','require','团购开始时间不能为空'],
        ['end_time','require','请选择开始时间'],
        ['origin_price','require|number|min:0.01','请填写原价|价格非法'],
        ['current_price','require|number|min:0.01','请填写售价|价格非法'],
        ['city_id','require','请选择城市'],
        ['total_count','require|integer','库存不能为空|库存填写非法'],
        ['coupons_begin_time','require','请填写团购开始时间'],
        ['coupons_end_time','require','请填写团购结束时间'],
        ['notes','require']
    ];
    protected $scene = [
        'add'=>['name','category_id','location_ids','image','description','start_time','end_time','origin_price',
        'current_price','city_id','total_count','coupons_begin_time','coupons_end_time'
        ],
    ];
}