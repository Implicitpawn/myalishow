<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Dashboard &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
<?php include_once "/user/checksession.php"?>
  <script>NProgress.start()</script>

  <div class="main">
    <?php include_once './common/nav.php'?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>我的个人资料</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <form class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-3 control-label">头像</label>
          <div class="col-sm-6">
            <label class="form-image">
              <input id="avatar" type="file">
              <img src="../assets/img/default.png" id="pic">
              <i class="mask fa fa-upload"></i>
            </label>
          </div>
        </div>
        <div class="form-group">
          <label for="email" class="col-sm-3 control-label">邮箱</label>
          <div class="col-sm-6">
            <input id="email" class="form-control" name="email" type="type" value="w@zce.me" placeholder="邮箱" readonly>
            <p class="help-block">登录邮箱不允许修改</p>
          </div>
        </div>
        <div class="form-group">
          <label for="slug" class="col-sm-3 control-label">别名</label>
          <div class="col-sm-6">
            <input id="slug" class="form-control" name="slug" type="type" value="zce" placeholder="slug">
            <p class="help-block">https://zce.me/author/<strong>zce</strong></p>
          </div>
        </div>
        <div class="form-group">
          <label for="nickname" class="col-sm-3 control-label">昵称</label>
          <div class="col-sm-6">
            <input id="nickname" class="form-control" name="nickname" type="type" value="汪磊" placeholder="昵称">
            <p class="help-block">限制在 2-16 个字符</p>
          </div>
        </div>
        <div class="form-group">
          <label for="bio" class="col-sm-3 control-label">简介</label>
          <div class="col-sm-6">
            <textarea id="bio" class="form-control" placeholder="Bio" cols="30" rows="6">MAKE IT BETTER!</textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-6">
            <a href="javascript:;" class="btn btn-primary" id="btn">更新</a>
            <a class="btn btn-link" href="/admin/user/password-re.php">修改密码</a>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="aside">
    <?php include_once './common/aside.php'?>
  </div>

  <script src="/assets/vendors/jquery/jquery.js"></script>
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
  <script>
    $(function(){
      $.ajax({
        url:'./user/profileinsert.php',
        dataType:'json',
        success:function(result) {
          // console.log(result);
          $('#email').val(result.user_name);
          $('#slug').val(result.user_slug);
          $('#nickname').val(result.user_nick);
          $('#pic')[0].src = result.user_pic;
        }
      })
      $('#btn').click(function(){
        var slug = $('#slug').val();
        var nickname = $('#nickname').val();
        $.ajax({
          url:'./user/profileupd.php',
          type:'post',
          data:{
            slug:slug,
            nickname:nickname
          },
          dataType:'text',
          success:function(date) {
            // alert(date);
            if(date==1) {
              alert('更新成功');
              console.log(date);
            }
            
          }
        })
      })
    })
  </script>
</body>
</html>
