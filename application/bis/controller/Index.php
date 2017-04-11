<?php
namespace app\bis\controller;
use think\Controller;
use think\Session;

class Index extends Base
{
    public function index()
    {
        return $this->fetch();
    }
    public function logout(){
        Session::delete('user','bis');
        $this->redirect(url('login/index'));
    }

}
