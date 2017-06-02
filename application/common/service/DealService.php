<?php 
namespace app\common\service;

class DealService{
	protected static $inc = null;
	protected function __construct(){

	}

	public static function instance(){
		if(is_null(self::$inc)){
			self::$inc = new self;
		}
		return self::$inc;
	}

	public function getSearchCond($data){
		$sdata = [];
		if(!empty($data['start_time']) && !empty($data['end_time']) && strtotime($data['end_time'])>strtotime($data['start_time'])){
            $sdata['start_time'] = ['gt',strtotime(strtotime($data['start_time']))];
            $sdata['end_time'] = ['lt',strtotime($data['end_time'])];
        }
        if(!empty($data['name'])){
            $sdata['name'] = ['like','%'.$data['name'].'%'];
        }
        if(!empty($data['category_id'])){
            $sdata['category_id'] = $data['category_id'];
        }
        if(!empty($data['city_id'])){
            $sdata['city_id'] = $data['city_id'];
        }
        $sdata['status'] = 1;
        return $sdata;
	}
}