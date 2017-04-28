<?php 
use Raven\RavenAutoloader;
class sentry{
	public static $client = null;
	public static function init(){
		if(is_null(self::$client)){
			RavenAutoloader::register();
		    self::$client = new \Raven_Client(config('params.sentry')['dsn']);
		    $error_handler = new \Raven_ErrorHandler(self::$client);
		    $error_handler->registerExceptionHandler();
		    $error_handler->registerErrorHandler();
		    $error_handler->registerShutdownFunction();
		}
		    
	}
	public static function captureMessage($msg=null){
		self::init();
		self::$client->captureMessage($msg);
	
		
	}

	public static function captureException($e,$arr=[]){
		self::init();
		self::$client->captureException($e,$arr);
		
	}
}