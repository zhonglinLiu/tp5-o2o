<?php
namespace app\admin\model;
use think\Model;
use think\Session;
use think\Request;
class Admin extends Model{
    protected $autoWriteTimestamp = true;
    protected $type = [
    	'last_login_time'=>'timestamp:Y-m-d h:i',
    ];

    public function login($data){
    	$vaildate = validate('Admin');
        if(!$vaildate->scene('login')->check($data)){
            return json(['code'=>-1,'data'=>$vaildate->getError()]);
        }
        $rel = $this->where(['username'=>$data['username']])->find();
        if(empty($rel)){
            return json(['code'=>-1,'data'=>'该用户不存在']);
        }
        if(!$rel->password == md5($data['password'].$rel->code)){
            return json(['code'=>-1,'data'=>'账号或密码错误']);
        }
        $rel->last_login_ip = Request::instance()->ip();
        $rel->save();
        Session::set('admin',$rel,'admin');
        return json(['code'=>1,'data'=>'登录成功']);
    }

    public function checkLogin(){
    	if(Session::get('admin','admin')){
    		return true;
    	}
    	return false;
    }
    
}