<?php
namespace app\api\controller;
use think\Controller;
class Citys extends Controller{
    protected $obj = null;
    public function _initialize()
    {
        $this->obj = model('Citys');
    }

    public function getCitysByPid(){
        $pid = input('post.parent_id',0,'intval');
        $order = ['listorder'=>'desc'];
        $citys = $this->obj->where(['parent_id'=>$pid])->field(['name','id'])->order($order)->select();
        if(empty($citys)){
            return $this->result([],-1);
        }
        return $this->result($citys,1);
    }
}