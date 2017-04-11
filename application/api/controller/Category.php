<?php
namespace app\api\controller;
use think\Controller;
class Category extends Controller{
    public function getCategoryByPid(){
        $pid = input('post.parent_id');
        $data = model('Category')->where(['parent_id'=>$pid])->field(['id','name'])->select();
        if (empty($data)){
            return $this->result([],-1);
        }
        return $this->result($data,1);
    }
}