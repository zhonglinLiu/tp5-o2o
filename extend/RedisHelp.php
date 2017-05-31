<?php 

class RedisHelp{
	protected static $redis = null;
	protected function __construct(){

	}
	public static function instance(){
		if(is_null(self::$redis)){
			$conf = config('redis');
			self::$redis = new \Redis();
			self::$redis->connect($conf['host'],$conf['port']);
			self::$redis->select($conf['db']);
		}
		return self::$redis;
	}

}