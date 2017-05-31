<?php
namespace app\admin\controller;
use think\Controller;
use think\Session;
use think\Request;
use think\Hook;
use app\admin\controller\Base;
class Admin extends Controller{
   /* public function _initialize(){
        $user = Session::get('admin','admin');
        if(!empty($user) &&  $user->status!==4){
            exit('无此权限');
        }
    }*/
    public function login(){
        
        \asynEmail::send('17739650739@163.com','xxx','测试');exit;
        if(model('Admin')->checkLogin()){
            $this->redirect('index/index');
        }
        if(request()->isAjax()){
            $data = input('post.');
            if(!captcha_check($data['verifyCode'])){
                return $this->result('验证码错误',-1);
            }
            $vaildate = validate('Admin');
            if(!$vaildate->scene('login')->check($data)){
                return $this->result($vaildate->getError(),-1);
            }
            $rel = model('Admin')->where(['username'=>$data['username']])->find();
            if(empty($rel)){
                return $this->result('该用户不存在',-1);
            }
            if(!$rel->password == md5($data['password'].$rel->code)){
                return $this->result('账号或密码错误',-1);
            }
            $rel->last_login_ip = Request::instance()->ip();
            $rel->save();
            Session::set('admin',$rel,'admin');

            return $this->result('登录成功',1);
            return model('Admin')->login($data);
        }

        return $this->fetch();
    }
    public function logout(){
        Session::clear('admin');
        $this->redirect('admin/login');
    }

    public function add(){
        if(!model('Admin')->checkLogin()){
            $this->redirect('admin/login');
        }
        if(request()->isPost()){
            $data = input('post.');

            $validate = validate('Admin');
            if(!$validate->scene('add')->check($data)){
                return $this->result($validate->getError(),-1);
            }
            $data['code'] = mt_rand(1000,9999);
            $data['password'] = md5($data['password'].$data['code']);
            $data['status']=1;
            $rel = model('Admin')->allowField(true)->save($data);
            if(empty($rel)){
                return $this->result('添加失败',-1);
            }
            return $this->result('添加成功',1);
        }
        return $this->fetch();
    }

    public function index(){
        if(model('Admin')->checkLogin()){
            $this->redirect('admin/login');
        }
        $sdata = [];
        $data = [];
        if(request()->isPost()){
            $data = input('post.');
            if(isset($data['begin_time']) && $data['begin_time']!=''){
                $sdata['last_login_time'] = ['egt',strtotime($data['begin_time'])];
            }
            if(isset($data['end_time']) && $data['end_time']!=''){
                $sdata['last_login_time'] = ['elt',strtotime($data['end_time'])];
            }
            if(isset($data['name']) && $data['name']!=''){
                $sdata['username']=['like','%'.$data['name'].'%'];
            }
        }
        $sdata['status'] = ['neq',-1];
        $users = model('Admin')->where($sdata)->paginate();
        return $this->fetch('',[
            'users'=>$users,
            'begin_time'=>isset($data['begin_time'])?htmlspecialchars($data['begin_time']):'',
            'end_time'=>isset($data['end_time'])?htmlspecialchars($data['end_time']):'',
            'name'=>isset($data['name'])?htmlspecialchars($data['name']):'',
            ]);
    }
    public function edit(){
        if(request()->isAjax()){
            $post = input('post.');
            $vaildate = vaildate('Admin');
            if(!$validate->scene('edit')->check($post)){
                return $this->result($vaildate->getError(),-1);
            }else{
                $rel = model('Admin')->save($post,['id'=>intval($post['id'])]);
                if(!$rel){
                    return $this->result('修改失败',-1);
                }
                return $this->result('修改成功',1);
            }
        }
        $id = input('get.id');
        if(empty($id)){
            return '参数错误';
        }
        $admin = model('Admin')->get($id);
        return $this->fetch('',['admin'=>$admin]);
    }

    public function show(){
        return '待开发...';
    }
    public function changepass(){

        if(request()->isAjax()){
            $data = input('post.');
            $validate = validate('Admin');
            if($validate->scene('changepass')->check($data)){
                $admin = model('Admin')->where(['id'=>intval($data['id'])])->find();
                $admin->password = md5($data['password'].$admin->code);
                $rel = $admin->save();
                if(!$rel){
                    return $this->result('修改失败',-1);
                }
                return $this->result('修改成功',1);
                
            }else{
                return $this->result(-1,$this->getError());
            }
        }else{
             $id = input('get.id');
            if(empty($id)){
                return '出错了';
            }
            $admin = model('Admin')->where(['id'=>$id])->find();
            return $this->fetch('',['admin'=>$admin]);
        }
           
    }
    public function status(){
        $status = input('get.status',0,'intval');
        $id = input('get.id',0,'intval');
        $rel = model('Admin')->save(['status'=>$status],['id'=>$id]);
        if(!$rel){
            return $this->result('修改失败',-1);
        }else{
            return $this->result('修改成功',1);
        }
    }


}