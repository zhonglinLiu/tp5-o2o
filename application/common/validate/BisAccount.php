<?php
namespace app\common\validate;
use think\Validate;
class BisAccount extends Validate{
    protected $rule = [
        ['username','require','用户名不能为空'],
        ['password','require','密码不能为空'],
        ['repass','require|confirm:password','确认密码不能为空|确认密码与密码不一致'],
    ];
    protected $scene = [
        'login'=>['username','password'],
        'add'=>['username','password','repass'],
    ];
}