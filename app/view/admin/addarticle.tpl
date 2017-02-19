{extends file="layout.tpl"}
{block name="addarticle"}
<script src="/static/vendor/kindeditor/kindeditor-all-min.js"></script>
<script src="/static/vendor/kindeditor/lang/zh-CN.js"></script>
<div class="container">
    <form class="form-horizontal">
      <div class="form-group">
        <label for="title" class="col-sm-2 control-label">文章标题</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="title" placeholder="Title">
        </div>
      </div>
      <div class="form-group">
        <label for="small_title" class="col-sm-2 control-label">文章短标题</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="small_title" placeholder="SmallTitle">
        </div>
      </div>
      <div class="form-group">
        <label for="file_upload" class="col-sm-2 control-label">文章略缩图</label>
        <div class="col-sm-10">
            <input type="file" id="file_upload" multiple="true" >
            <img style="display: none" id="upload_org_code_img" src="" width="150" height="150">
            <input id="file_upload_image" name="thumb" type="hidden" multiple="true" value="">
        </div>
      </div>
      <div class="form-group">
        <label for="cate" class="col-sm-2 control-label">所属分类</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="cate" placeholder="Category">
        </div>
      </div>
      <div class="form-group">
        <label for="copyfrom" class="col-sm-2 control-label">文章来源</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="copyfrom" placeholder="Resource">
        </div>
      </div>
       <div class="form-group">
        <label for="content" class="col-sm-2 control-label">文章内容</label>
        <div class="col-sm-10">
          <textarea name="content" id="editor_id" class="form-control"></textarea>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <input class="btn btn-info" type="submit" value="添加文章">
        </div>
      </div>
    </form>
</div>
{/block}