<?php
namespace app\admin\model;
use think\Model;
class Admin extends Model{
    protected $autoWriteTimestamp = true;
    protected $type = [
    	'last_login_time'=>'timestamp:Y-m-d h:i',
    ];
}