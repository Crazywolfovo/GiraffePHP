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
use giraffe\extend\Tree;
use app\model\admin\Article;
use giraffe\lib\http\Request;
use giraffe\lib\http\Response;
use giraffe\extend\Upload;
use giraffe\functions\Common;

class ArticleController extends CommonController
{
    public function showarticle($pageid)
    {
         $articlenum = Article::getDataNum();
        //dump($articlenum);
        //$pageid=isset($_POST['pageid'])?$_POST['pageid']:1;
        $pagesize = 1;
        $pagenum = intval(ceil($articlenum/$pagesize));
        $items = Article::getPageData($pageid,$pagesize);

        //$items = Article::showarts();
        //dump($items);
        $this->assign('articlelist',$items)->assign('pagenum',$pagenum)->display('admin','showarticle.tpl');
    }
    public function showaddarticle()
    {
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
            //dump($_POST);
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
           $res = Article::delart($article_id);
            if ($res) {
                Response::alert('删除成功~','/admin');
            }else{
                Response::alert('删除失败~','/admin');
            }
        }else{
            Response::alert('请选择要删除的文章~','/admin');
        }
    }
    public function showeditart($id)
    {
        $items = Article::getData();
        $tree = Tree::getOptions($items);
        $artinfo = Article::getart($id);
        //dump($artinfo);exit();
        $this->assign('tree',$tree)->assign('artinfo',$artinfo)->display('admin','editarticle.tpl');
    }
    public function updateart()
    {
        $res = Article::updatearticle($_POST);
        if ($res) {
            Response::alert('修改成功~','/admin');
        }else{
            Response::alert('修改失败~','/admin');
        }
    }
}