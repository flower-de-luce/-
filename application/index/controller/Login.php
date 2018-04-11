<?php
namespace app\index\controller;
use think\Controller;
use think\Validate;
use think\cache;
use think\Db;

class Login extends BaseController
{
    public function index()
    {

        if(input('post.')){
            //设置验证规则
            $validate = new Validate([
                'name'  => 'require|max:20|min:3',
                'password' => 'require|min:6|max:18'
            ]);
            //验证
            if (!$validate->check(input('post.'))) {
               $error=$validate->getError();
               foreach(array('name'=>'用户名','password'=>'密码') as $k=>$v){
                   $error=str_replace($k,$v,$error);
               }
                $this->error($error,NULL,'',2);
            }
            //验证账号
            //todo::验证账号
            $res= Db::name('user')->where('name','=',input('name'))->where('password','=',input("password"))->find();
            if(!$res) $this->error('用户名或密码错误');
            $ip=$_SERVER["REMOTE_ADDR"];
            $user_token=md5($res['name'].$res['password'].'login'.$ip.mt_rand(1000,9999));
            Db::name('user')->where('name','=',input("name"))->where('password','=',input("password"))->update(['last_login'=>time(),'user_token'=>$user_token]);
            cache('user_token',$user_token);
            cookie('user_info[username]',$res['name']);
            cookie('user_info[token]',$user_token);
            //渲染主页
           $this->success('登录成功',url('/index/index/index'),'',1);
        }else{
           return  view('login');
        }
    }

    public function logout(){
     session('login_info',NULL);
        $this->success('退出成功','index/login/index','',3);

    }
}

