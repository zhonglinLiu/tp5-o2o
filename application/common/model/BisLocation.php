<?php
namespace app\common\model;
use think\Model;
class BisLocation extends Base{

    public function bis(){
        return $this->belongsTo('Bis','bis_id','id')->field(['id','name']);
    }
    public function category(){
        return $this->belongsTo('Category','category_id','id');
    }
    public function city(){
        return $this->belongsTo('Citys','city_id','id');
    }
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

    public function getMainLocationByBid($bid){
        $data = [
            'is_main'=>1,
            'bis_id'=>$bid
        ];
        return $this->where($data)->find();
    }

   
}