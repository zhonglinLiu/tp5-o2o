<?php
namespace app\common\model;
use think\Model;
class Area extends Base {
    protected $CitysModel = null;
    protected function initialize(){
        $this->CitysModel = model('Citys');
    }
    public function citys(){
        return $this->hasOne('citys');
    }
    public function getTopArea($pid){
        $data = [
            'parent_id'=>$pid,
            'status'=>['neq',-1],
        ];
        $order = ['listorder'=>'desc'];
        $res = $this->where($data)->order($order)->paginate(2);
        foreach ($res as $k => $v){
            $res[$k]['cityname'] = $this->CitysModel->where(['id'=>$v['city_id']])->field(['name'])->find()['name'];
        }
        return $res;
    }
    public function getNormalTopArea($pid){
        $data = [
            'parent_id'=>$pid,
            'status'=>['neq',-1],
        ];
        $order = ['listorder'=>'desc'];
        return $this->where($data)->order($order)->select();
    }
    public function getCityList(){
        $data = [
            'status'=>['neq',-1],
            'parent_id'=>0,
        ];
        $order = ['listorder'=>'desc'];
        $citys = $this->CitysModel->field(['id','name','parent_id'])->where($data)->order($order)->select();
        foreach ($citys as $k => $city){
            $data['parent_id'] = $city['id'];
            $child = $this->CitysModel->field(['id','name','parent_id'])->where($data)->order($order)->select();
            $citys[$k]['child'] = $child;
        }
        return $citys;
    }

    public function add($data){

    }
}