<?php 
namespace app\admin\controller;
use think\Controller;
use app\admin\controller\Base;
class User extends Base{
	public function index(){
		
		if(request()->isPost()){
			$sdata = [];
			$data = input('post.');
			if($data['register_start_time']!=''){
				$sdata['create_time'][] = ['gt',strtotime($data['register_start_time'])];
			}
			if($data['register_end_time']!=''){
				$sdata['create_time'][] = ['lt',strtotime($data['register_end_time'])];
			}
			if($data['start_time']!=''){
				$sdata['last_login_time'][] = ['gt',strtotime($data['start_time'])];
			}
			if($data['end_time']!=''){
				$sdata['last_login_time'][] = ['lt',strtotime($data['end_time'])];
			}
			if($data['name']!=''){
				$sdata['username']=['like','%'.$data['name'].'%'];
			}
			$sdata['status'] = 1;
			$user = model('User')->where($sdata)->paginate(2);
		}else{
			$user = model('User')->where(['status'=>['neq',-1]])->paginate(2);
		}
		return $this->fetch('index',['user'=>$user]);
	}
	public function detail(){
		return;
		$id = input('get.id');
		if(is_null($id)){
			$this->error('非法操作');
		}
		$user = model('User')->where(['status'=>1,'id'=>$id])->find();
		if(empty($user)){
			$this->error('操作失败');
		}
		return $this->fetch('',['user'=>$user]);
	}
}