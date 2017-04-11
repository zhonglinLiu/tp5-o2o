<?php
namespace app\bis\controller;
use think\Controller;
use think\Session;

class Base extends Controller{
    public function _initialize()
    {
        $this->checkLogin();
    }
    public function checkLogin(){
        $user = Session::get('user','bis');
        
        if(empty($user)){
            $this->redirect('login/index');
        }else{
            return true;
        }
    }
}