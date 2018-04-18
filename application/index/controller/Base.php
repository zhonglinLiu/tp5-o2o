<?php
namespace app\index\controller;
use think\Controller;
use think\Session;
use think\Cache;
use think\Debug;
class Base extends Controller{
    public $city;
    public $city_id;
    public $cates;
    public function _initialize()
    {
        /*
        当后台城市更新时需要把categorys置为过期
         */
        if(Cache::has('categorys')){
            $this->cates = Cache::get('categorys');
        }else{
            $this->cates = $cates = $this->getCategorys();
            Cache::set('categorys',$cates,3600);
        }
        
        $features = model('Featured')->getFeatureds();
        $this->getHotCitys();
        $this->assign(['controller'=>strtolower(request()->controller())]);
        $this->assign(['cates'=>$this->cates,'featured'=>$features]);
        $this->assign(['title'=>'o2o团购网']);
    }
    public function getHotCitys(){
        if(Cache::has('citys')){
            $citys = Cache::get('citys',3600);
        }else{
            $citys = model('Citys')->field(['id','name','is_default'])->where(['status'=>1,'parent_id'=>0])->select();
            Cache::set('citys',$citys);
        }
        $this->getDefaultCity($citys);
        $this->assign('citys',$citys);
        $this->assign('city',htmlspecialchars($this->city));
        $this->assign('user',Session::get('user','o2o'));
    }

    public function getDefaultCity($city){
        $defaultCity = '';
        $city_id = '';
        foreach ($city as $v){
            if($v['is_default']==1){
                $defaultCity = $v['name'];
                $city_id = $v['id'];
                break;
            }
        }
        $defaultCity = $defaultCity!=='' ? $defaultCity : 'beijing';
        $city_id = $city_id!=='' ? $city_id : 1;

        if(Session::get('defaultCity','o2o') && !input('get.cityName')){
            $cityName = Session::get('defaultCity','o2o');
            $city_id = Session::get('city_id','o2o');
        }else{
            $cityName = input('get.cityName',$defaultCity,'trim');
            $city_id = input('get.city_id',$city_id,'trim');
            Session::set('defaultCity',$cityName,'o2o');
            Session::set('city_id',$city_id,'o2o');
        }
        $this->city = $cityName;
        $this->city_id = $city_id;
    }
    public function getCategorys(){
        $cateids =$cates = [];
        $topCates  = model('Category')->where(['parent_id'=>0,'status'=>1])->limit(5)->order(['listorder'=>'desc'])->select();
        foreach ($topCates as $k => $v){
            $cateids[] = $v['id'];
        }
        $childCates = model('Category')->getChildCatesByPids($cateids);
        foreach ($topCates as $v) {
            $cates[$v->id]['name']=$v->name;
            $cates[$v->id]['child']=isset($childCates[$v->id]) ? $childCates[$v->id] : '';
        }
        return $cates;

    }


}