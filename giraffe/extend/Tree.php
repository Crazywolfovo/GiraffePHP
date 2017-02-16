<?php
/**
    .-----------------------------------------------------------------------------------
    | Software: Giraffe Framework [Neck long to see far~！]
    | Version: 2017.2
    |-----------------------------------------------------------------------------------
    | Author: YZR <154966231@qq.com>
    | Copyright (c) 2017-Forever All Rights Reserved.
    |-----------------------------------------------------------------------------------
    | Discription:Tree struct for Infinite Classify
    |-----------------------------------------------------------------------------------
*/
namespace giraffe\extend;

class Tree
{
    private static $config = [
        'id'   => 'id',
        'name' => 'name',
        'pid'  => 'pid'
        ];

/*
*|-----------------------------------------------------------------------------------
*| Discription:Method of Recursive;
*|-----------------------------------------------------------------------------------
*/
    /**
     * [getTreeRec Recursive]
     * @param  array(array)  $items  [array from categorytable id pid name]
     * @param  integer $pid          [parentid]
     * @param  integer $dep          [deep]
     * @param  string  $prefix       [formate name ]
     * @return array(array)          [tree sturct categoryarray]
     */
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
/*
*|-----------------------------------------------------------------------------------
*| Discription:Method of Iteration;
*|-----------------------------------------------------------------------------------
*/
    /**
     * [getTreeIter description]
     * @param  [type]  $arr    [description]
     * @param  integer $parent [description]
     * @return [type]          [description]
     */
    public static function getTreeIter($arr,$parent=0){
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
            // echo '<pre>';
            // print_r($subs);
            // echo '</pre>';
        }
        return $subs;
    }
    /**
     * [getParent count(getParent($tree,$id)) = deep]
     * @param  [array] $arr [description]
     * @param  [int] $id  [description]
     * @return [array]      [description]
     */
    public static function getParent($arr,$id){
        $par_arr = array();
        //var_dump($id);
        while($id !== 0){//外层循环的作用：0表示最顶层的栏目 等于0就表示无父栏目/父父栏目 只要不等于0就表示有上级目录 则循环
         foreach($arr as $v){//内层循环的作用：遍历数组查找出来$id对应的值  若找到了  该值就是它自身(第一次就是它自己)和父栏目/父父栏目..然后存入数组并终止循环(break)
               if($v['id'] == $id){
                   $par_arr[] = $v;
                   $id = $v['pid'];
                   break;
               }
            }
        }
        return $par_arr;
    }
    public static function getChild($arr,$id=0){
        //根据parent的值找儿子
        $son=array();
        foreach($arr as $v){
            if($v['pid']==$id){
                $son[]=$v;
            }
        }
        return $son;
    }
/*
*|-----------------------------------------------------------------------------------
*| Discription:Method of Helper;
*|-----------------------------------------------------------------------------------
*/
    {
        $tree = [];
        $dep = 1;
        $pre = [0=>1];
        while ($val = current($data)) {
            $key = key($data);
            if ($key>0) {
                if ($data[$key - 1]['pid'] !== $val['pid']) {
                    $dep++;
                }
            }
            if (array_key_exists($val['pid'], $pre)) {
                $dep = $pre[$val['pid']];
            }
            $val['name'] = str_repeat($prefix, $dep-1).$val['name'];
            $pre[$val['pid']] = $dep;
            $tree[] = $val;
            next($data);
        }
        return $tree;
    }
    /**
     * [getOptions description]
     * @param  [array(array)] $data [return of getTree]
     * @return [array]              [先序遍历树的一维数组集]
     */
    public static function getOptions($data,$method,$prefix = '...')
    {
        if ($method == 'getTreeIter') {
            $tree = self::getTreeIter($data);
            $tree = self::setPrefix($tree,$prefix);
        }else{
            $tree = self::getTreeRec($data,0,1,$prefix);
        }
        $options = [];
        foreach ($tree as $cate) {
            $options[$cate['id']] = $cate['name'];
        }
        return $options;
    }
}