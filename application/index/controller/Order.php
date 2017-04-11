<?php
namespace app\index\controller;
use think\Controller;
use think\Session;

class Order extends Base{
    public function index(){
        if(! ($user = Session::get('user','o2o'))){
            $this->redirect(url('user/login'));
        }
        $id = input('get.id',0,'intval');
        $count = input('get.count',1,'intval');
        if(!$id || !$count){
            $this->error('非法参数');
            return;
        }
        $deal = model('Deal')->where(['id'=>$id])->find();
        if(empty($deal) || $deal->status!=1){
            $this->error('该商品已下架');
            return;
        }

        return $this->fetch('confirm',[
            'deal'=>$deal,
            'count'=>$count,
            'email'=>$user->email,
        ]);
    }
    public function confirm(){
        if(request()->isAjax()){
            $id = input('post.id',0,'intval');
            $count = input('post.count',0,'intval');
            if(!$id || !$count){
                return $this->result('参数非法',-1);
            }
            if(!isset($_SERVER['HTTP_REFERER'])){
                return $this->result('非法请求',-1);
            }
            $out_trade_no = model('Order')->getTrade();
            $deal = model('Deal')->where(['id'=>$id])->find();
            $user = Session::get('user','o2o');
            $data = [
                'out_trade_no'=>$out_trade_no,
                'user_id'=>$user->id,
                'username'=>$user->username,
                'deal_id'=>$id,
                'deal_count'=>$count,
                'total_price'=>$deal->current_price*$count,
                'referer'=>$_SERVER['HTTP_REFERER'],
            ];
            $rel = model('Order')->save($data);
            if(!$rel){
                return $this->result('确认订单失败',-1);
            }
            return $this->result('确认订单成功',1,$data['out_trade_no']);
        }
    }


}