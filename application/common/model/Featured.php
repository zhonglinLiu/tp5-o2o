<?php
namespace app\common\model;
use think\Model;
class Featured extends Base {
    public function getFeaturedByType($type){
        $data = [
            'type'=>$type,
        ];
        $order=['listorder'=>'desc'];
        return $this->where($data)->order($order)->paginate();
    }
    public function getFeatureds(){
        $features = [];
        $rel = $this->where(['status'=>1])->select();
        foreach ($rel as $v) {
            $features[$v['type']][]=$v->toArray();
        }
        return $features;
    }
}