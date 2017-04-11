<?php
namespace app\admin\controller;
use think\Controller;
class BisLocation extends Base {
    public function index(){
        $stores = model('BisLocation')->where(['status'=>1])->paginate();
        foreach ($stores as $k => $v){
            $stores[$k]['bis_name'] = model('Bis')->where(['id'=>$v['bis_id']])->find()['name'];
        }
        return $this->fetch('',['stores'=>$stores]);
    }
    public function apply(){
        $stores = model('BisLocation')->where(['status'=>0])->paginate();
        foreach ($stores as $k => $v){
            $stores[$k]['bis_name'] = model('Bis')->where(['id'=>$v['bis_id']])->find()['name'];
        }
        return $this->fetch('',['stores'=>$stores]);
    }
    public function detail(){
        $id = input('get.id');
        if(empty($id)){
            $this->error('id非法');
        }
        $store = model('BisLocation')->where(['id'=>intval($id)])->find();
        $city_path = explode(',',$store['city_path']);
        if(count($city_path)>1){
            $store['city_info'] = model('Citys')->field(['name','id'])->where(['id'=>$city_path[1]])->find();
        }else{
            $store['city_info'] = '';
        }
        $store['category_name'] = model('Category')->field(['name','id'])->where(['id'=>$store['category_id']])->find();
        $citys = model('Citys')->getNormalTopCitys(0);
        $cates = model('Category')->getNormalTopCategory(0);

        return $this->fetch('',['citys'=>$citys,'categorys'=>$cates,'store'=>$store]);
    }
    public function dellist(){
        $stores = model('BisLocation')->where(['status'=>-1])->paginate();
        foreach ($stores as $k => $v){
            $stores[$k]['bis_name'] = model('Bis')->where(['id'=>$v['bis_id']])->find()['name'];
        }
        return $this->fetch('index',['stores'=>$stores]);
    }


}