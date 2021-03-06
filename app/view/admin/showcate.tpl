{extends file="layout.tpl"}
{block name="showcate"}
<div class="container">
    <!-- <div class="col-md-8 col-sm-offset-2 text-center"> -->
        <h1 class="col-md-8 col-sm-offset-2 text-center">分类管理</h1>
        <!-- data-toggle="table" -->
    <!-- </div> -->
    <table class="table table-bordered">
        <thead>
            <tr><th class="text-center">分类ID</th><th class="text-center">分类名称</th><th class="text-center">层级深度</th><th class="text-center">相关操作</th></tr>
        </thead>
        <tbody>
        {foreach $tree as $item}
            <tr><td class="text-center">{$item.id}</td><td>{$item.catename}</td><td class="text-center">{$item.dep}</td><td class="text-center"><a class="btn btn-info btn-xs" href="showeditcate/{$item.id}">编辑</a>&nbsp;&nbsp;<a class="btn btn-info btn-xs" href="delcate/{$item.id}">删除</a></td></tr>
        {/foreach}
        </tbody>
    </table>
    <!-- <a href="1">1</a>
    <a href="2">2</a> -->
    <div class="container">
        <a  class="btn btn-info" role="button" href="1">首页</a>
    {for $page=1 to $pagenum}
        <a class="btn btn-info" role="button" href="{$page}">{$page}</a>
    {/for}
        <a class="btn btn-info" role="button" href="{$pagenum}">尾页</a>
    </div>
</div>
{/block}
