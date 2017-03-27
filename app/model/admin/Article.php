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

use giraffe\lib\model\Model;

class Article extends Model
{
    public static function getData()
    {
        return self::getdb()->select('*','mry_category','','fetchAll',\PDO::FETCH_ASSOC);
    }
    public static function getDataNum()
    {
        return self::getdb()->select('COUNT(article_id)','mry_article','','fetchColumn');
    }
    public static function getPageData($pageid,$pagesize)
    {
        $pageid = (intval($pageid)-1)*$pagesize;
        $condition = "true LIMIT $pageid,$pagesize";
        return self::getdb()->select('*','mry_article,mry_articlecontent',$condition,'fetchAll',\PDO::FETCH_ASSOC);
    }
    public static function showarts(){
        return self::getdb()->select('*','mry_article','','fetchAll',\PDO::FETCH_ASSOC);
    }
    public static function getart($id)
    {
        return self::getdb()->select('*',"mry_article,mry_articlecontent,mry_category","mry_article.article_id='$id' AND mry_article.article_id=mry_articlecontent.article_id AND mry_article.cate_id=mry_category.id",'fetch',\PDO::FETCH_ASSOC);
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
    public static function delart($article_id)
    {
               self::getdb()->delete('mry_articlecontent',"article_id='$article_id'");
        $res = self::getdb()->delete('mry_article',"article_id='$article_id'");
        if ($res) {
            return true;
        }else{
            return false;
        }
    }
    public static function updatearticle($arr = array())
    {
        //dump("content='".$arr['content']."'");exit();
        $subarr = array();
        $sqlstr = '';
        foreach ($arr as $key => $value) {
            if (!empty($value) && !is_null($value)) {
                $subarr[$key] = $value;
            }
        }
        $article_id = array_pop($subarr);
        $content = array_pop($subarr);
        foreach ($subarr as $key => $value) {
            $sqlstr.= $key.'='."'".$value."'".',';
        }
        $sqlstr = rtrim($sqlstr,',');
        $sqlstr2 = "content='".$arr['content']."'";
               self::getdb()->update('mry_article',$sqlstr,"article_id='$article_id'");
        return self::getdb()->update('mry_articlecontent',$sqlstr2,"article_id='$article_id'");
    }
}