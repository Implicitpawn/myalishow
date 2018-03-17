<?php include_once "../user/checksession.php"?>
<?php
header('content-type:text/html;charset=utf8');
mysql_connect('localhost','root','root');
mysql_query('set names utf8');
mysql_query('use alishow');
$id = $_GET['id'];
// die($id);
$sel = "select * from ali_cate where cate_id='$id'";
$sql = mysql_query($sel);
$qq = mysql_fetch_assoc($sql);
// var_dump($qq);
?>
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
  <script>NProgress.start()</script>

  <div class="main">
    <?php include_once '../common/nav.php'?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>分类目录</h1>
      </div>
      <div class="row">
        <div class="col-md-4">
          <form action="/admin/cate/update.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?php echo $_GET['id']?>">
            <h2>添加新分类目录</h2>
            <a href="./categories.php">返回目录</a>
            <div class="form-group">
              <label for="name">名称</label>
              <input id="name" class="form-control" name="name" type="text" value="<?php echo $qq['cate_name']?>">
            </div>
            <div class="form-group">
              <label for="slug">别名</label>
              <input id="slug" class="form-control" name="slug" type="text" value="<?php echo $qq['cate_slug']?>">
              <label for="class">图标</label>
              <input id="class" class="form-control" name="class" type="text" value="<?php echo $qq['cate_class']?>">
              <div><input type="radio" value="1" name="status" <?php echo $qq['cate_status']==1 ?'checked' :''?>>启用 <input type="radio" value="0" name="status" <?=$qq['cate_status']==0 ?'checked' :''?>>禁用</div>
              <div><input type="radio" value="1" name="show" <?=$qq['cate_show']==1 ?'checked' :''?>>显示 <input type="radio" value="0" name="show" <?=$qq['cate_show']==0 ?'checked' :''?>>隐藏</div>
              <p class="help-block">https://zce.me/category/<strong>slug</strong></p>
            </div>
            <div class="form-group">
              <button class="btn btn-primary" type="submit">修改</button>
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
