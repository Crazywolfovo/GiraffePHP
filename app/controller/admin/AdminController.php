<?php
/**
    .-----------------------------------------------------------------------------------
    | Software: Giraffe Framework [Neck long to see far~！]
    | Version: 2017.2
    |-----------------------------------------------------------------------------------
    | Author: YZR <154966231@qq.com>
    | Copyright (c) 2017-Forever All Rights Reserved.
    |-----------------------------------------------------------------------------------
    | Discription:HomeController
    |-----------------------------------------------------------------------------------
*/

namespace app\controller\admin;

use giraffe\lib\controller\Controller;
use app\model\admin\Admin;
use giraffe\lib\http\Request;
use giraffe\lib\http\Response;
use giraffe\extend\Captcha;
use giraffe\functions\Common;

class AdminController extends Controller
{
    public function index()
    {
        if (!Common::islogin('admin_id')) {
           header("Location:showlogin");
        }
        $this->display('admin','index.tpl');
    }
    public function sysinfo()
    {
        if (!Common::islogin('admin_id')) {
            header("Location:showlogin");
        }
        $server = Request::server();
        $this->assign('',$server)->display('admin','sysinfo.tpl');
    }
    public function showlogin()
    {
        $this->display('admin','login.tpl');
    }
    public function login()
    {
        session_start();
        if (empty(Request::post('username'))) {
            exit(Common::show(0,'用户名不能为空'));
        }elseif(empty(Request::post('password'))){
            exit(Common::show(0,'密码不能为空'));
        }else{
            $username = addslashes(trim(Request::post('username')));
            $password = addslashes(trim(Request::post('password')));
            $res = Admin::judgelogin($username,$password);
            if ($res) {
                //dump($_SESSION);
                exit(Common::show(1,'登录成功'));
            }else{
                exit(Common::show(0,'用户名或者密码错误'));
            }
        }
    }
    public function logout()
    {
        Common::islogout('admin_id','admin_name','showlogin');
    }
}