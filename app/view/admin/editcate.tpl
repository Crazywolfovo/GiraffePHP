{extends file="layout.tpl"}
{block name="editcate"}
<h1 class="col-md-8 col-sm-offset-2 text-center">分类管理</h1>
<div class="container">
    <form class="form-horizontal" action="addcate" method="POST">
      <div class="form-group">
        <label for="parentcate" class="col-sm-2 control-label">父级分类</label>
        <div class="col-sm-10">
           <select class="form-control" id="parentcate" name="pid">
                <option value="0">添加顶级分类</option>
            {foreach $tree as $value}
                <option value="{$value.id}">{$value.catename}</option>
            {foreachelse}
                <option value="">获取数据失败</option>
            {/foreach}
            </select>
        </div>
      </div>
      <div class="form-group">
        <label for="catename" class="col-sm-2 control-label">分类名称</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="catename" placeholder="分类名称" name="catename">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <input class="btn btn-info" type="submit" value="添加分类">
        </div>
      </div>
    </form>
</div>
{/block}
