<?php 
namespace app\admin\validate;
use app\common\validate\BaseValidate;
use think\Session;
class LoginValidate extends BaseValidate{
	protected $admin = null;
	protected $rule = [
		'verifyCode'=>'require|checkVerifyCode',
		'username'=>'require|checkUsername',
		'password'=>'require|checkPassword'
	];

	protected $message = [
		'username.require'=>'用户名不能为空',
		'username.checkUsername'=>'用户名不存在',
		'password.require'=>'密码不存在',
		'password.checkPassword'=>'密码错误',
		'verifyCode.require'=>'验证码错误',
		'verifyCode.checkVerifyCode'=>'验证码错误'
	];

	protected function checkPassword($value,$rule='',$message = '', $field = ''){
		if($this->admin->password == md5($value.$this->admin->code)){
			$this->admin->save();
			Session::set('admin',$this->admin,'admin');
			return true;
		}
		return false;
	}

	protected function checkUsername($value,$rule='',$message = '', $field = ''){
		$this->admin = model('Admin')->where(['username'=>$value])->find();
		if(empty($this->admin)){
			return false;
		}
		return true;
	}
}