<?php
namespace app\index\controller;
use think\Controller;
use think\Session;
use Wxpay\WxPayApi;
use Wxpay\WxPayNativePay;
use Wxpay\database\WxPayUnifiedOrder;
use Wxpay\WxPayConfig;
class Pay extends Base {
    public function weixinPay(){
        $data = file_get_contents('php://input');
        var_dump($data);
    }
    public function index(){
        $id = input('post.deal_id');
        $name = input('post.name');
        $out_trade_no = input('post.out_trade_no');
        $order = model('Order')->where(['deal_id'=>$id,'out_trade_no'=>$out_trade_no])->find();
        if(empty($order) || $order->username!=Session::get('user','o2o')->username){
            $this->error('非法操作');
        }
        //必须申请微信的支付接口才能用,生成支付二维码
       /* ini_set('date.timezone','Asia/Shanghai');
        $notify = new WxPayNativePay();
        $url1 = $notify->GetPrePayUrl("123456789");
        $input = new WxPayUnifiedOrder();
        $input->SetBody("test");
        $input->SetAttach("test");
        $input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
        $input->SetTotal_fee("1");
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag("test");
        $input->SetNotify_url("http://paysdk.weixin.qq.com/example/notify.php");
        $input->SetTrade_type("NATIVE");
        $input->SetProduct_id("123456789");
        $result = $notify->GetPayUrl($input);
        $url2 = $result["code_url"];
        return '<img alt="模式二扫码支付" src="http://paysdk.weixin.qq.com/example/qrcode.php?data='.urlencode($url2).'" style="width:150px;height:150px;"/>';*/
        return $this->fetch('',['title'=>'扫描支付','deal_id'=>$id,'out_trade_no'=>$out_trade_no]);
    }

    public function notify(){
        //这里面是第三方支付回调通知第地址，而本操作只是模拟操作，不是正真付款
        $deal_id = input('get.deal_id');
        $out_trade_no = input('get.out_trade_no');
        $order = model('Order')->where(['deal_id'=>$deal_id,'out_trade_no'=>$out_trade_no])->find();
        if(empty($order)){
            $this->error('非法操作');
        }
        if($order->pay_status==1){
            $this->success('该商品已经付款','pay/succes');
        }
        $order->pay_status = 1;
        $rel = $order->save();
        if(!$rel){

            $this->error('付款失败');
        }
        $deal = model('Deal')->where(['id'=>$order->deal_id])->find();
        $deal->buy_count+=1;
        $deal->save();
         $data = [
            'sn'=>$out_trade_no,
            'password'=>mt_rand(1000,9999),
            'user_id'=>$order->user_id,
            'deal_id'=>$order->deal_id,
            'order_id'=>$order->id,
        ];
        model('Coupons')->save($data);
        $this->success('购买成功','pay/succes');
       

    }

    public function succes(){
        return $this->fetch('succes');
    }

}