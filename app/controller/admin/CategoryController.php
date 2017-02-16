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
        $items = array(
                        array('id'=>1,'name'=>"衣服",'pid'=>0),
                        array('id'=>2,'name'=>"书籍",'pid'=>0),
                        array('id'=>3,'name'=>"T恤",'pid'=>1),
                        array('id'=>4,'name'=>"裤子",'pid'=>1),
                        array('id'=>5,'name'=>"鞋子",'pid'=>1),
                        array('id'=>6,'name'=>"皮鞋",'pid'=>5),
                        array('id'=>7,'name'=>"运动鞋",'pid'=>5),
                        array('id'=>8,'name'=>"耐克鞋",'pid'=>7),
                        array('id'=>9,'name'=>"耐克T恤",'pid'=>3),
                        array('id'=>10,'name'=>"鸿星尔克",'pid'=>7),
                        array('id'=>11,'name'=>"小说",'pid'=>2),
                        array('id'=>12,'name'=>"科幻小说",'pid'=>11),
                        array('id'=>13,'name'=>"古典名著",'pid'=>11),
                        array('id'=>14,'name'=>"文学",'pid'=>2),
                        array('id'=>15,'name'=>"四书五经",'pid'=>14)
                    );
        $tree = Tree::getOptions($items);
        //dump($tree);
        $this->assign('tree',$tree)->display('admin','showcate.tpl');
    }
    public function showaddcate()
    {
        $items = array(
                        array('id'=>1,'name'=>"衣服",'pid'=>0),
                        array('id'=>2,'name'=>"书籍",'pid'=>0),
                        array('id'=>3,'name'=>"T恤",'pid'=>1),
                        array('id'=>4,'name'=>"裤子",'pid'=>1),
                        array('id'=>5,'name'=>"鞋子",'pid'=>1),
                        array('id'=>6,'name'=>"皮鞋",'pid'=>5),
                        array('id'=>7,'name'=>"运动鞋",'pid'=>5),
                        array('id'=>8,'name'=>"耐克鞋",'pid'=>7),
                        array('id'=>9,'name'=>"耐克T恤",'pid'=>3),
                        array('id'=>10,'name'=>"鸿星尔克",'pid'=>7),
                        array('id'=>11,'name'=>"小说",'pid'=>2),
                        array('id'=>12,'name'=>"科幻小说",'pid'=>11),
                        array('id'=>13,'name'=>"古典名著",'pid'=>11),
                        array('id'=>14,'name'=>"文学",'pid'=>2),
                        array('id'=>15,'name'=>"四书五经",'pid'=>14)
                    );
        $tree = Tree::getOptions($items);
        // $server = Request::server();
        $this->assign('tree',$tree)->display('admin','addcate.tpl');
    }
    public function addcate()
    {
        $pid = Request::post('pid');
        $catename = Request::post('catename');
        if (!empty($pid) && !empty($catename)) {
            $res = Category::addChild($pid,$catename);
            if ($res) {
                Response::alert('添加成功~','/admin');
            }else{
                Response::alert('分类已经存在~','/admin');
            }
        }else{
            Response::alert('有数据为空~','/admin');
        }
    }
}