<?php
namespace app\common\validate;
use think\Validate;
class BisLocation extends Validate{
    protected $rule = [
        ['name','require|max:25','名称不能为空|名称长度不能大于25'],
        ['city_id','number|min:1','请选择城市'],
        ['logo','require','请上传公司图片'],
        ['bank_info','require','请填写银行账号'],
        ['tel','require','请填写公司电话'],
        ['contact','require','请填写联系人'],
        ['category_id','require','所属分类不能为空'],
        ['address','require','地址不能为空'],
        ['content','require','商户描述不能为空'],
        ['status','number|in:-1,0,1,2'],
        ['id','number']
    ];

    protected $scene = [
        'add'=>['name','city_id','logo','bank_info','tel','contact','category_id','address','content'],
    ];

}