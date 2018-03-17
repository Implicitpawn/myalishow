<?php include_once './user/checksession.php'?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Slides &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
  <script src="/assets/vendors/jquery/jquery.js"></script>
  <script src="/assets/vendors/art-template/template-web.js"></script>
  <script type="text/html" id='myslide'>
    {{each dac}}
    <tr>
        <td class="text-center"><input type="checkbox"></td>
        <td class="text-center"><img class="slide" src="{{$value.slides_pic}}"></td>
        <td>{{$value.slides_desc}}</td>
        <td>{{$value.slides_links}}</td>
        <td class="text-center">
            <a href="javascript:;" data-id="{{$value.slides_id}}" class="btn btn-warning btn-xs hiddens">{{$value.slides_state}}</a>
            <a href="javascript:;" data-ids="{{$value.slides_id}}" class="btn btn-danger btn-xs deletes">删除</a>
        </td>
    </tr>
    {{/each}}
  </script>
  <script>
      $(function(){
          function ajaxs() {
            $.ajax({
                url:'./slides/show.php',
                type:'post',
                dataType:'json',
                success:function(date) {
                    var res = {};
                    res.dac = date;
                    var html = template('myslide',res);
                    $('#contents').html(html);
                    $('.hiddens').each(function(index,dm){
                        var conten = $(dm).html();
                        if(conten=='显示') {
                            $(dm).removeClass('btn-warning');
                            $(dm).addClass('btn-info');
                        }
                        else if(conten=='隐藏') {
                            $(dm).removeClass('btn-info');
                            $(dm).addClass('btn-warning');
                            
                        }
                    })
                    $('.hiddens').click(function(){
                        var isS = 1;
                        var id = $(this).attr('data-id');
                        var states = $(this).html();
                        that = this;
                        $.ajax({
                            url:'./slides/addslides.php',
                            type:'post',
                            data:{isS:isS,id:id,states:states},
                            dataType:'text',
                            success:function(ddd) {
                              console.log(ddd)
                              if(ddd=='隐藏') {
                                $(that).html('隐藏');
                                $(that).removeClass('btn-info');
                                $(that).addClass('btn-warning');
                              }
                              if(ddd=='显示') {
                                $(that).html('显示');
                                $(that).removeClass('btn-warning');
                                $(that).addClass('btn-info');
                              }
                            }
                        })
                    })
                    $('.deletes').click(function(){
                        var isS = 2;
                        var id = $(this).attr('data-ids');
                        that = this;
                        $.ajax({
                            url:'./slides/addslides.php',
                            type:'post',
                            data:{isS:isS,id:id},
                            dataType:'text',
                            success:function(date) {
                              if(date == 3) {
                                $(that).parent().parent().remove();
                              }
                            } 
                        })
                    })
                }
            })
          }
          ajaxs();
          $('.append').click(function(){
              var image = $('#image')[0].files;
              var text = $('#text').val();
              var link = $('#link').val();
              var isS = 0;
              var fm = new FormData(slides);
              fm.append('image',image);
              fm.append('text',text);
              fm.append('link',link);
              fm.append('isS',isS);
              $.ajax({
                  url:'./slides/addslides.php',
                  type:'post',
                  data:fm,
                  contentType:false, //禁止设置请求类型
                  processData:false, //禁止jquery对DAta数据的处理,默认会处理
                  //禁止的原因是,FormData已经帮我们做了处理
                  success:function(result){
                      ajaxs()
                  }
              })
          })
      })
  </script>
</head>
<body>
  <script>NProgress.start()</script>

  <div class="main">
    <?php include_once './common/nav.php'?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>图片轮播</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="row">
        <div class="col-md-4">
          <form name="slides">
            <h2>添加新轮播内容</h2>
            <div class="form-group">
              <label for="image">图片</label>
              <!-- show when image chose -->
              <img class="help-block thumbnail" style="display: none">
              <input id="image" class="form-control" name="image" type="file">
            </div>
            <div class="form-group">
              <label for="text">文本</label>
              <input id="text" class="form-control" name="text" type="text" placeholder="文本">
            </div>
            <div class="form-group">
              <label for="link">链接</label>
              <input id="link" class="form-control" name="link" type="text" placeholder="链接">
            </div>
            <div class="form-group">
              <input type="button" class="btn btn-primary append" value="添加">
              <!-- <button class="btn btn-primary" type="submit">添加</button> -->
            </div>
          </form>
        </div>
        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center" width="40"><input type="checkbox"></th>
                <th class="text-center">图片</th>
                <th>文本</th>
                <th>链接</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
            <tbody id="contents">
              <!-- <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td class="text-center"><img class="slide" src="../uploads/slide_1.jpg"></td>
                <td>XIU功能演示</td>
                <td>#</td>
                <td class="text-center">
                  <a href="javascript:;" class="btn btn-info btn-xs">显示</a>
                  <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                </td>
              </tr> -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="aside">
    <?php include_once './common/aside.php'?>
  </div>

  
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
</body>
</html>
