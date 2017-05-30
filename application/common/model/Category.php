<?php
namespace app\common\model;
use think\Model;
class Category extends Base{
    public function add($data){
        $data['status'] = 1;
//        $data['create_time'] = time();
        return $this->save($data);
    }
    public function getNormalTopCategory(){
        $data = [
           'parent_id'=>0,
            'status'=>1
        ];
        $order = ['id'=>'desc'];
        $rel =  $this->where($data)->order($order)->select();
        $cates = [];
        foreach ($rel as $k => $v) {
            $cates[$v->id]=$v;
        }
        return $cates;
    }
    public function getTopCategory($parentid=0){
        $data = [
            'parent_id'=> $parentid,
            'status'=>['neq',-1]
        ];
        $order = ['listorder'=>'desc'];
        $rel = $this->where($data)->order($order)->paginate(3);
//        echo $this->getLastSql();
        return $rel;
    }

    public function getChildCatesByPids($topCates){
        $data = [
            'parent_id'=>['in',implode(',',$topCates)],
            'status'=>1
        ];

        $order = ['listorder'=>'desc'];
        $rel = $this->where($data)->order($order)->select();
        $cates = [];
        foreach($rel as $v){
            $cates[$v->parent_id][] = $v->toArray();
        }
        return $cates;
    }

     public function getCatesByIds($ids){
        $ids = trim(',',$ids);
        return $this->all($ids);
    }




}