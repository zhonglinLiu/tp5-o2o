<?php
namespace app\common\validate;
use think\Validate;
class User extends Validate{
    protected $rule = [
      ['username','require|unique:user','用户名不能为空|该用户名已被注册'],
        ['email','email','请正确填写email'],
        ['password','require','密码不能为空'],
        ['repass','require|confirm:password','请确认密码|密码与确认密码不一致'],
        ['mobile','require','请填写电话号'],
    ];
    protected $scene = [
        'add'=>['username','password','email'],
        'adminEdit'=>['username','repass'],
    ];
}