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

namespace app\controller\home;

use giraffe\lib\controller\Controller;
use giraffe\lib\load\Register;

class HomeController extends Controller
{
    public function index()
    {
        $dbh = Register::get('dbh');
        //dump($dbh);
        //首页的所有数据，来自数据库
        $data= "这是一条测试数据，未来会来自数据库";
        //渲染数据到指定视图
        //$this->assign(array('data'=>$data))->display('home','index.html');
        $this->display('home','layout.tpl');
    }
    public function login()
    {
        # code...
    }
}