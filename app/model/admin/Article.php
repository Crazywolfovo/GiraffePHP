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
class Article
{
    private static $db;
    private static function getdb()
    {
        return self::$db = Register::get('dbh');
    }
    public static function getData()
    {
        return self::getdb()->select('*','mry_category','','fetchAll',\PDO::FETCH_ASSOC);
    }
    public static function showarts(){
        return self::getdb()->select('*','mry_article','','fetchAll',\PDO::FETCH_ASSOC);
    }
    public static function addart($cate_id,$title,$smalltitle,$author,$thumbnail,$keywords,$discription,$copyfrom,$content)
    {
        $resnum = self::getdb()->select('COUNT(article_id)','mry_article',"cate_id='$cate_id' AND title='$title'",'fetchColumn');
        if (!$resnum) {
            $create_time = time();
            $update_time = $create_time;
            $a = self::getdb()->insert("mry_article(cate_id,title,small_title,author,thumbnail,keywords,discription,copyfrom,create_time,update_time)","('$cate_id','$title','$smalltitle','$author','$thumbnail','$keywords','$discription','$copyfrom','$create_time','$update_time')");
            if ($a) {
                $art_id = self::getdb()->select('article_id','mry_article',"cate_id='$cate_id' AND title='$title'",'fetchColumn');
                return self::getdb()->insert("mry_articlecontent(article_id,content,create_time,update_time)","('$art_id','$content','$update_time','$update_time')");
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}