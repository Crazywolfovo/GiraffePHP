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
use giraffe\extend\Tree;
use app\model\admin\Article;
use giraffe\lib\http\Request;
use giraffe\lib\http\Response;
use giraffe\extend\Upload;
use giraffe\functions\Common;

class ArticleController extends Controller
{
    public function showarticle()
    {
        if (!Common::islogin('admin_id')) {
            exit("您未，请先登录");
        }
         $items = Article::showarts();
        //dump($items);
        $this->assign('articlelist',$items)->display('admin','showarticle.tpl');
    }
    public function showaddarticle()
    {
        if (!Common::islogin('admin_id')) {
            exit("您未，请先登录");
        }
        $items = Article::getData();
        //dump($items);exit();
        $tree = Tree::getOptions($items);
        //dump($tree);
        $this->assign('tree',$tree)->display('admin','addarticle.tpl');
        //dump($_SERVER);
    }
    public function addthumb()
    {
        $upload = new Upload();
        $file = $upload->uploadfiles();
        if (!$file) {
            $upload->showerror();
        }else{
            foreach ($file as $uri) {
                echo ltrim($uri,'.');
            }
        }
    }
    public function addeditorpic()
    {
        $upload = new Upload();
        $file = $upload->uploadfiles();
        if (!$file) {
            echo json_encode(array('error' => 1, 'message' => '上传失败'));
        }else{
            foreach ($file as $uri) {
                echo json_encode(array('error' => 0, 'url' => ltrim($uri,'.')));
            }
        }
    }
    public function addarticle()
    {
        if (!empty($_POST)) {
            dump($_POST);
           $res = Article::addart($_POST['cate_id'],$_POST['title'],$_POST['smalltitle'],$_POST['author'],$_POST['thumbnail'],$_POST['keywords'],$_POST['discription'],$_POST['copyfrom'],$_POST['content']);
            if ($res) {
                Response::alert('添加成功~','/admin');
            }else{
                Response::alert('添加失败~','/admin');
            }
        }else{
            Response::alert('文章提交出错~','/admin');
        }
    }
    public function delarticle($article_id)
    {
        if (!empty($article_id)){
           $res = Category::delatr($article_id);
            if ($res) {
                Response::alert('删除成功~','/admin');
            }else{
                Response::alert('删除失败~','/admin');
            }
        }else{
            Response::alert('请选择要删除的文章~','/admin');
        }
    }
}