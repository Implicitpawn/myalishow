<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Categories &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
<?php include_once "../user/checksession.php"?>
  <script>NProgress.start()</script>

  <div class="main">
    <?php include_once '../common/nav.php'?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>分类目录</h1>
      </div>
      <div class="row">
        <div class="col-md-4">
          <form action="./addcate.php" method="POST" enctype="multipart/form-data">
            <h2>添加新分类目录</h2>
            <a href="./categories.php">查看目录</a>
            <div class="form-group">
              <label for="name">名称</label>
              <input id="name" class="form-control" name="name" type="text" placeholder="分类名称">
            </div>
            <div class="form-group">
              <label for="slug">别名</label>
              <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
              <label for="class">图标</label>
              <input id="class" class="form-control" name="class" type="text" placeholder="class">
              <div><input type="radio" value="1" name="status" checked>启用 <input type="radio" value="0" name="status">禁用</div>
              <div><input type="radio" value="1" name="show" checked>显示 <input type="radio" value="0" name="show">隐藏</div>
              <p class="help-block">https://zce.me/category/<strong>slug</strong></p>
            </div>
            <div class="form-group">
              <button class="btn btn-primary" type="submit">添加</button>
            </div>
          </form>
        </div>
        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="aside">
    <?php include_once "../common/aside.php"?>
  </div>

  <script src="../assets/vendors/jquery/jquery.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
</body>
</html>
