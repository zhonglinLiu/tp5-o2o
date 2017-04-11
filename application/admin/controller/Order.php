<?php 
namespace app\admin\controller;
use think\Controller;
class Order extends Controller{
	public function index(){

		if(request()->isPost()){
			$data = input('post.');
			$sdata = [];
			if($data['datemin']!='' && $data['datemax']!=''){
				if($data['datemin']!=''){
					$sdata['create_time'][]=['gt',strtotime($data['datemin'])];
				}
				if($data['datemax']!=''){
					$sdata['create_time'][]=['lt',strtotime($data['datemax'])];
				}
			}else{
				if($data['datemin']!=''){
					$sdata['create_time']=['gt',strtotime($data['datemin'])];
				}
				if($data['datemax']!=''){
					$sdata['create_time']=['lt',strtotime($data['datemax'])];
				}
			}
			if(is_numeric($data['keys'])){
				$sdata['out_trade_no'] = $data['keys'];
			}elseif(is_string($data['keys'])){
				$sdata['username'] = $data['keys'];
			}
			
			$orders = model('Order')->getOrdersByPage($sdata);
		}else{
			$orders = model('Order')->getOrdersByPage();
		}
		
		return $this->fetch('',['orders'=>$orders]);
	}
}