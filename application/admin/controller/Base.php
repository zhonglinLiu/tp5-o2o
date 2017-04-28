<?php
namespace app\admin\controller;
use think\Controller;
use think\Session;
use sentry;
class Base extends Controller{
    public function _initialize()
    {
        try {
            $i = 1 / 0;
        } catch (\Exception $e) {
            // \sentry::captureException($e);
            
        }
        
        
        exit;
        $user = Session::get('admin','admin');
        if(empty($user)){
            $this->redirect('admin/login');
        }
        if($user->status==4){
            $isSuper = 1;
        }else{
            $isSuper = 0;
        }
        $this->assign('isSuper',$isSuper);

    }

    public function status(){
        $status = input('get.status','','intval');
        $id = input('get.id','','intval');
        if(is_null($status)){
            $this->error('非法操作');
        }
        $model = request()->controller();
        $rel = model($model)->save(['status'=>$status],['id'=>$id]);
        if($rel){
            $this->redirect($_SERVER['HTTP_REFERER']);
        }
        $this->error('操作失败');
    }
    public function listorder(){
        $listorder = input('post.listorder','','intval');
        $id = input('post.id','','intval');
        $Controller = request()->controller();
        $model = model($Controller);
        $rel = $model->save(['listorder'=>$listorder],['id'=>intval($id)]);
        if($rel){
            return $this->result('排序成功',1);
        }
        return $this->result('排序失败',0);

    }
}