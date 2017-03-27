<?php
/**
    .-----------------------------------------------------------------------------------
    | Software: Giraffe Framework [Neck long to see far~！]
    | Version: 2017.2
    |-----------------------------------------------------------------------------------
    | Author: YZR <154966231@qq.com>
    | Copyright (c) 2017-Forever All Rights Reserved.
    |-----------------------------------------------------------------------------------
    | Discription:Base model class
    |-----------------------------------------------------------------------------------
*/
namespace giraffe\lib\model;

use giraffe\lib\load\Register;

class Model
{
    protected static function getdb()
    {
        return Register::get('dbh');
    }
}


