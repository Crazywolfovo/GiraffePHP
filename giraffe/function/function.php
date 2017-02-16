<?php
/**
    .-----------------------------------------------------------------------------------
    | Software: Giraffe Framework [Neck long to see far~！]
    | Version: 2017.2
    |-----------------------------------------------------------------------------------
    | Author: YZR <154966231@qq.com>
    | Copyright (c) 2017-Forever All Rights Reserved.
    |-----------------------------------------------------------------------------------
    | Discription:Define Publice Functions
    |-----------------------------------------------------------------------------------
*/

function printer($param)
{
    if (is_bool($param)) {
        var_dump($param);
    }elseif (is_null($param)) {
        var_dump(NULL);
    }else{
        echo "<pre style='position:relative;z-index:1000;padding:10px;border-radius:5px;background:#f5f5f5;border:1px solid #aaa;font-size:14px;line-height:18px;opacity:0.9;'>".print_r($param,true)."</pre>";
    }
}