<?php
namespace app\common\model;
use think\Model;
use think\Session;
class BisAccount extends Base {
	protected $auto = ['bis_id'];
	
	protected function setUsernameAttr($value){
		return htmlspecialchars($value);
	}
	protected function BisIdAttr(){
		return Session::get('user','bis')->bis_id;
	}
	public function addOrUpdate($data){
		$validate = validate('BisAccount');
		if(!$validate->scene('add')->check($data)){
			return show($this->getError(),-1);
		}
		if(isset($data['id']) && $data['id']!=''){
			$model = $this->get(intval($data['id']));
		}else{
			$model = $this;
		}
		$model->username = $data['username'];
		$model->code = mt_rand(1000,9999);
		$model->password = md5($data['password'].$model->code);
		if($model->save()){
			return true;
		}
		return false;

	}
}
/*9e7062e2a6ce5728be1990085cbbee9b
d86b894c3567b1e6301e3bfe76e1de2f*/