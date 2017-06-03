<?php
namespace app\bis\controller;
use think\Controller;
use think\Session;
use app\bis\validate\userLoginValidate;
class Login extends Controller
{
    public function index(){
        if(Session::get('user','bis')){
            $this->redirect(url('index/index'));
        }
        if(request()->isPost()){
           
            try {
                (new userLoginValidate)->goCheck();
            } catch (\Exception $e) {
                return $this->error($e->getMessage());
            }
            
            $this->success('登录成功','index/index');
        }
        $user = Session::get('user','bis');
        if(!empty($user)){
            $this->redirect(url('index/index'));
        }

        return $this->fetch();
    }


}