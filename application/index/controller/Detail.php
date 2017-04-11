<?php
namespace app\index\controller;
use think\Controller;
class Detail extends Base{
    public function index(){
        $id = input('get.id');
        if(is_null($id)){
            $this->error('未找到该商品');
        }
        $deal = model('Deal')->where(['id'=>intval($id)])->find();
        $cate = model('Category')->where(['id'=>$deal->category_id])->find();
        $bis = model('Bis')->field(['id','name','description'])->where(['id'=>$deal->bis_id])->find()->toArray();
        $location = model('BisLocation')->getLocationByBisid($bis['id']);
        $timestmp = $deal->start_time-time();
        $countDown = '';
        if($timestmp >0){
            $flog = 1;
        }else{
            $flog = 0;
        }
        if(($t = $timestmp/3600/24)>1){
            $countDown.= floor($t).'天';
        }
        if(($t = $timestmp%(3600*24)/3600)>1){
            $countDown.= floor($t).'小时';
        }
        if(($t = $timestmp%(3600*24)%3600/60)>1){
            $countDown.=floor($t).'分钟';
        }
        return $this->fetch('',[
            'title'=>$deal->name,
            'cate'=>$cate->toArray(),
            'flog'=>$flog,
            'deal'=>$deal,
            'bis'=>$bis,
            'countDown'=>$countDown,
            'position'=>$deal['xpoint'].','.$deal['ypoint'],
            'locations'=>$location,
            'cateid'=>-1
        ]);
    }
}