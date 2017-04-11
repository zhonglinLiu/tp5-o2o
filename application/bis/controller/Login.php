<?php
namespace app\bis\controller;
use think\Controller;
use think\Session;

class Login extends Controller
{
    public function index(){
        if(request()->isPost()){
            $post = input('post.');
            $validate = validate('BisAccount');
            if(!$validate->scene('login')->check($post)){
                $this->error('用户或密码不能为空');
            }
            $rel = model('BisAccount')->get(['username'=>$post['username']]);
            if(empty($rel)){
                $this->error('用户不存在或');
            }
            if($rel->status!=1){
                $this->error('该用户正在审核中');
            }

            if($rel['password'] != md5($post['password'].$rel['code'])){
                $this->error('密码错误');
            }
            session('user',$rel,'bis');
            $this->success('登录成功','index/index');
        }
        $user = Session::get('user','bis');
        if(!empty($user)){
            $this->redirect(url('index/index'));
        }

        return $this->fetch();
    }


}