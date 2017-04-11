<?php
namespace app\common\model;
use think\Model;
class Citys extends Base{
    public function getNormalTopCitys($parent_id){
        $data = [
            'parent_id' =>$parent_id,
            'status'=>['neq',-1]
        ];
        $order = ['listorder'=>'desc'];
        return $this->where($data)->order($order)->select();
    }
    public function getTopCitys($parent_id){
        $data = [
            'parent_id' => $parent_id,
            'status'=>['neq',-1],
        ];
        $order = ['listorder'=>'desc'];
        $rel = $this->where($data)->order($order)->paginate(2);
        return $rel;
    }
    public function add($data){
        return $this->save($data);
    }
}