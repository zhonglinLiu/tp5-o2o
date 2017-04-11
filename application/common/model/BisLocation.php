<?php
namespace app\common\model;
use think\Model;
class BisLocation extends Base{
    public function getLocationByid($id){
        $data = [
            'id'=>['in',explode(',',$id)],
            'status'=>1
        ];
        $order = ['listorder'=>'desc'];
        return $this->where($data)->order($order)->find();
    }
    public function getLocationByBisid($id){
        $data = [
            'id'=>$id,
            'status'=>1,
        ];
        $order = ['listorder'=>'desc'];
        return $this->where($data)->order($order)->select();
    }
}