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
namespace giraffe\function;
class Common{
    /**
     * 自定义实现json_encode功能的函数
     * @param mixed $data
     */
    static public function onmpw_json_encode($data){
        if(is_object($data)) return false;
        if(is_array($data)){
            $data = self::deal_array($data);
        }
        //return urldecode(json_encode($data));
        return urldecode(json_encode($data));
    }
    static private function deal_array($data){
        if (is_array($data)) {
            foreach ($data as $key => $val) {
                if (is_array($val)) {
                    $data[$key] = self::deal_array($val);
                } else {
                    $data[$key] = urlencode($val);
                }
            }
        } elseif (is_string($data)) {
            $data = urlencode($data);
        }
        return $data;
    }

    /**
     * [printer description]
     * @param  [type] $param [description]
     * @return [type]        [description]
     */
    public static function printer($param)
    {
        if (is_bool($param)) {
            var_dump($param);
        }elseif (is_null($param)) {
            var_dump(NULL);
        }else{
            echo "<pre style='position:relative;z-index:1000;padding:10px;border-radius:5px;background:#f5f5f5;border:1px solid #aaa;font-size:14px;line-height:18px;opacity:0.9;'>".print_r($param,true)."</pre>";
        }
    }
}
