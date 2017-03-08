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

class AdminController extends CommonController
{
    public function index()
    {
        $this->display('admin','index.tpl');
    }
    public function sysinfo()
    {
        $server = Request::server();
        $this->assign('',$server)->display('admin','sysinfo.tpl');
    }
    public function logout()
    {
        Common::islogout('admin_id','admin_name','showlogin');
    }
}