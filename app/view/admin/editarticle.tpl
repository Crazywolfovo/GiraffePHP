{extends file="layout.tpl"}
{block name="editarticle"}
<script src="/static/vendor/kindeditor/kindeditor-all-min.js"></script>
<script src="/static/vendor/kindeditor/lang/zh-CN.js"></script>
<div class="container"><h1 class="col-md-4 col-md-offset-5 clearfix">修改文章内容</h1></div>
<div class="container">
    <form class="form-horizontal" action="updateart" method="POST">
      <div class="form-group">
        <label for="title" class="col-sm-2 control-label">文章标题</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="title" name="title" placeholder="{$artinfo.title}">
        </div>
      </div>
      <div class="form-group">
        <label for="small_title" class="col-sm-2 control-label">文章短标题</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="small_title" name="small_title" placeholder="{$artinfo.small_title}">
        </div>
      </div>
      <div class="form-group">
        <label for="author" class="col-sm-2 control-label">文章作者</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="author" id="author" placeholder="{$artinfo.author}">
        </div>
      </div>
      <div class="form-group">
        <label for="discription" class="col-sm-2 control-label">文章描述</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="discription" id="discription" placeholder="{$artinfo.discription}">
        </div>
      </div>
      <div class="form-group">
        <label for="keywords" class="col-sm-2 control-label">文章关键字</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="keywords" id="keywords" placeholder="{$artinfo.keywords}">
        </div>
      </div>
      <div class="form-group">
        <label for="file_upload" class="col-sm-2 control-label">文章略缩图</label>
        <div class="col-sm-10">
            <input type="file" id="file_upload" multiple="true">
            <img style="display: none" id="upload_org_code_img" src="" width="150" height="150">
            <input id="file_upload_image" name="thumbnail" type="hidden" multiple="true" value="">
        </div>
      </div>
      <div class="form-group">
        <label for="catename" class="col-sm-2 control-label">旧的分类</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" placeholder="{$artinfo.catename}" disabled>
        </div>
      </div>
      <div class="form-group">
        <label for="cate" class="col-sm-2 control-label">新的分类</label>
        <div class="col-sm-10">
           <select class="form-control" id="parentcate" name="cate_id">
            {foreach $tree as $value}
                <option value="{$value.id}">{$value.catename}</option>
            {foreachelse}
                <option value="">获取数据失败</option>
            {/foreach}
            </select>
        </div>
      </div>
      <div class="form-group">
        <label for="copyfrom" class="col-sm-2 control-label">文章来源</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="copyfrom" name="copyfrom" placeholder="{$artinfo.copyfrom}">
        </div>
      </div>
       <div class="form-group">
        <label for="content" class="col-sm-2 control-label">文章内容</label>
        <div class="col-sm-10">
          <textarea name="content" id="editor_id" name="content" class="form-control">{$artinfo.content}</textarea>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <input type="hidden"  name="article_id" value="{$artinfo.article_id}">
          <input class="btn btn-info" type="submit" value="提交修改">
        </div>
      </div>
    </form>
</div>
    <script>
    $(function() {
        $('#file_upload').uploadify({
            'swf'      : '/static/vendor/uploadify/uploadify.swf',
            'uploader' : 'addthumb',
            'buttonText': '上传图片',
            'onUploadSuccess':function (file,data,response) {
              //alert(data);
               if(response) {
                    $("#upload_org_code_img").attr("src",data);
                    $("#file_upload_image").attr('value',data);
                    $("#upload_org_code_img").show();
                }else{
                    alert('上传失败');
                }
            }
        });
    });
    </script>
   <script>
            KindEditor.ready(function(K) {
                window.editor = K.create('#editor_id',{
                    uploadJson : 'addeditorpic',
                    // afterBlur : function(){
                    //     var self = this;
                    //     self.sync();
                    // }
                });
            });
    </script>
{/block}