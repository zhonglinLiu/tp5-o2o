<?php
namespace app\common\model;
use think\Model;
class Order extends Base{
    public function getTrade(){
        list($t1,$t2) = explode(' ',microtime());
        return explode('.',$t1)[1].$t2;

    }
    public function getOrdersByPage($data=[]){
		$data = $data;
		$rel = $this->where($data)->order(['create_time'=>'desc'])->paginate();
		return $rel;
	}

}