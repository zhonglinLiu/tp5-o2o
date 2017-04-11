<?php 
namespace app\admin\controller;
use think\Controller;
use app\common\model\Category as Catemodel;
use think\Cache;
class Category extends Base
{
    protected $obj = null;
    public function _initialize()
    {
        $this->obj = model('Category');
    }

    public function index()
    {
        $parentid = input('get.parent_id',0,'intval');
        $cates = $this->obj->getTopCategory($parentid);
        return $this->fetch('',['cates'=>$cates]);
    }
    public function add()
    {
        $categorys = $this->obj->getNormalTopCategory();
        return $this->fetch('',['cates'=>$categorys]);
    }
    public function save(){
        if(!request()->isPost()){
            $this->error('非法操作');
        }
        $data = input('post.');
        $validate = validate('Category');
        if(!$validate->scene('add')->check($data)){
            $this->error($validate->getError());
        }
        if(isset($data['id'])){
            $rel = Catemodel::update($data,['id'=>intval($data['id'])]);
            if($rel){
                return $this->success('修改成功');
            }
            return $this->error('修改失败');
        }
        $rel = $this->obj->add($data);
        if($rel){
            if(Cache::has('categorys')){
                Cache::rm('categorys');
            }
            return $this->success('新增成功');
        }
        return $this->error('新增失败');
    }
    public function edit(){
        $id = input('get.id','0','intval');
        $cate = $this->obj->get($id);
        $cates = $this->obj->getNormalTopCategory();
        return $this->fetch('',['cate'=>$cate,'cates'=>$cates]);

    }




}
