<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--360浏览器优先以webkit内核解析-->
    <title>Mr.Y CMS Admin</title>
    <!-- <link rel="shortcut icon" href="favicon.ico">  -->
    <link href="/static/vendor/admin/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/static/vendor/admin/css/font-awesome.min93e3.css" rel="stylesheet">
    <link href="/static/vendor/admin/css/animate.min.css" rel="stylesheet">
    <link href="/static/vendor/admin/css/style.min862f.css?v=4.1.0" rel="stylesheet">
    <link href="/static/vendor/uploadify/uploadify.css" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.0/bootstrap-table.min.css">

</head>
<body>
    {block name="serverinfo"}{/block}
    {block name="showcate"}{/block}
    {block name="addcate"}{/block}
    {block name="addarticle"}{/block}
    <script src="/static/vendor/admin/js/jquery.min.js?v=2.1.4"></script>
    <script src="/static/vendor/admin/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="/static/vendor/admin/js/plugins/layer/layer.min.js"></script>
    <script src="/static/vendor/admin/js/content.min.js"></script>
    <script src="/static/vendor/admin/js/welcome.min.js"></script>
    <script src="/static/vendor/uploadify/jquery.uploadify.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.0/bootstrap-table.min.js"></script>

    <!-- Latest compiled and minified Locales -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.0/locale/bootstrap-table-zh-CN.min.js"></script>
    <script>
      var SCOPE = {
        /*'save_url' : '/admin.php?c=content&a=add',
        'jump_url' : '/admin.php?c=content',*/
        'ajax_upload_image_url' : '',
        'ajax_upload_swf' : '/static/vendor/uploadify/uploadify.swf',
      };

    </script>
    <script>
    $(function() {
        $('#file_upload').uploadify({
            'swf'      : SCOPE.ajax_upload_swf,
            'uploader' : SCOPE.ajax_upload_image_url,
            'buttonText': '上传图片',
            'fileTypeDesc': 'Image Files',
            'fileObjName' : 'file',
            //允许上传的文件后缀
            'fileTypeExts': '*.gif; *.jpg; *.png',
            'onUploadSuccess' : function(file,data,response) {
                // response true ,false
                if(response) {
                    var obj = JSON.parse(data); //由JSON字符串转换为JSON对象

                    console.log(data);
                    $('#' + file.id).find('.data').html(' 上传完毕');

                    $("#upload_org_code_img").attr("src",obj.data);
                    $("#file_upload_image").attr('value',obj.data);
                    $("#upload_org_code_img").show();
                }else{
                    alert('上传失败');
                }
            },
        });
    });
    </script>
    <script>
            KindEditor.ready(function(K) {
                window.editor = K.create('#editor_id',{
                    uploadJson : '',
                    afterBlur : function(){
                        var self = this;
                        self.sync();
                    }
                });
            });
    </script>
</body>
</html>
