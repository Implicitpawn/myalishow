<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Add new post &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
  <link href="/assets/vendors/umeditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="/assets/vendors/umeditor/third-party/jquery.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/assets/vendors/umeditor/umeditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/assets/vendors/umeditor/umeditor.min.js"></script>
<script type="text/javascript" src="/assets/vendors/umeditor/lang/zh-cn/zh-cn.js"></script>
<script src="/assets/vendors/art-template/template-web.js"></script>
<script type="text/html" id="select">
    {{each cates}}
    <option value='{{$value.cate_name}}'>{{$value.cate_name}}</option>
    {{/each}}
</script>
<script>
    $(function() {
      $.ajax({
        url:'./user/post.php',
        dataType:'json',
        success:function(date) {
          var cate = {};
          cate.cates=date;
          var html = template('select',cate);
          $('#category').html(html);
        }
      })
      $('#btn').click(function() {
        var title = $('#title').val();
        var content = $('#content').val();
        // console.log(content);
        var slug = $('#slug').val();
        var feature = $('#feature')[0].files;
        var category = $('#category').val();
        // console.log(category);
        var created = $('#created').val();
        console.log(created)
        var status = $('#status').val();
        var fm = new FormData(fd);
        fm.append('title',title);
        fm.append('content',content);
        fm.append('slug',slug);
        fm.append('feature',feature);
        fm.append('category',category);
        fm.append('created',created);
        fm.append('status',status);
        $.ajax({
          url:'./user/addfile.php',
          type:'post',
          data:fm,
          contentType:false, //禁止设置请求类型
          processData:false, //禁止jquery对DAta数据的处理,默认会处理
          //禁止的原因是,FormData已经帮我们做了处理
          success: function (result){
              if(result==1) {
                alert('保存成功');
              }else {
                alert('保存失败');
              }
          }
        })
      })
    })
</script>
</head>
<body>
    <?php include_once '/user/checksession.php'?>
  <script>NProgress.start()</script>
  <div class="main">
    <?php include_once './common/nav.php'?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>写文章</h1>
      </div>
      <form class="row" name="fd">
        <div class="col-md-9">
          <div class="form-group">
            <label for="title">标题</label>
            <input id="title" class="form-control input-lg" name="title" type="text" placeholder="文章标题">
          </div>
          <div class="form-group">
            <label for="content">内容</label>
            <textarea id="content"></textarea>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="slug">别名</label>
            <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
            <p class="help-block">https://zce.me/post/<strong>slug</strong></p>
          </div>
          <div class="form-group">
            <label for="feature">特色图像</label>
            <!-- show when image chose -->
            <img class="help-block thumbnail" style="display: none">
            <input id="feature" class="form-control" name="feature" type="file">
          </div>
          <div class="form-group">
            <label for="category">所属分类</label>
            <select id="category" class="form-control" name="category">
              <!-- <option value="1">未分类</option>
              <option value="2">潮生活</option> -->
            </select>
          </div>
          <div class="form-group">
            <label for="created">发布时间</label>
            <input id="created" class="form-control" name="created" type="datetime-local">
          </div>
          <div class="form-group">
            <label for="status">状态</label>
            <select id="status" class="form-control" name="status">
              <option value="草稿">草稿</option>
              <option value="已发布">已发布</option>
            </select>
          </div>
          <div class="form-group">
            <input type="button" class="btn btn-primary" value='保存' id="btn">
            <!-- <button class="btn btn-primary" type="submit">保存</button> -->
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="aside">
    <?php include_once './common/aside.php'?>
  </div>

  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
  <script>
      var um = UM.getEditor('content',{
        initialFrameWidth:850, //初始化编辑器宽度,默认500
        initialFrameHeight:300,  //初始化编辑器高度,默认500
        initialContent:'请编辑文章内容'
      });
  </script>
</body>
</html>
