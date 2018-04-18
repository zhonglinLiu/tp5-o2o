<?php
namespace app\index\controller;
use think\Controller;
use think\Session;

class User extends Controller{
	public function login(){
	    if(Session::get('user','o2o')){
	        $this->redirect('index/index');
        }
        if(request()->isPost()){
            $data = input('post.');
            $user = model('User')->where(['username'=>$data['username']])->find();
            if(empty($user)){
                $this->error('该用户不存在');
            }
            if($user['password']==md5($data['password'].$user['code'])){
                $data2 = [
                    'last_login_ip'=>request()->ip(),
                    'last_login_time'=>time(),
                ];
                model('User')->save($data2,['id'=>$user['id']]);
                session('user',$user,'o2o');
                $this->redirect('index/index');
            }else{
                $this->error('密码错误');
            }
        }

		return $this->fetch();
	}

	public function register(){
	    if(request()->isPost()){
            $data = input('post.');
            if(!captcha_check($data['verifyCode'])){
                $this->error('验证码错误');
            }
            $validate = validate('User');
            $data['status'] = 1;
            $data['code'] = mt_rand(100,10000);
            $data['password'] = md5($data['password'].$data['code']);
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }
            $rel = model('User')->allowField(true)->save($data);
            if($rel){
                $this->success('注册成功','user/login');
            }
            $this->error('注册失败');
        }


		return $this->fetch();
	}

    public function index(){
        $this->redirect('/');
    }

	public function logout(){
	    Session::delete('user','o2o');
	    $this->redirect('user/login');
    }
}