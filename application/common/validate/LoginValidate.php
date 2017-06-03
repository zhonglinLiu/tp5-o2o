<?php 
namespace app\common\validate;
use think\Session;
class LoginValidate extends BaseValidate{
	protected $model = null;
	//用哪个模型区检验登录否
	protected $modelName = 'Admin';
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
		if($this->model->password == md5($value.$this->model->code)){
			$this->model->save();
			$this->setSession();
			return true;
		}
		return false;
	}

	protected function checkUsername($value,$rule='',$message = '', $field = ''){
		$this->model = model($this->modelName)->where(['username'=>$value])->find();
		if(empty($this->model)){
			return false;
		}
		return true;
	}

	protected function setSession(){
		Session::set('admin',$this->model,'admin');
	}
}