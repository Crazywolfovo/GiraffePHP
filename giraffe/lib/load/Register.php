<?php
/**
    .-----------------------------------------------------------------------------------
    | Software: Giraffe Framework [Neck long to see far~！]
    | Version: 2017.2
    |-----------------------------------------------------------------------------------
    | Author: YZR <154966231@qq.com>
    | Copyright (c) 2017-Forever All Rights Reserved.
    |-----------------------------------------------------------------------------------
    | Discription: Class registe tree
    |-----------------------------------------------------------------------------------
*/
namespace giraffe\lib\load;

class Register
{
    protected static $object;

    public static function set($alias,$object)
    {
        self::$object[$alias] = $object;
    }
    public static function get($alias)
    {
        return self::$object[$alias];
    }
    public static function _unset($alias)
    {
        unset(self::$object[$alias]);
    }
}