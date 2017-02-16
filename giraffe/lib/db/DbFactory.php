<?php
/**
    .-----------------------------------------------------------------------------------
    | Software: Giraffe Framework [Neck long to see far~！]
    | Version: 2017.2
    |-----------------------------------------------------------------------------------
    | Author: YZR <154966231@qq.com>
    | Copyright (c) 2017-Forever All Rights Reserved.
    |-----------------------------------------------------------------------------------
    | Discription:Class Fectory
    |-----------------------------------------------------------------------------------
*/
namespace giraffe\lib\db;
use \giraffe\lib\db\DataBase;
use giraffe\lib\load\Register as Register;

class DbFactory
{
    public static function createDB()
    {
        $dbh = DataBase::instance();
        Register::set('dbh',$dbh);
        return $dbh;
    }
}