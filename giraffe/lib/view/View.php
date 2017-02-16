<?php
/**
    .-----------------------------------------------------------------------------------
    | Software: Giraffe Framework [Neck long to see far~！]
    | Version: 2017.2
    |-----------------------------------------------------------------------------------
    | Author: YZR <154966231@qq.com>
    | Copyright (c) 2017-Forever All Rights Reserved.
    |-----------------------------------------------------------------------------------
    | discription:ViewClass
    |-----------------------------------------------------------------------------------
*/
namespace giraffe\lib\view;

trait View
{
    protected static $view;
    //methods about view
    public static function getViewEngine($engine)
    {
        self::$view = $engine;
    }
    protected function assign($varname = '',$var)
    {
        if (!empty($varname)) {
            $varname = trim($varname);
            self::$view->assign($varname,$var);
        }else{
            self::$view->assign($var);
        }
        return $this;
    }
    protected function display($module,$file)
    {
        //deal path
        $template_dir = VIEW.$module.DS;
        $path = $template_dir.$file;
        //set template_dir
        self::$view->setTemplateDir($template_dir);
        //render data
        if (is_file($path)) {
            self::$view->display($path);
        }else{
             if (DEBUG) {
                throw new \Exception($file . ' is not exit~~~!');
            }else{
                echo "404";
            }
        }
    }
}