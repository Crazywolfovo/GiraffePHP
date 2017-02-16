<?php
/**
    .-----------------------------------------------------------------------------------
    | Software: Giraffe framework [Neck long to see far!]
    | Version: 2017.2
    |-----------------------------------------------------------------------------------
    | Author: YZR <154966231@qq.com>
    | Copyright (c) 2017-Forever All Rights Reserved.
    |-----------------------------------------------------------------------------------
    | Discription:Bootstrap:定义常量->初始化组件->导入路由->启动框架;
    |-----------------------------------------------------------------------------------
 */

/**
 *VERSION
 */
define('GIRAFFE_VERSION', '1.0.0');

/**
 * FRAMEWORK CORE PATH
 */
define('CORE', GIRAFFEPHP.DS.'giraffe'.DS);
define('APP', GIRAFFEPHP.DS.'app'.DS);

/**
 * 引入composer自动加载类,自定义PSR-4自动加载生效
 */
require GIRAFFEPHP.DS.'vendor/autoload.php';

/**
 * TIMEZONE
 */
date_default_timezone_set('PRC');
define('TIME', $_SERVER['REQUEST_TIME']);

/**
 * DEBUG
 */
define('DEBUG',true);

if (DEBUG && PHP_SAPI !== 'cli') {
    //take on display_errors
    ini_set('display_errors', true);
    //load friendly error class
    $whoops = new \Whoops\Run;
    $errorPage = new \Whoops\Handler\PrettyPageHandler;
    $errorPage->setPageTitle("Giraffe is unhappy~~~！！！");
    $whoops->pushHandler($errorPage);
    $whoops->register();
}else{
    //take off display_errors
    ini_set('display_errors', false);
}

/**
 * Initialize DBEngine(or ORM)
 */
$dbh = \giraffe\lib\db\DataBase::instance();
       \giraffe\lib\load\Register::set('dbh',$dbh);

/**
 * Initialize ViewEngine
 * Basecontroller get ViewEngine
 */
define('VIEW', APP.'view'.DS);
define('TEMP_COMPILE', GIRAFFEPHP.DS.'cache'.DS.'template_compile'.DS);
$smarty = new \Smarty();
$smarty->left_delimiter = "{";
$smarty->right_delimiter = "}";
$smarty->setCompileDir(TEMP_COMPILE);
$smarty->caching = false;
\giraffe\lib\controller\Controller::getViewEngine($smarty);


/**
 * Require Routing
 */
require GIRAFFEPHP.DS.'config'.DS.'routes.php';


