<?php
/**
 * Created by PhpStorm.
 * User: 黄明照
 * Date: 2018/4/11
 * Time: 23:35
 */

namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Request;

class BaseController extends  Controller
{
     function __construct(Request $request)
    {

        //todo::检查登陆状态
        //获取user_token

        if($_COOKIE['user_info']['token']){
          $user_token=Db::name('user')->where('name','=',$_COOKIE['user_info']['username'])->find()['user_token'];
          if(!$user_token){
              if($request->controller()!='Login'){
                  $this->error('登陆状态失效','/index/login');
              }
          }
           if($user_token != $_COOKIE['user_info']['token']) {
               if($request->controller()!='Login'){
                   $this->error('登陆状态失效','/index/login');
               }
           }
        }else{
            if($request->controller()!='Login'){
                $this->error('登陆状态失效','/index/login');
            }
        }

    }

}