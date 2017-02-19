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
use giraffe\lib\http\Request;
use giraffe\lib\http\Response;

class ArticleController extends Controller
{
    public function showaddarticle()
    {
        $this->display('admin','addarticle.tpl');
    }
}