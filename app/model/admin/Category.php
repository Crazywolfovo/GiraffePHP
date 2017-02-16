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
use giraffe\lib\load\Register;
class Category
{
    private static $db;
    /**
     * 增加子栏目
     */
    private static function getdb()
    {
        return self::$db = Register::get('dbh');
    }
    public static function addChild($pid,$catename){
                $resnum = self::getdb()->select('COUNT(id)','mry_category',"pid=$pid AND catename='$catename'",'fetchColumn');
                if (!$resnum) {
                    return self::getdb()->insert("mry_category(catename,pid)","('$catename',$pid)");
                }else{
                    return false;
                }
    }
    /**
     * 删除栏目
     */
    public function del(){
        $id = $_POST['id'];
        $stack = array($id);
        $ids = array();
        while(count($stack)>0){
            $id = array_pop($stack);
            array_push($ids,$id);
            $res = $this->db->table('channel')->field('id')->where('parId='.$id)->select();
            if(count($res)>0){
                for($i=0;$i<count($res);$i++){
                    array_push($stack,$res[$i]['id']);
                }
            }
        }
        $res = $this->db->table('channel')->where('id in ('.implode(',', $ids).')')->delete();
        if($res){
            echo json_encode($ids);
        }else{
            echo 0;
        }
    }
    /**
     * 更新栏目
     */
    public function update(){
        $id = $_POST['id'];
        $typename = $_POST['typename'];
        $res = $this->db->table('channel')->where('id='.$id)->update(array('name'=>$typename));
        if($res){
            echo json_encode(array('res'=>1));
        }else{
            echo json_encode(array('res'=>0));
        }
        return ;
    }
    /**
     * 移动栏目
     */
    public function move(){
        $parid = $_POST['parId'];
        $id = $_POST['id'];
        //首先查找当前要移动的栏目的父id 是否和要移动到栏目的子栏目的id是否相等
        $ids = $this->db->table('channel')->field('parId')->where('id='.$id)->find();
        if($ids['parId'] == $parid){
            echo json_encode(array('res'=>1));
            return ;
        }

        $res = $this->db->table('channel')->where('id='.$id)->update(array('parId'=>$parid));
        if($res){
            echo json_encode(array('res'=>1));
        }else{
            echo json_encode(array('res'=>0));
        }
    }
}