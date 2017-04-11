<?php
namespace app\bis\controller;
use think\Controller;
use think\Session;

class Deal extends Base {
    public function index(){
        $id = Session::get('user','bis')['id'];
        $deals = model('Deal')->where(['bis_account_id'=>$id,'status'=>['neq',-1]])->paginate();
        return $this->fetch('',['deals'=>$deals]);
    }
    public function add(){
        if(request()->isPost()){
            $data = input('post.');
            $validate = validate('Deal');
            if(!$validate->scene('add')->check($data)){
                return $this->error($validate->getError());
            }
            $location = model('BisLocation')->field(['xpoint','ypoint'])->where(['id'=>$data['location_ids'][0]])->find();
            $data['se_category_id'] = empty($data['se_category_id']) ? '' : implode(',',$data['se_category_id']);
            $data['bis_id'] = Session::get('user','bis')['bis_id'];
            $data['location_ids'] = empty($data['location_ids']) ? '' : implode(',',$data['location_ids']);
            $data['start_time'] = strtotime($data['start_time']);
            $data['end_time'] = strtotime($data['end_time']);
            $data['coupons_begin_time'] = strtotime($data['coupons_begin_time']);
            $data['coupons_end_time'] = strtotime($data['coupons_end_time']);
            $data['xpoint'] = $location->xpoint;
            $data['ypoint'] = $location->ypoint;
            $data['city_id'] = (empty($data['se_city_id'])||$data['se_city_id']==0) ? $data['city_id'] : $data['city_id'].','.$data['se_city_id'];
            $data['bis_account_id'] = Session::get('user','bis')['id'];
            $rel = model('Deal')->allowField(true)->save($data);
            if($rel){
                return $this->success('申请成功',url('deal/index'));
            }
            return $this->error('申请失败');
        }else {
            $bis_id = Session::get('user','bis')['bis_id'];
            $citys = model('Citys')->getNormalTopCitys(0);
            $cates = model('Category')->getNormalTopCategory(0);
            $stores = model('BisLocation')->field(['id','name'])->where(['bis_id'=>$bis_id,'status'=>1])->select();
            return $this->fetch('', ['citys' => $citys, 'categorys' => $cates,'stores'=>$stores]);
        }
    }

    public function detail(){
        $id = input('get.id');
        if(empty($id)){
            $this->error('非法操作');
        }
        $citys = model('Citys')->getNormalTopCitys(0);
        $cates = model('Category')->getNormalTopCategory(0);
        $deal = model('Deal')->where(['id'=>intval($id)])->find();
        $locations = explode(',',trim($deal->location_ids,','));
        $deal['city_id'] = explode(',',trim($deal->city_id,','));
        $stores = [];

        return $this->fetch('',[
            'deal'=>$deal,'stores'=>$stores,
            'citys'=>$citys,
            'categorys'=>$cates
        ]);
    }

    public function status(){
        $id = input('get.id');
        $rel = model('Deal')->save(['status'=>-1],['id'=>intval($id)]);
        if($rel){
            $this->redirect($_SERVER['HTTP_REFERER']);
        }
        $this->error('操作失败');
    }
}