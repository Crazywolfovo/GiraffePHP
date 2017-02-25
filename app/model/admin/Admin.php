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
namespace app\model\admin;
use giraffe\lib\load\Register;
class Admin
{
    private static function getdb()
    {
        return Register::get('dbh');
    }
    public static function judgelogin($username,$password)
    {
        $pseed='Thd0076';
        $password = md5(md5($password).$pseed);
        $result = self::getdb()->select("admin_id","mry_admin","username='$username' AND password='$password'","fetchColumn");
        if ($result) {
            $_SESSION['admin_name'] = $username;
            $_SESSION['admin_id'] = $result;
            return true;
        }else{
            return false;
        }
    }
}