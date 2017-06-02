<?php 
namespace app\common\validate;
use think\Validate;
use app\common\exception\BaseException;
class BaseValidate extends Validate{
	public function goCheck(){
		$data = input('param.');
		if(!$this->check($data)){
			$error = $this->getError();
			throw new BaseException($error,400);
		}
	}

	protected function checkVerifyCode($value,$rule='',$msg=''){
		if(!captcha_check($value)){
			return false;
		}
		return true;
	}
} 