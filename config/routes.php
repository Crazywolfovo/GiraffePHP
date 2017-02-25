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
Router::get('showlogin','app\controller\admin\AdminController@showlogin');
Router::any('showlogin/login','app\controller\admin\AdminController@login');
Router::get('admin','app\controller\admin\AdminController@index');
Router::any('logout','app\controller\admin\AdminController@logout');
Router::any('admin/redirect','app\controller\admin\AdminController@redirect');
Router::get('admin/sysinfo','app\controller\admin\AdminController@sysinfo');
Router::get('admin/showcate','app\controller\admin\CategoryController@showcate');
Router::get('admin/showaddcate','app\controller\admin\CategoryController@showaddcate');
Router::any('admin/addcate','app\controller\admin\CategoryController@addcate');
Router::any('admin/delcate/(:num)','app\controller\admin\CategoryController@delcate');
Router::get('admin/showarticle','app\controller\admin\ArticleController@showarticle');
Router::get('admin/showaddarticle','app\controller\admin\ArticleController@showaddarticle');
Router::any('admin/addarticle','app\controller\admin\ArticleController@addarticle');
Router::any('admin/delarticle/(:num)','app\controller\admin\ArticleController@delarticle');
Router::any('admin/addthumb','app\controller\admin\ArticleController@addthumb');
Router::any('admin/addeditorpic','app\controller\admin\ArticleController@addeditorpic');
Router::dispatch();