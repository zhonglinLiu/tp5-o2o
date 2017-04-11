<?php
namespace app\bis\controller;
use think\Controller;
use think\Session;

class Location extends Controller{
    public function index(){
        $id = Session::get('user','bis')->bis_id;
        $locations = model('BisLocation')->where(['bis_id'=>$id])->paginate();
        return $this->fetch('',['locations'=>$locations]);
    }
    public function add(){
        if(request()->isPost()) {
            $postdate = input('post.');

            $validate = validate('BisLocation');
            if (!$validate->scene('add')->check($postdate)) {
                $this->error($validate->getError());
            }
            $coor = \map::getCoorByAddress($postdate['address']);;
            if (empty($coor) || $coor->status == 1) {
                $this->error('请填写合法地址');
            } else if ($coor->result->precise == 0) {
                $this->error('请填写详细地址');
            }
            $postdate['xpoint'] = $coor->result->location->lng;
            $postdate['ypoint'] = $coor->result->location->lat;
            $postdate['is_main'] = 0;
            $postdate['status'] = 0;
            if (!empty($postdate['se_category_id'])) {
                $se_category_id = $postdate['category_id'] . ',' . implode(',', $postdate['se_category_id']);
                $postdate['category_path'] = $se_category_id;
            }
            $postdate['city_path'] = empty($postdate['se_city_id']) ? $postdate['city_id']:$postdate['city_id'].','.$postdate['se_city_id'];
            $postdate['bis_id'] = Session::get('user','bis')->bis_id;
            $rel = model('BisLocation')->allowField(true)->save($postdate);
            if($rel){
                return $this->success('申请成功');
            }
            return $this->success('申请失败');

        }
        $citys = model('Citys')->getNormalTopCitys(0);
        $cates = model('Category')->getNormalTopCategory(0);

        return $this->fetch('',['citys'=>$citys,'categorys'=>$cates]);
    }
}