<?php include_once "../user/checksession.php"?>
<?php
    header('centent-type:text/htnl;charset=utf8');
    mysql_connect('localhost:3306','root','root');
    mysql_query('set names utf8');
    mysql_query('use alishow');
    $sql = "select * from ali_cate";
    $sel = mysql_query($sql);
    // var_dump($sel);
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
        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center" width="40"><input type="checkbox"></th>
                <th>名称</th>
                <th>Slug</th>
                <th>图标</th>
                <th>状态</th>
                <th>是否显示</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
            <tbody>
                <?php while($sqls = mysql_fetch_assoc($sel)):?>
              <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td><?php echo $sqls['cate_name']?></td>
                <td><?php echo $sqls['cate_slug']?></td>
                <td><?php echo $sqls['cate_class']?></td>
                <td><?php if($sqls['cate_status']==1) {
                    echo '启用';
                    }else {echo '禁用';};
                    ?></td>
                <td><?php if($sqls['cate_show']==1) {
                    echo '显示';
                    }else {echo '不显示';};
                    ?></td>
                <td class="text-center">
                  <a href="./idea.php?id=<?php echo $sqls['cate_id']?>" class="btn btn-info btn-xs">编辑</a>
                  <a href="./delete.php?id=<?php echo $sqls['cate_id']?>" class="btn btn-danger btn-xs">删除</a>
                </td>
              </tr>
                <?php endwhile;?>
            </tbody>
          </table>
          <a href="./add.php">返回</a>
        </div>
      </div>
    </div>
  </div>

  <div class="aside">
    <?php include_once "../common/aside.php"?>
  </div>

  <script src="/assets/vendors/jquery/jquery.js"></script>
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
</body>
</html>
