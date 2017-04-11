<?php
namespace app\admin\controller;
use think\Controller;
class Area extends Base {
    protected $obj = null;
    public function _initialize(){
         $this->obj = model('Area');
    }
    public function index(){
        $pid = input('get.parent_id');
        if(!$pid){
            $pid = 0;
        }
        $area = $this->obj->getTopArea($pid);

        return $this->fetch('',['area'=>$area]);
    }
    public function add(){
        $pid = 0;
        $area = $this->obj->getNormalTopArea($pid);
        $citys = $this->obj->getCityList();
        return $this->fetch('',['area'=>$area,'citys'=>$citys]);
    }

    public function save(){
        if(request()->isPost()){
            $data = input('post.');
        }
        $validate = validate('Area');
        if(!$validate->scene('add')->check($data)){
            $this->error($validate->getError());
        }
        $data['status'] = 1;
        $rel = $this->obj->save($data);
        if($rel){
            $this->success('新增成功');
        }
        return $this->error('新增失败');
    }


}