<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Exception;
use app\common\service\BisService;
class Bis extends Base {
   public function apply(){
       $bis = model('Bis')->getBisByStatus();
       return $this->fetch('',['bis'=>$bis]);
   }

   public function detail(){
        $id = input('get.id');
        if(empty($id)){
            $this->error('参数错误');
        }

        $citys = model('Citys')->getNormalTopCitys(0);
        $cates = model('Category')->getNormalTopCategory(0);
        $bisLocation = model('BisLocation')->where(['bis_id'=>$id,'is_main'=>1])->find();
        $bisAccount = model('BisAccount')->where(['bis_id'=>$id])->field(['username'])->find();
        if(empty($bisLocation) || empty($bisAccount) ){
            $this->error('该商户信息不全');
        }

        $bisLocation['categoryName'] = model('Category')->getCatesByIds($bisLocation['category_path']);
        $bis = BisService::instance()->getBisDetail($id);
        return $this->fetch('',[
            'citys'=>$citys,'cates'=>$cates,
            'bis'=>$bis,
            'bisLocation'=>$bisLocation,
            'bisAccount'=>$bisAccount,
        ]);
    }

    public function status(){
       $data = input('get.');
       $validate = validate('Bis');
       if(!$validate->scene('status')->check($data)){
           $this->error($validate->getError());

       }
        Db::startTrans();
       try{
          BisService::instance()->changeStatus($data['id'],$data['status']);
          Db::commit();
       }catch (\Exception $e){
           $this->error($e->getMessage());
           Db::rollback();
       }

      
       $email = model('Bis')->where(['id'=>$data['id']])->field(['email'])->find()['email'];
       BisService::instance()->sendEmail($email,$data['status']);
       $this->success('操作成功');
    }
    public function index(){
        $bis = model('Bis')->getBisByStatus(1);
        return $this->fetch('',['bis'=>$bis]);
    }
    public function dellist(){
        $bis = model('Bis')->getBisByStatus(-1);
        return $this->fetch('',['bis'=>$bis]);
    }

}