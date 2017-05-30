<?php
namespace app\admin\validate;
use think\Validate;
class Admin extends Validate{
    protected $rule = [
        ['username','require','用户名不能为空'],
        ['email','require','邮箱不能为空'],
        ['password','require','密码不能为空'],
        ['repass','require|confirm:password','确认密码不能为空|密码与确认密码不一致'],
    ];
    protected $scene = [
        'login'=>['username','password'],
        'add'=>['username','password','repass','email'],
        'edit'=>['username','password','repass','email'],
        'changepass'=>['password','repass'],
    ];
}