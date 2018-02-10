<?php
namespace app\index\controller;
use think\Controller;
use think\Validate;

class Login extends Controller
{
    public function index()
    {
        if(input('post.')){
            $validate = new Validate([
                'name'  => 'require|max:20|min:5',
                'password' => 'require|min:6|max:18'
            ]);
            if (!$validate->check(input('post.'))) {
                dump($validate->getError());
            }
        }else{
           return  view('login');
        }
    }
}

