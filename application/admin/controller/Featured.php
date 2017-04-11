<?php
namespace app\admin\controller;
use think\Controller;
class Featured extends Base {
    public function index(){
        $type = config('featured.featured_type');
        $temp = '';
        if(request()->isPost()){
            $temp = input('post.type',0,'intval');
            $featured = model('Featured')->getFeaturedByType($temp);
        }else{
            $featured =  model('Featured')->order(['listorder'])->paginate();
        }

        return $this->fetch('',['type'=>$type,'featured'=>$featured,'sreached'=>$temp]);
    }
    public function add(){
        if(request()->isPost()){
            $data = input('post.');
            $data['title'] = htmlentities($data['title']);
            $validate = validate('Featured');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }
            $rel = model('Featured')->save($data);
            if($rel){
                $this->success('新增成功');
            }
            return $this->error('新增失败');
        }
        $featured = config('featured.featured_type');
        return $this->fetch('',['featured'=>$featured]);
    }

}