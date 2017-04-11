<?php
namespace app\index\controller;
use think\Controller;
use think\Session;

class Lists extends Base {
    public function index(){
        $cateid = !empty(input('get.id')) ? input('get.id') : input('get.se_category_id');
        $order = input('get.order');
        $se_category_id = input('get.se_category_id');

        $parent_id=$cateid;
        if(is_null($cateid)){
            $parent_id = 0;
        }elseif(!array_key_exists($cateid,$this->cates)){
           foreach ($this->cates as $cate){
               if(!is_array($cate['child']))continue;
               foreach ($cate['child'] as $v){
                   if($v['id']==$cateid){
                       $parent_id = $v['parent_id'];
                   }
               }
           }
        }
        $cates = model('Category')->where(['status'=>1,'parent_id'=>$parent_id])->select();
        $orderArr = [];
        $orderflog = '';
        if(empty($order) || $order=='order_default' ){
            $orderArr['listorder'] = 'desc';
            $orderflog = 'order_default';
        }elseif($order=='order_sale'){
            $orderflog = 'order_sale';
            $orderArr['buy_count'] = 'desc';
        }elseif($order=='order_price'){
            $orderflog = 'order_price';
            $orderArr['current_price']='asc';
        }
        $where = [];
        $where['category_id'] = input('get.id');
        $where['city_id'] = Session::get('city_id','o2o');
        if(!is_null($se_category_id)){
            $where['se_category_id'] = $se_category_id;
        }
        $deals = model('Deal')->getGoodsByOrder($where,$orderArr);
        return $this->fetch('',[
            'parent_id' => $parent_id,
            'listCates' => $cates,
            'cateid'=>$cateid,
            'deals'=>$deals,
            'orderflog'=>$orderflog,
            'total'=>$deals->total(),
        ]);
    }
}