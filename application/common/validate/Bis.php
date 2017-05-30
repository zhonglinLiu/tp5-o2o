<?php
namespace app\common\validate;
use think\Validate;
class Bis extends Validate{
    protected $rule = [
        ['name','require|max:25','名称不能为空|名称长度不能大于25'],
        ['city_id','number|min:1','请选择城市'],
        ['se_city_id','number|min:1','请选择城市'],
        ['logo','require','请上传公司图片'],
        ['licence_logo','require','请上传营业执照'],
        ['bank_info','require','请填写银行账号'],
        ['bank_name','require','请填写银行名称'],
        ['bank_user','require','请填写银行开户人'],
        ['faren','require','请填上公司法人'],
        ['faren_tel','require','请填写法人电话'],
        ['email','require|email','请正确填写email'],
        ['tel','require','请填写公司电话'],
        ['contact','require','请填写联系人'],
        ['category_id','require','所属分类不能为空'],
        ['address','require','地址不能为空'],
        ['username','require|unique:BisAccount','用户名不能为空|该用户名已被注册'],
        ['password','require','密码不能为空'],
        ['description','require','商户描述不能为空'],
        ['status','number|in:-1,0,1,2'],
        ['id','require','id不能为空']
    ];
    protected $scene =[
        'add'=>['name','city_id','logo','licence_logo','bank_info','bank_name','bank_user','faren','faren_tel',
            'email','tel','category_id','address','username','password','contact'
        ],
        'status'=>['id','status'],
    ];
}