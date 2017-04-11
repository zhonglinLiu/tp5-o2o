<?php
namespace app\admin\controller;
use think\Controller;
use app\common\model\Citys as CityModel;
use think\Cache;
class Citys extends Base {
    protected $obj;
    public function _initialize()
    {
        
        $this->obj = model('Citys');
    }

    public function index(){
        $pid = input('get.parent_id',0,'intval');
        $citys = $this->obj->getTopCitys($pid);
        return $this->fetch('',['citys'=>$citys]);
    }
    public function add(){
        $pid = input('get.parent_id',0,'intval');
        $citys = $this->obj->getNormalTopCitys($pid);
        return $this->fetch('',['citys'=>$citys]);
    }
    public function save(){
        $data = input('post.');
        $data['status'] = 1;
        $validate = validate('Citys');
        if(!$validate->scene('add')->check($data)){
            $this->error($validate->getError());
        }
        $rel = $this->obj->add($data);
        if($rel){
            if(Cache::has('citys')){
                Cache::rm('citys')
            }
            $this->success('新增成功');
        }
        $this->error('新增失败');

    }



    public function edit(){
        if(request()->isPost()){
            $data = input('post.');

            $validate = validate('Citys');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }
            $rel = CityModel::update($data,['id'=>intval(intval($data['id']))]);
            if($rel){
                $this->success('修改成功');
            }
            return $this->error('修改失败');
        }
        $id = input('get.id',null,'intval');
        $city = $this->obj->field(['name','id','parent_id'])->where(['id'=>$id])->find();
        $citys = $this->obj->getNormalTopCitys($city['parent_id']);
        return $this->fetch('',['citys'=>$citys,'city'=>$city]);
    }
}
