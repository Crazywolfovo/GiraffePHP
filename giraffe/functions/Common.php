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
namespace giraffe\functions;
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
    private static  function deal_array($data){
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
    public static function show($status,$message)
    {
        $result = array('status'=>$status,
                        'message'=>$message);
        return json_encode($result);
    }
    public static function islogin($id = "")
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (empty($_SESSION) || empty($_SESSION[$id])) {
            return false;
        }else{
            return true;
        }
    }
    public static function islogout($sessid,$sessname,$url)
    {
        if(!isset($_SESSION)) {
             session_start();
        }
        if(!empty($_SESSION) && !empty($_SESSION[$sessid]) && !empty($_SESSION[$sessname])) {
            unset($_SESSION[$sessid]);
            unset($_SESSION[$sessname]);
            session_destroy();
            header("location:$url");
        }else{
            header("location:$url");
        }
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
