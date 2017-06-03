<?php
namespace app\admin\controller;
use think\Controller;
use app\common\service\DealService;
class Deal extends Base {
    public function index(){
        
        $data = input('post.');
       
        $sdata = DealService::instance()->getSearchCond($data);
        

        if(request()->isGet()){
            $deals = model('Deal')->where(['status'=>1])->paginate();
        }else{
            $deals = model('Deal')->where($sdata)->paginate();

        }
        $citys = [];
        $rel = model('Citys')->getNormalTopCitys(0);
        $cates = model('Category')->getNormalTopCategory();
        foreach ($rel as $k => $v){
            $citys[$v->id]=$v->toArray();
        }
        foreach ($deals as $k => $deal) {
            $deals[$k]['city_id'] = explode(',',$deal->city_id)[0];
        }
        return $this->fetch('index',[
            'deals'=>$deals,
            'citys'=>$citys,
            'cates'=>$cates,
            'start_time'=>empty($sdata['start_time']) ? '' : $data['start_time'],
            'end_time'=>empty($sdata['end_time']) ? '' : $data['end_time'],
            'name'=>empty($sdata['name']) ? '' : $data['name'],
            'city_id'=>in_array('city_id',$data) ? $data['city_id'] : '',
            'category_id'=>in_array('category_id',$data) ?  $data['category_id'] : ''
        ]);
        return $this->fetch('apply');
    }
    public function apply(){
        $sdata = [];
        $data = [];
        $data = input('post.');
       
        $sdata = DealService::instance()->getSearchCond($data);
        if(request()->isGet()){
            $deals = model('Deal')->where(['status'=>0])->paginate();
        }else{
            $deals = model('Deal')->where($sdata)->paginate();
        }
        $citys = $cates= [];
        $rel = model('Citys')->getNormalTopCitys(0);
        $tempCates = model('Category')->getNormalTopCategory(0);
        foreach ($rel as $k => $v){
            $citys[$v->id]=$v->toArray();
        }
        foreach ($tempCates as $v){
            $cates[$v->id] = $v->toArray();
        }

        foreach ($deals as $k => $deal) {
            $deals[$k]['city_id'] = explode(',',$deal->city_id)[0];
        }
        return $this->fetch('index',[
            'deals'=>$deals,
            'citys'=>$citys,
            'cates'=>$cates,
            'start_time'=>empty($sdata['start_time']) ? '' : $data['start_time'],
            'end_time'=>empty($sdata['end_time']) ? '' : $data['end_time'],
            'name'=>empty($sdata['name']) ? '' : $data['name'],
            'city_id'=>in_array('city_id',$data) ? $data['city_id'] : '',
            'category_id'=>in_array('category_id',$data) ?  $data['category_id'] : ''
        ]);
    }

    public function detail(){
        $id = input('get.id');
        if(empty($id)){
            $this->error('非法操作');
        }
        $citys = model('Citys')->getNormalTopCitys(0);
        $cates = model('Category')->getNormalTopCategory(0);
        $deal = model('Deal')->where(['id'=>intval($id)])->find();
        $locations = trim($deal->location_ids,',');
        $deal['city_id'] = trim($deal->city_id,',');
        $stores = [];
        $stores=model('BisLocation')->all($locations);
        $deal['city_name'] = model('Citys')->all($deal['city_id']);
         return $this->fetch('',[
            'deal'=>$deal,'stores'=>$stores,
            'citys'=>$citys,
            'categorys'=>$cates
        ]);

    }
}