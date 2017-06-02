<?php 
namespace app\command;
use think\Console\Command;
use think\Console\Input;
use think\Console\Output;
use PHPMailer\Email as SendEmail;

class Email extends Command{
	protected function configure()
    {
        $this->setName('email')->setDescription('异步发送邮件');
    }

    protected function execute(Input $input, Output $output)
    {
        $redis = \RedisHelp::instance();
        $len = $redis->llen('email');
        if($len>10){
        	$data = $redis->lrange('email',($len-9),-1);
        	$redis->ltrim('email',0,($len-10));
        }else{
        	$data = $redis->lrange('email',0,-1);
        	$redis->ltrim('email',1,0);
        }
        foreach ($data as $k => $v) {
        	$cont = json_decode($v,true);
        	SendEmail::send($cont['to'],$cont['subject'],$cont['msg']);
        	// $output->writeln($cont['to']);
        }

        return;
        
    }
}