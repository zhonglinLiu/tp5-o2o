<?php
namespace app\api\controller;
use think\Controller;
use think\Request;
use Oss\ossFile;
class Image extends Controller{

    public function uploadImage(){
        $fileInfo = \fileHelper::instance()->file('imgFile');
        foreach ($fileInfo as $v) {
            $oss = new ossFile($v['tmp_name']);
            $oss->setUploadInfo($v);
            $fileObj = $oss->moves('upload','o2oStatic');
        }
        return json(['data'=>'/upload/'.$fileObj->getSaveName()]);
    }
}