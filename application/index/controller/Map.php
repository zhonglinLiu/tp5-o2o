<?php
namespace app\index\controller;
use think\Controller;
class Map extends Controller{
    public function getStatusMap($position){
        return \map::getImageByAddress($position);
    }
}