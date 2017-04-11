<?php 
namespace app\bis\controller;
use think\Controller;
use app\bis\controller\Base;
use think\Session;
class Manager extends Base{
	public function index(){
		$mana = Session::get('user','bis');
		if($mana->is_main!=1){
			return '没有权限';
		}
		$user = model('BisAccount')->where(['status'=>['neq',-1],'bis_id'=>$mana->bis_id])->paginate();
		return $this->fetch('',['user'=>$user]);
	}

	public function add(){
		if(request()->isAjax()){
			$data = input('post.');
			$validate = validate('BisAccount');
			if(!$validate->scene('add')->check($data)){
				return $this->result($validate->getError(),-1);
			}
			if(isset($data['id']) && $data['id']!=''){
				$model = model('BisAccount')->where(['id'=>intval($data['id'])])->find();
			}else{
				$model = model('BisAccount');
				$model->bis_id = Session::get('user','bis')->bis_id;
			}
			$model->username = htmlspecialchars($data['username']);
			$model->code = mt_rand(1000,9999);
			$model->password = md5($data['password'].$model->code);
			if($model->save()){
				return $this->result('修改成功',1);
			}
			return $this->result('修改失败',-1);
		}else{
			$data = input('get.');
			if(isset($data['id']) && $data['id']!=''){
				$model = model('BisAccount')->where(['id'=>intval($data['id'])])->find();
				$flog = 1;
			}else{
				$flog = 0;
				$model = model('BisAccount');
			}
		}
		return $this->fetch('',['model'=>$model,'flog'=>$flog]);
	}
}