<?php
/**
    .-----------------------------------------------------------------------------------
    | Software: Giraffe Framework [Neck long to see far~！]
    | Version: 2017.2
    |-----------------------------------------------------------------------------------
    | Author: YZR <154966231@qq.com>
    | Copyright (c) 2017-Forever All Rights Reserved.
    |-----------------------------------------------------------------------------------
    | Discription:
    |-----------------------------------------------------------------------------------
*/
namespace app\controller\admin;
use giraffe\lib\controller\Controller;
use giraffe\functions\Common;

class CommonController extends Controller
{

    public function __construct()
    {
        if (!Common::islogin('admin_id')) {
           exit("请先登录~~~");
        }
    }
}