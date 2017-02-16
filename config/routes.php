<?php
/**
    .-----------------------------------------------------------------------------------
    | Software: Giraffe Framework [Neck long to see far~！]
    | Version: 2017.2
    |-----------------------------------------------------------------------------------
    | Author: YZR <154966231@qq.com>
    | Copyright (c) 2017-Forever All Rights Reserved.
    |-----------------------------------------------------------------------------------
    | Discription:Routing Config
    |-----------------------------------------------------------------------------------
*/
/**
 * 加载路由配置
 * 实例化控制器,然后调用控制器方法也被调用了
 */
\giraffe\lib\route\Router::get('/','app\controller\home\HomeController@index');
\giraffe\lib\route\Router::get('home','app\controller\home\HomeController@index');
\giraffe\lib\route\Router::get('admin','app\controller\admin\AdminController@index');
\giraffe\lib\route\Router::get('admin/sysinfo','app\controller\admin\AdminController@sysinfo');
\giraffe\lib\route\Router::get('admin/category','app\controller\admin\CategoryController@showlist');
\giraffe\lib\route\Router::dispatch();