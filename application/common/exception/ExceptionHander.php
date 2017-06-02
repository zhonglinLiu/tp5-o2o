<?php
namespace app\common\exception;
use think\exception\Handle;
use think\Exception;
use app\common\validate\BaseValidate;
class ExceptionHander extends Handle{
	/**
	 * [render 重写Handle 当发生未知错误是发送邮件]
	 * @param  Exception $e [description]
	 * @return [type]       [description]
	 */
	public function render(\Exception $e){
		if(config('params.sentry')['Enable']){
			\sentry::captureException($e);
		}
		if($e instanceof BaseException){
			return json(['code'=>-1,'data'=>$e->getMessage()]);
		}
		return parent::render($e);
	}
}