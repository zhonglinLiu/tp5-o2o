<?php
namespace app\index\controller;
use app\index\controller\Base;
use think\Controller;
use think\Session;
use think\Debug;
class Index extends Base {
	public function index(){
        $goods  = model('Deal')->getGoodsByCategory();
		return $this->fetch('',['goods'=>$goods,'cateid'=>-1]);
	}

}