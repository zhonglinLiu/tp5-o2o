<?php 
class asynEmail{
	public static function send($to,$subject,$msg){
		$redis = \RedisHelp::instance();
		$data = json_encode([
			'to'=>$to,
			'subject'=>$subject,
			'msg'=>$msg
		]);
		$redis->lpush('email',$data);
	}
}