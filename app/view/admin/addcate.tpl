{extends file="layout.tpl"}
{block name="addcate"}
<div class="container">
    <div class="col-md-8 col-sm-offset-2">
        <form action="addcate" method="POST">
            <div class="form-group">
                <label for="pid">父级分类</label>
                <select class="form-control input-lg" id="pid" name="pid">
                    <option value="0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;添加顶级分类</option>
                {foreach $tree as $id => $value}
                    <option value="{$id}">{$value}</option>
                {foreachelse}
                    <option value="">获取数据失败</option>
                {/foreach}
                </select>
            </div>
            <div class="form-group">
                <label for="catename">分类名称</label>
                <input type="text" class="form-control input-lg" id="catename" placeholder="分类名称" name="catename">
            </div>
            <input class="btn btn-info" type="submit" value="Submit">
        </form>
    </div>
</div>
{/block}
