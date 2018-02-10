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
            //渲染主页
            return view('index',array());
        }else{
           return  view('login');
        }
    }
}

