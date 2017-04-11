<?php
namespace app\api\controller;
use think\Controller;
use app\common\model\BisAccount as BisAccountModel;

class BisAccount extends Controller{
    public function checkname(){
        $username = input('post.username');
        if(empty($username)){
            return $this->result([],-1,'用户名不能为空');
        }
        $rel = BisAccountModel::get(['username'=>$username]);
        if($rel){
            return $this->result([],-1,'该用户已被注册');
        }
    }

    public function showposition(){
        $pos = input('post.position');
        if(empty($pos)){
            return $this->result([],-1,'地址不能为空');
        }
        $pos = \map::getCoorByAddress($pos);
        if(empty($pos) || $pos->status==1){
            return $this->result([],-1,'请填写合法地址');
        }elseif($pos->result->precise==0){
            return $this->result([],-1,'请填写详细地址');
        }
        \map::getImageByAddress($pos);
    }
    public function showmap(){
        $pos = input('get.position');
        return \map::getImageByAddress($pos);
    }
}