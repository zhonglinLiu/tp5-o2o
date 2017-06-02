<?php
namespace app\bis\controller;
use think\Controller;
use app\common\model\Citys;
use think\Db;
use think\Exception;

class Register extends Base
{
   protected $obj = null;
    public function _initialize(){
        $this->obj = model('Citys');
    }
    public function index(){
        $citys = $this->obj->getNormalTopCitys(0);
        $cates = model('Category')->getNormalTopCategory(0);
        return $this->fetch('',['citys'=>$citys,'cates'=>$cates]);
    }
    public function add(){
        $postdate = input('post.');
//        $postdate = input('post.','','htmlentities');
        $validate = validate('bis');
        if(!$validate->scene('add')->check($postdate)){
            $this->error($validate->getError());
        }
        $coor = \map::getCoorByAddress($postdate['address']);
        if(empty($coor) || $coor->status==1){
            $this->error('请填写合法地址');
        }else if($coor->result->precise==0){
            $this->error('请填写详细地址');
        }
        $postdate['name'] = htmlentities($postdate['name']);
        $postdate['xpoint'] = $coor->result->location->lng;
        $postdate['ypoint'] = $coor->result->location->lat;
        $postdate['is_main'] = 1;
        $postdate['status'] =0;
        if(!empty($postdate['se_category_id'])){
            $se_category_id = $postdate['category_id'].','.implode(',',$postdate['se_category_id']);
            $postdate['category_path'] = $se_category_id;
        }


        $postdate['city_path'] = empty($postdate['se_city_id']) ? $postdate['city_id']:$postdate['city_id'].','.$postdate['se_city_id'];
        // 商户信息插入
        Db::startTrans();
        try{
            $Bis = model('Bis');
            $Bis->allowField(true)->save($postdate);
            $bis_id = $Bis->id;
                // 商户门店表
            $postdate['bis_id'] = $bis_id;
            $postdate['api_address'] = $postdate['address'];
            model('BisLocation')->allowField(true)->save($postdate);
            //商户账号表
            $postdate['code'] = mt_rand(100,10000);
            $postdate['password'] = md5($postdate['password'].$postdate['code']);
            model('BisAccount')->allowField(true)->save($postdate);
            Db::commit();
        }catch (\Exception $e){
            Db::rollback();
            $this->error('注册失败');
        }
        $url = request()->domain().url('bis/register/waiting',['bis'=>$bis_id]);
        $msg = '<p>您已成功注册为xxxo2o商城商户</p><p><a href="'.$url.'">点击链接查看审核状态</a></p>';
        // $rel = \PHPMailer\Email::send($postdate['email'],'注册信息',$msg);
        \asynEmail::send($postdate['email'],'注册信息',$msg);
        /*if($rel){
           $this->success('邮件成功发送，请注意查收','register/waiting',['bis'=>$bis_id]);
        }*/
        // $this->error('注册失败');
        $this->success('邮件成功发送，请注意查收','register/waiting',['bis'=>$bis_id]);

    }
    public function waiting(){
        $id = input('get.bis');
        $bis =model('Bis')->get($id);
        if(!empty($bis) && $bis->status==1){
            $this->success('入驻申请审核通过','login/index');
        }
        return $this->fetch('',['bis'=>$bis]);
    }

}