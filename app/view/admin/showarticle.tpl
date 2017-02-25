{extends file="layout.tpl"}
{block name="showarticle"}
<div class="container">
    <!-- <div class="col-md-8 col-sm-offset-2 text-center"> -->
        <h1 class="col-md-8 col-sm-offset-2 text-center">显示文章列表</h1>
        <!-- data-toggle="table" -->
    <!-- </div> -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center">文章ID</th>
                <th class="text-center">分类ID</th>
                <th class="text-center">文章标题</th>
                <th class="text-center">作者</th>
                <th class="text-center">略缩图</th>
                <th class="text-center">文章来源</th>
                <th class="text-center">创建时间</th>
                <th class="text-center">修改时间</th>
                <th class="text-center">相关操作</th>
            </tr>
        </thead>
        <tbody>
        {foreach $articlelist as $item}
            <tr>
                <td class="text-center">{$item.article_id}</td>
                <td class="text-center">{$item.cate_id}</td>
                <td class="text-center">{$item.title}</td>
                <td class="text-center">{$item.author}</td>
                <td class="col-sm-2" class="text-center"><img  style="margin:0 auto; width: 20%;height: auto;display: block;overflow: hidden;" src="{$item.thumbnail}"></td>
                <td class="text-center">{$item.copyfrom}</td>
                <td class="text-center">{'Y-m-d H:i:s'|date:$item.create_time}</td>
                <td class="text-center">{'Y-m-d H:i:s'|date:$item.update_time}</td>
                <td class="text-center"><a class="btn btn-info btn-xs" href="">编辑</a>&nbsp;&nbsp;<a class="btn btn-info btn-xs" href="delarticle/{$item.article_id}">删除</a></td>
            </tr>
        {/foreach}
        </tbody>
    </table>
</div>
{/block}