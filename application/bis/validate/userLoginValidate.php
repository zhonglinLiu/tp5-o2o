<?php 
namespace app\bis\validate;
use app\common\validate\LoginValidate;
use think\Session;
class userLoginValidate extends LoginValidate{
	protected $modelName = 'BisAccount';
	protected $rule = [
		'username'=>'require|checkUsername',
		'password'=>'require|checkPassword'
	];

	protected function setSession(){
		Session::set('user',$this->model,'bis');
	}
}