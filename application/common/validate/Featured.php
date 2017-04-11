<?php
namespace app\common\validate;
use think\Validate;
class Featured extends Validate{
    protected $rule = [
        ['title','require','标题不能为空'],
        ['image','require','请上传图片'],
        ['url','require','请填写url'],
        ['description','require','请填写描述信息']
    ];
    protected $scene = [
        'add'=>['title','image','url','description']
    ];
}