<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Exception;

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
        $bis = model('Bis')->where(['id'=>$id])->find();
        $bisLocation = model('BisLocation')->where(['bis_id'=>$id,'is_main'=>1])->find();
        $bisAccount = model('BisAccount')->where(['bis_id'=>$id])->field(['username'])->find();
        if(empty($bisLocation) || empty($bisAccount) ){
            $this->error('该商户信息不全');
        }

        $category_path = explode(',',$bisLocation['category_path']);
        if(count($category_path)>1){
            $where = '';
            for ($i=1;$i<count($category_path);$i++){
                $where.='id='.$category_path[$i].' and ';
            }
            $where = trim($where,' and ');
            $bisLocation['categoryName'] = model('Category')->field(['name'])->where($where)->select();
        }else{
            $bisLocation['categoryName'] = '';
        }

        $city_path = explode(',',$bis['city_path']);
        if(count($city_path)>1){
            $bis['se_city'] = model('Citys')->field(['name'])->where(['id'=>$city_path[1]])->find();
            $bis['se_city_id'] = $city_path[1];
        }else{
            $bis['se_city'] ='';
        }


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
           $rel = model('Bis')->save(['status'=>$data['status']],['id'=>$data['id']]);
           if(!$rel){
               throw new \Exception('更新状态失败1');
           }
           $rel = model('BisLocation')->save(['status'=>$data['status']],['bis_id'=>$data['id']]);
           if(!$rel){
               throw new \Exception('更新状态失败2');
           }
           $rel =model('BisAccount')->save(['status'=>$data['status']],['bis_id'=>$data['id']]);
            if(!$rel){
                throw new \Exception('更新状态失败3');
            }
           Db::commit();
       }catch (\Exception $e){
           $this->error($e->getMessage());
           Db::rollback();
       }
       $str = '';
       $url = request()->domain().url('/bis/login/index');
       switch ($data['status']){
           case -1:
               $str = '审核被删除';
               break;
           case 1:
               $str = '审核已通过<a href="'.$url.'" ></a>';
               break;
           case 2:
               $str = '审核被驳回';
               break;
           default:
               break;
       }
       $email = model('Bis')->where(['id'=>$data['id']])->field(['email'])->find()['email'];
       if($str!='' && !empty($email) ){
           \PHPMailer\Email::send($email,'xxo2o审核信息',$str);
       }
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