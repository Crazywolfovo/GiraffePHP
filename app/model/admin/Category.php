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
/**
*
*/
namespace app\model\admin;

use giraffe\lib\model\Model;

class Category extends Model
{
    public static function getData()
    {
        return self::getdb()->select('*','mry_category','','fetchAll',\PDO::FETCH_ASSOC);
    }
    public static function getDataNum()
    {
        return self::getdb()->select('COUNT(id)','mry_category','','fetchColumn');
    }
    public static function getPageData($pageid,$pagesize)
    {
        $pageid = (intval($pageid)-1)*$pagesize;
        $condition = "true LIMIT $pageid,$pagesize";
        return self::getdb()->select('*','mry_category',$condition,'fetchAll',\PDO::FETCH_ASSOC);
    }
    public static function getChild($id)
    {
        return self::getdb()->select('*','mry_category',"id='$id'",'fetch',\PDO::FETCH_ASSOC);
    }
    public static function addChild($pid,$catename)
    {
                $resnum = self::getdb()->select('COUNT(id)','mry_category',"pid=$pid AND catename='$catename'",'fetchColumn');
                if (!$resnum) {
                    return self::getdb()->insert("mry_category(catename,pid)","('$catename',$pid)");
                }else{
                    return false;
                }
    }
    public static function delChild($id)
    {
        $res = self::getdb()->select('COUNT(article_id)','mry_article',"cate_id='$id'",'fetchColumn');
        if ($res) {
            return false;
        }else{
            return self::getdb()->delete('mry_category',"id='$id' OR pid='$id'");
        }
    }
    /**
     * 修改分类
     * @return [type] [description]
     */
    public static function updateChild($id,$newpid,$newcatename)
    {
        $cateinfo = self::getChild($id);
        $res1 = true;
        $res2 = true;
        if ($newpid !== $cateinfo['pid']) {
            $res1 = self::moveChild($id,$newpid);
        }
        if (!empty($newcatename)) {
            $res2 = self::changeCateName($id,$newcatename);
        }
        if ($res1 && $res2) {
            return true;
        }else{
            return false;
        }
    }
    /**
     * 移动分类到其他分类下
     */
    private static function moveChild($id,$newpid)
    {
        return self::getdb()->update("mry_category","pid='$newpid'","id='$id'");
    }
    /**
     * 更新分类命名称
     */
    private static function changeCateName($id,$newcatename)
    {
        return self::getdb()->update("mry_category","catename='$newcatename'","id='$id'");
    }
}