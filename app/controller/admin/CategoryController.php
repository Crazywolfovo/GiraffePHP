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

class CategoryController extends Controller
{
    public function showlist()
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

        $a = Tree::getTree($items,0,1,'...');
        $d = Tree::subtree($items);
        dump($a);
        dump($d);
      
        //$b = Tree::setPrefix($a);
        //dump($b);
        $c = Tree::getOptions($a);
        //dump($c);
         echo "<select>";
        foreach ($c as $key => $value) {
            echo "<option value=".$key.">$value</option>";
        }
        echo "</select>";
        //$this->display('admin','index.tpl');
    }
    public function changeitem()
    {
        // $server = Request::server();
        // $this->assign('',$server)->display('admin','sysinfo.tpl');
    }
}