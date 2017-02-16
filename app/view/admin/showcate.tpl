{extends file="layout.tpl"}
{block name="showcate"}
<div class="container">
    <div class="col-md-8 col-sm-offset-2 text-center">
        <h1>分类管理</h1>
    </div>
    <table data-toggle="table">
        <thead>
            <tr><th>分类ID</th><th>分类名称</th><th>相关操作</th></tr>
        </thead>
        <tbody>
        {foreach $tree as $id => $value}
            <tr><td>{$id}</td><td>{$value}</td><td><a href="">编辑</a>&nbsp;&nbsp;<a href="">删除</a></td></tr>
        {/foreach}
        </tbody>
    </table>
</div>
{/block}
