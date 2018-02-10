<?php
namespace app\index\controller;

class Index

{
    public function index()
    {
        return view('index');
    }
    public function welcome()
    {
        return view('welcome');
    }
    public function tel(){
        $tel=$_GET['tel'];
        $cmd="adb shell am start -a android.intent.action.CALL tel:$tel
start http://www.mytest.com/public/index/index/deletebat
exit

 ";
       file_put_contents(ROOT_PATH.'adb/tel.bat',$cmd);
       echo '保存bat成功,等待系统自动执行';
    }
    public function deletebat(){
        file_put_contents(ROOT_PATH.'adb/tel.bat','exit');
        echo '删除bat成功！';
    }

}
