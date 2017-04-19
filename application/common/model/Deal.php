<?php
namespace app\common\model;
use think\Model;
use think\Session;

class Deal extends Base {
    protected $type = [
        'start_time'=>'timestamp:Y-m-d h:i',
        'end_time'=>'timestamp:Y-m-d h:i',
        'coupons_begin_time'=>'timestamp:Y-m-d h:i',
        'coupons_end_time'=>'timestamp:Y-m-d h:i',
    ];
    public function getGoodsByCategory(){
        $catesid = config('params.deal');

        $order = ['listorder'=>'desc','id'=>'desc'];
        $goods = [];
        $city_id = Session::get('city_id','o2o');
        foreach ($catesid as $v){
            $data = [
                'status'=>1,
                'category_id'=>$v,
                'end_time'=>['gt',time()],
            ];
            if(!is_null($city_id)) $data['city_id']=$city_id;
            $goods[$v]['goods'] = $this->where($data)->order($order)->limit(10)->select();
            $goods[$v]['cates'] = model('Category')->where('parent_id='.$v)->limit(5)->select();
            $goods[$v]['topCates'] = model('Category')->where(['id'=>$v])->find();
        }
        return $goods;
    }
    public function getGoodsByOrder($data,$order){
        $where = [];
        $where[]=' status = 1 ';
        $where[]=' end_time > '.time();
        if(isset($data['city_id'])){
            $where[] = ' city_id = '.$data['city_id'];
        }
        if(isset($data['category_id'])){
            $where[] =' category_id = '.$data['category_id'];
        }
        if(isset($data['se_category_id'])){
            $where[]= ' find_in_set("'.$data['se_category_id'].'",se_category_id)';
        }

        $rel = $this->order($order)->where(implode(' and ',$where))->paginate();
        return $rel;
    }

}