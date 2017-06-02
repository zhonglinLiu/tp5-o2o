<?php
namespace app\admin\model;
use think\Model;
use think\Session;
use think\Request;
class Admin extends Model{
    protected $autoWriteTimestamp = true;
    protected $update = ['last_login_ip'];
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
    
}