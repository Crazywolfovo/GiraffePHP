<?php
/**
    .-----------------------------------------------------------------------------------
    | Software: Giraffe Framework [Neck long to see far~！]
    | Version: 2017.2
    |-----------------------------------------------------------------------------------
    | Author: YZR <154966231@qq.com>
    | Copyright (c) 2017-Forever All Rights Reserved.
    |-----------------------------------------------------------------------------------
    | Discription:Tree syruct for Infinite Classify
    |-----------------------------------------------------------------------------------
*/
namespace giraffe\extend;

class Tree
{
    /**
     * [getTree Recursive]
     * @param  array(array)  $items  [array from categorytable id pid name]
     * @param  integer $pid          [parentid]
     * @param  integer $dep          [deep]
     * @param  string  $prefix       [formate name ]
     * @return array(array)          [tree sturct categoryarray]
     */
    public static function getTree($items,$pid = 0,$dep = 1,$prefix = '')
    {
       $tree = [];
        foreach ($items as $item) {
            if ($item['pid'] == $pid) {
                /*add column(dep) for (array)item*/
                $item['dep'] = $dep;
                $item['name'] = str_repeat($prefix, $dep-1).$item['name'];
                /*get top cate from $items(pid = 0), push into $tree*/
                $tree[] = $item;
                $tree = array_merge($tree,self::getTree($items,$item['id'],$dep+1,$prefix));
            }
        }
        return $tree;
    }
    /**
     * [getOptions description]
     * @param  [array(array)] $data [return of getTree]
     * @return [array]              [先序遍历树的一维数组集]
     */
    public static function getOptions($data)
    {
        $options = [];
        foreach ($data as $cate) {
            $options[$cate['id']] = $cate['name'];
        }
        return $options;
    }
    /**
     * [subtree description]
     * @param  [type]  $arr    [description]
     * @param  integer $parent [description]
     * @return [type]          [description]
     */
    public static function subtree($arr,$parent=0){
        $task = array($parent);//创建任务表
        $subs = array();//存子孙栏目的数组
        while(!empty($task))//如果任务表不为空 就表示要做任务
        {
            $flag = false;//默认没找到子树
            foreach($arr as $k=>$v){
                 if($v['pid'] == $parent){
                        $subs [] = $v;
                        array_push($task,$v['id']);//借助栈 把新的地区的id压入栈
                        $parent = $v['id'];
                        unset($arr[$k]);//把找到的单元unset掉
                        $flag = true;
                 }
            }
            if(!$flag){//表示没找到子树
                array_pop($task);
                $parent = end($task);

            }
            /*echo '<pre>';
            print_r($task);
            echo '</pre>';*/
        }
        return $subs;
    }
    /**
     * [parenttree description]
     * @param  [type] $arr [description]
     * @param  [type] $id  [description]
     * @return [type]      [description]
     */
    public static function parenttree($arr,$id){
            $par_arr = array();
            //var_dump($id);
            while($id !== 0){//外层循环的作用：0表示最顶层的栏目 等于0就表示无父栏目/父父栏目 只要不等于0就表示有上级目录 则循环
             foreach($arr as $v){//内层循环的作用：遍历数组查找出来$id对应的值  若找到了  该值就是它自身(第一次就是它自己)和父栏目/父父栏目..然后存入数组并终止循环(break)
                   if($v['id'] == $id){
                       $par_arr[] = $v;
                       $id = $v['parent'];
                       break;
                   }
             }
            }
            return $par_arr;
    }
}