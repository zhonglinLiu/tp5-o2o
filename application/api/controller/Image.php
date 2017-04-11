<?php
namespace app\api\controller;
use think\Controller;
use think\Request;

class Image extends Controller{
    public function uploadImage(){
        $file = Request::instance()->file('imgFile');
        $info = $file->move('upload');
        if($info && !empty($info)){
//            echo $info->getPathname();
            return json_encode(['data'=>'\\'.$info->getPathname(),'msg'=>'success','code'=>1]);
        }
        return json_encode(['data'=>'','message'=>'上传失败','code'=>-1]);
    }
}