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

use giraffe\lib\controller\Controller;
use app\model\admin\Category;
use giraffe\extend\Tree;
use giraffe\lib\http\Request;
use giraffe\lib\http\Response;

class CategoryController extends Controller
{
    public function showcate()
    {
        $items = Category::getData();
        //dump($items);exit();
        $tree = Tree::getOptions($items);
        //dump($tree);
        $this->assign('tree',$tree)->display('admin','showcate.tpl');
    }
    public function showaddcate()
    {
        $items = Category::getData();
        $tree = Tree::getOptions($items);
        // $server = Request::server();
        $this->assign('tree',$tree)->display('admin','addcate.tpl');
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
                Response::alert('删除失败~','/admin');
            }
        }else{
            Response::alert('分类名称不能为空~','/admin');
        }
    }
}