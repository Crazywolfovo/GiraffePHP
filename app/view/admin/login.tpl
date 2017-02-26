<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="">
  <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Mr.Y CMS Admin</title>

  <!-- Bootstrap core CSS -->
  <link href="/static/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <!-- <link href="signin.css" rel="stylesheet"> -->



  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>

  <![endif]-->
</head>

<body>
<!-- <style>
  .s_center {
    margin-left: auto;
    margin-right: auto;
  }
</style> -->
<div class="container">

    <form class="form-signin center" enctype="multipart/form-data">
      <h2 class="form-signin-heading center">请登录</h2>
      <label class="sr-only">用户名</label>
      <input type="text"  class="form-control" name="username" placeholder="请填写用户名" required autofocus>
      <br />
      <label  class="sr-only">密码</label>
      <input type="password" name="password" id="inputPassword" class="form-control" placeholder="密码" required>
      <br />
      <button class="btn btn-lg btn-primary btn-block" type="button" onclick="login.check()">登录</button>
      <!-- <input type="submit"> -->
    </form>

</div> <!-- /container -->
    <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/static/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="/static/vendor/layer/layer.js"></script>
    <script src="/static/vendor/layer/dialog.js"></script>
    <script src="/static/js/adminlogin.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
</body>
</html>
