<?php
namespace app\admin\model;
use think\Model;
use think\Session;
use think\Request;
class Admin extends Model{
    protected $autoWriteTimestamp = true;
    protected $update = ['last_login_ip'];
    protected $insert = ['status'=>1];
    protected $type = [
    	'last_login_time'=>'timestamp:Y-m-d h:i',
    ];

    protected function setLastLoginIpAttr(){
        return request()->ip();
    }
    

    public function checkLogin(){
    	if(Session::get('admin','admin')){
    		return true;
    	}
    	return false;
    }

    public function add(){
        $data = input('post.');
        $validate = validate('Admin');
        if(!$validate->scene('add')->check($data)){
            return show($validate->getError(),-1);
        }
        $data['code'] = mt_rand(1000,9999);
        $data['password'] = md5($data['password'].$data['code']);
        if($this->allowField(true)->save($data)){
            return true;
        }
        return false;

    }

    public function changePass($data){
        $validate = validate('Admin');
        if(!$validate->scene('changepass')->check($data)){
            return show($this->getError(),-1);
        }
        $model = $this->get(intval($data['id']));
        $model->password = md5($data['password'].$model->code);
        $rel = $model->save();
        if(!$rel){
            return false;
        }
        return true;
    }

    
}