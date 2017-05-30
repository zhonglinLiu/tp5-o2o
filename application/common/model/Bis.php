<?php
namespace app\common\model;
use think\Model;
class Bis extends Base {
    public function getBisByStatus($status=0){
        $data = [
            'status'=>$status,
        ];
        $order = [
            'listorder'=>'desc',
        ];
        return $this->order($order)->where($data)->paginate();
    }

    public function changeStatusById($id,$status){
    	return $this->save(['status'=>$status],['id'=>$id]);
    }

    

}