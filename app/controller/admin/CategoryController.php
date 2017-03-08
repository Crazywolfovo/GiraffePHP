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
namespace app\controller\admin;
use app\model\admin\Category;
use giraffe\extend\Tree;
use giraffe\lib\http\Request;
use giraffe\lib\http\Response;
use giraffe\functions\Common;

class CategoryController extends CommonController
{
    public function showcate($pageid)
    {
        //dump($_POST);
        //$catenum = count(Category::getData());
        $catenum = Category::getDataNum();
        //dump($catenum);
        //$pageid=isset($_POST['pageid'])?$_POST['pageid']:1;
        $pagesize = 2;
        $pagenum = intval(ceil($catenum/$pagesize));
        $items = Category::getPageData($pageid,$pagesize);
        //$items = Category::getData();
        //dump($items);exit();
        $tree = Tree::getOptions($items);
        //dump($tree);
        $this->assign('tree',$tree)->assign('pagenum',$pagenum)->display('admin','showcate.tpl');
    }
    public function showaddcate()
    {
        $items = Category::getData();
        $tree = Tree::getOptions($items);
        // $server = Request::server();
        $this->assign('tree',$tree)->display('admin','addcate.tpl');
    }
    public function showeditcate($id)
    {
        $items = Category::getData();
        $tree = Tree::getOptions($items);
        $child = Category::getChild($id);
        //dump($child);
        $this->assign('tree',$tree)->assign('child',$child)->display('admin','editcate.tpl');
    }
    public function updatecate()
    {
        $id = Request::post('id');
        $newpid = Request::post('newpid');
        $newcatename = Request::post('newcatename');
        $res = Category::updateChild($id,$newpid,$newcatename);
        if ($res) {
            Response::alert('修改成功~','/admin');
        }else{
            Response::alert('修改失败~','/admin');
        }
    }
    public function addcate()
    {
        $pid = Request::post('pid');
        $catename = Request::post('catename');
        if (!empty($catename)) {
            $res = Category::addChild($pid,$catename);
            if ($res) {
                Response::alert('添加成功~','/admin');
            }else{
                Response::alert('分类已经存在~','/admin');
            }
        }else{
            Response::alert('分类名称不能为空~','/admin');
        }
    }
    public function delcate($id){
        if (!empty($id)) {
           $res = Category::delChild($id);
            if ($res) {
                Response::alert('删除成功~','/admin');
            }else{
                Response::alert('删除失败,请检查该分类下是是否还有文章~','/admin');
            }
        }else{
            Response::alert('分类名称不能为空~','/admin');
        }
    }
}