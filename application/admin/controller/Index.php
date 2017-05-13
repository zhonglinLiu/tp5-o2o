<?php 
namespace app\admin\controller;
use think\controller\Bsse;
use think\Controller;
use think\Session;

class Index extends Base
{
    public function index()
    {
        $user = Session::get('admin','admin');
        return $this->fetch('',['user'=>$user]);
    }
     public function welcome()
    {

        return 'welcome to o2o';
    }
    public function image(){
        return \map::getImageByAddress('河南省驻马店市');
    }

}
