<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="profile">
      <img class="avatar" src="../../uploads/avatar.jpg">
      <h3 class="name">布头儿</h3>
    </div>
    <ul class="nav">
      <li>
        <a href="/index.html"><i class="fa fa-dashboard"></i>仪表盘</a>
      </li>
      <li class="active">
        <a href="#menu-posts" data-toggle="collapse">
          <i class="fa fa-thumb-tack"></i>文章<i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-posts" class="collapse in">
          <li><a href="/admin/posts.php">所有文章</a></li>
          <li><a href="/admin/post-add.php">写文章</a></li>
          <li class="active"><a href="/admin/cate/categories.php">分类目录</a></li>
        </ul>
      </li>
      <li>
        <a href="/admin/comments/comments.php"><i class="fa fa-comments"></i>评论</a>
      </li>
      <li>
        <a href="/admin/user/users.php"><i class="fa fa-users"></i>用户</a>
      </li>
      <li>
        <a href="#menu-settings" class="collapsed" data-toggle="collapse">
          <i class="fa fa-cogs"></i>设置<i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-settings" class="collapse">
          <li><a href="/nav-menus.html">导航菜单</a></li>
          <li><a href="/admin/slides.php">图片轮播</a></li>
          <li><a href="/settings.html">网站设置</a></li>
        </ul>
      </li>
    </ul>
</body>
</html>
