<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Users &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
  <script src="/assets/vendors/jquery/jquery.min.js"></script>
  <script src="/assets/vendors/bootstrap/js/bootstrap.min.js"></script>
  <script>
    window.onload= function() {
      $('.dels').click(function(){
        var data = $(this).attr('data-del');
        that = this;
        if(confirm('删除？')) {
          $.ajax({
            type:'post',
            url:'./delete.php',
            data:{id:data},
            dataType:'text',
            success:function(date) {
              if(date==1) {
                alert('删除成功');
                $(that).parent().parent().remove();
              }else {
                alert('删除失败')
              }
            }
          })
        }        
      })
    }
  </script>
</head>
<body>
<?php include_once "../user/checksession.php"?>
  <script>NProgress.start()</script>
  <?php
   header('content-type:text/html;charset=utf8');
   mysql_connect('localhost','root','root');
   mysql_query('set names utf8');
   mysql_query('use alishow');
   $pageno = isset($_GET['pageno'])?$_GET['pageno'] :1;
   $pagesize = 3;
   $offset = ($pageno-1)*$pagesize;
   $count = "select count(*) as num from ali_user";
   $num = mysql_query($count);
   $nums = mysql_fetch_assoc($num);
   $counts = ceil($nums['num']/$pagesize);
  //  die ($counts);  
   $sle = "select * from ali_user order by user_id desc limit $offset,$pagesize";
   $sql = mysql_query($sle);
   $pre = ($pageno-1)>0 ?$pageno-1 :1;
   $next = ($pageno+1)>$counts ?$counts :$pageno+1;
  ?>
  <div class="main">
    <?php include_once '../common/nav.php'?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>用户</h1>
        <a href="./adduser.php">添加用户</a>
      </div>
      <div class="row">
        <div class="col-md-8">
          <div class="page-action">
            <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
               <tr>
                <th class="text-center" width="40"><input type="checkbox"></th>
                <th class="text-center" width="80">头像</th>
                <th>邮箱</th>
                <th>别名</th>
                <th>昵称</th>
                <th>状态</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
            <tbody>
              <?php while($sqls = mysql_fetch_assoc($sql)):?>
              <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td class="text-center"><img class="avatar" src="<?=$sqls['user_pic']?>"></td>
                <td><?=$sqls['user_name']?></td>
                <td><?=$sqls['user_slug']?></td>
                <td><?=$sqls['user_nick']?></td>
                <td><?=$sqls['user_state']==1 ?'已激活':'未激活'?></td>
                <td class="text-center">
                  <a href="post-add.php" class="btn btn-default btn-xs">编辑</a>
                  <a href="javascript:;" data-del="<?=$sqls['user_id']?>" class="dels btn btn-danger btn-xs">删除</a>
                </td>
              </tr>
              <?php endwhile;?>
            </tbody>
          </table>
          <ul class="pagination pagination-sm pull-right">
          <li><a href="users.php?pageno=1">首页</a></li>
          <li><a href="users.php?pageno=<?= $pre?>">上一页</a></li>
          <li><a href="users.php?pageno=<?=$pageno?>"><?=$pageno?></a></li>
          <li><a href="users.php?pageno=<?= $next?>">下一页</a></li>
          <li><a href="users.php?pageno=<?= $counts?>">尾页</a></li>
        </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../common/aside.php'?>
  </div>

  <!-- <script src="../assets/vendors/jquery/jquery.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script> -->
  <script>NProgress.done()</script>
</body>
</html>
