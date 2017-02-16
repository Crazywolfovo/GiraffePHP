<?php
/**
    .-----------------------------------------------------------------------------------
    | Software: Giraffe Framework [Neck long to see far~！]
    | Version: 2017.2
    |-----------------------------------------------------------------------------------
    | Author: YZR <154966231@qq.com>
    | Copyright (c) 2017-Forever All Rights Reserved.
    |-----------------------------------------------------------------------------------
    | Discription:load the configs from outside
    |-----------------------------------------------------------------------------------
*/
namespace giraffe\lib\load;


class ConfLoad
{
    public static $conf = array();
    /**
     * Get one line config
     * @param  string $value config option name
     * @param  string $file  config file name
     * @return mix
     */
    public static function getoneline($name,$file='conf')
    {
        if (isset(self::$conf[$file][$name])) {
            return self::$conf[$file][$name];
        }else{
            $conf = GIRAFFEPHP.DS.'config'.DS.$file.'.php';
            if (is_file($conf)) {
                self::$conf[$file] = include $conf;
                return isset(self::$conf[$file][$name])?self::$conf[$file][$name]:false;
            }else{
                return false;
            }
        }
    }
    /**
     * Get one line config
     * @param  string $file  config file name
     * @return mix
     */
    public static function getallline($file)
    {
        if (isset(self::$conf[$file])) {
            return self::$conf[$file];
        }else{
            $conf = GIRAFFEPHP.DS.'config'.DS.$file.'.php';
            if (is_file($conf)) {
                self::$conf[$file] = include $conf;
                return self::$conf[$file];
            }else{
                return false;
            }
        }
    }
}