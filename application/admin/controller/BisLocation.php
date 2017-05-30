<?php
namespace app\admin\controller;
use think\Controller;
class BisLocation extends Base {


    public function index(){
        $stores = model('BisLocation')->with('bis')->where(['status'=>1])->paginate();
        
        return $this->fetch('',['stores'=>$stores]);
    }

    public function apply(){
        $stores = model('BisLocation')->with('bis')->where(['status'=>0])->paginate();
        return $this->fetch('',['stores'=>$stores]);
    }

    public function detail(){
        $id = input('get.id');
        if(empty($id)){
            $this->error('id非法');
        }
        $store = model('BisLocation')->with('category')->where(['id'=>intval($id)])->find();
        $se_city_id = model('Citys')->getSeCityByCityPath($store['city_path']);
        if($se_city_id){
            $store['city_info'] = model('Citys')->getCityById($se_city_id);
        }else{
            $store['city_info'] = '';
        }

        return $this->fetch('',['store'=>$store]);
    }

    /**
     * 删除的列表
     * @return [type] [description]
     */
    public function dellist(){
        $stores = model('BisLocation')->with('bis')->where(['status'=>-1])->paginate();
        return $this->fetch('index',['stores'=>$stores]);
    }


}