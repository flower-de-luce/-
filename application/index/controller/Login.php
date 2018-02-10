<?php
namespace app\index\controller;
use think\Controller;
use think\Validate;

class Login extends Controller
{
    public function index()
    {
        if(input('post.')){
            //设置验证规则
            $validate = new Validate([
                'name'  => 'require|max:20|min:5',
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
            session_start();
            session('login_info',array('name'=>input('post.name'),'password'=>input('post.password'),'login_time'=>time()));
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

