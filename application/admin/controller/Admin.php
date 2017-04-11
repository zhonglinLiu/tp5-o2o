<?php
namespace app\admin\controller;
use think\Controller;
use think\Session;
use think\Request;
use app\admin\controller\Base;
class Admin extends Controller{
   /* public function _initialize(){
        $user = Session::get('admin','admin');
        if(!empty($user) &&  $user->status!==4){
            exit('无此权限');
        }
    }*/
    public function login(){
        if(!empty(Session::get('admin','admin'))){
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
            $rel->last_login_time = time();
            $rel->save();
            Session::set('admin',$rel,'admin');
            return $this->result('登录成功',1);
        }

        return $this->fetch();
    }
    public function logout(){
        Session::clear('admin');
        $this->redirect('admin/login');
    }

    public function add(){
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

        $users = model('Admin')->where(['status'=>['neq',-1]])->paginate();
        return $this->fetch('',['users'=>$users]);
    }
    public function edit(){
        return '待开发...';
    }

    public function show(){
        return '待开发...';
    }
    public function changepass(){

        if(request()->isAjax()){
            $data = input('post.');
            $validate = validate('Admin');
            if($vaildate->scene('changepass')->check($data)){
                $admin = model('Admin')->where(['id'=>intval($data['id'])])->find();
                $admin->password = md5($data['password'].$admin->code);
                $rel = $admin->save();
                if(!$rel){
                    return $this->result(-1,'修改失败');
                }
                return $this->result(1,'修改成功');
                
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