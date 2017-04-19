<?php
namespace app\common\model;
use think\Model;
class User extends Base {
	protected $type = [
		'last_login_time'=>'timestamp:Y-m-d h:i',
	];
}