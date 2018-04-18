<?php
namespace app\index\controller;
use app\index\controller\Base;
use think\Controller;
use think\Session;
use think\Debug;
use app\common\service\CacheService;
class Index extends Base {
	public function index(){
		$filename = ROOT_PATH.'public/html/index.'.$this->city_id.'.html';
		if(!CacheService::isCache($filename,60)){
			$goods  = model('Deal')->getGoodsByCategory();
			$content = $this->fetch('',['goods'=>$goods,'cateid'=>-1]);
			return CacheService::fileCache($filename,$content,60);
		}
	    return CacheService::showCache($filename);
		
	}

}