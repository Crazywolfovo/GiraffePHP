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
use giraffe\lib\route\Router;
Router::get('/','app\controller\home\HomeController@index');
Router::get('home','app\controller\home\HomeController@index');
Router::get('admin','app\controller\admin\AdminController@index');
Router::get('admin/sysinfo','app\controller\admin\AdminController@sysinfo');
Router::get('admin/showcate','app\controller\admin\CategoryController@showcate');
Router::get('admin/showaddcate','app\controller\admin\CategoryController@showaddcate');
Router::any('admin/addcate','app\controller\admin\CategoryController@addcate');
Router::any('admin/delcate/(:num)','app\controller\admin\CategoryController@delcate');
Router::dispatch();