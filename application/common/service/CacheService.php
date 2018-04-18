<?php 
namespace app\common\service;

class CacheService{
	public static function fileCache($filename,$content){
		$path = dirname($filename);
		if(!is_dir($path)){
			mkdir($path,777,true);
		}
		file_put_contents($filename,$content);
		return $content;
		
		
	}
	public static function isCache($filename,$expr){
		if(!file_exists($filename)){
			return false;
		}
		if(filemtime($filename)+$expr < time()){
			return false;
		}
		return true;
	}

	public static function showCache($filename){
		return file_get_contents($filename);
	}

	public static function redisCache(){
		
	}
}