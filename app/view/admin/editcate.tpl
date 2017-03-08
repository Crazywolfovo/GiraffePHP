{extends file="layout.tpl"}
{block name="editcate"}
<h1 class="col-md-8 col-sm-offset-2 text-center">分类管理</h1>
<div class="container">
    <form class="form-horizontal" action="updatecate" method="POST">
      <div class="form-group">
        <label for="catename" class="col-sm-2 control-label">旧的分类名称</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" placeholder="{$child.catename}" disabled>
        </div>
      </div>
      <div class="form-group">
        <label for="parentcate" class="col-sm-2 control-label">新的父级分类</label>
        <div class="col-sm-10">
           <select class="form-control" id="parentcate" name="newpid">
                <option value="0">顶级分类</option>
            {foreach $tree as $value}
                <option value="{$value.id}">{$value.catename}</option>
            {foreachelse}
                <option value="">获取数据失败</option>
            {/foreach}
            </select>
        </div>
      </div>
      <div class="form-group">
        <label for="catename" class="col-sm-2 control-label">新的分类名称</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="newcatename" id="catename">
          <input type="hidden" class="form-control" name="id" value="{$child.id}">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <input class="btn btn-info" type="submit" value="提交修改">
        </div>
      </div>
    </form>
</div>
{/block}
