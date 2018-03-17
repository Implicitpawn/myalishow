<?php include_once './user/checksession.php'?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Posts &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
  <script src="/assets/vendors/jquery/jquery.js"></script>
  <script src="/assets/vendors/art-template/template-web.js"></script>
  <script type="text/html" id="select">
    {{each cates}}
    <option value='{{$value.cate_id}}'>{{$value.cate_name}}</option>
    {{/each}}
  </script>
  <script type="text/html" id="content">
    {{each art}}
    <tr>
        <td class="text-center"><input type="checkbox"></td>
        <td>{{$value.article_title}}</td>
        <td>{{$value.article_author}}</td>
        <td>{{$value.article_cateid}}</td>
        <td class="text-center">{{$value.times}}</td>
        <td class="text-center">{{$value.aritcle_state}}</td>
        <td class="text-center">
            <a href="./edit.php" data-id="{{$value.article_id}}" class="btn btn-default btn-xs edit">编辑</a>
            <a href="javascript:;" data-ids="{{$value.article_id}}" class="btn btn-danger btn-xs delete">删除</a>
        </td>
    </tr>
    {{/each}}
</script>
<script>
    $(function() {
      var isS = true;
      var pp = null;
      $.ajax({
        url:'./user/post.php',
        dataType:'json',
        success:function(date) {
          var cate = {};
          cate.cates=date;
          var html = template('select',cate);
          var parent = $('#category').html();
          $('#category').html(parent+html);
        }
      })
      function timestampToTime(timestamp) {
        var date = new Date(timestamp * 1000);//时间戳为10位需*1000，时间戳为13位的话不需乘1000
        Y = date.getFullYear() + '-';
        M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';
        D = date.getDate() + ' ';
        h = date.getHours() + ':';
        m = date.getMinutes() + ':';
        s = date.getSeconds();
        return Y+M+D+h+m+s;
      }
      function ajaxs() {
        var pageval = $('#pageval').html();
        $.ajax({
          url:'./user/select-article.php',
          type:'post',
          data:{pageval:pageval},
          dataType:'json',
          success:function(result) {
            var article ={};
            article.art = result;
            var time = [];
            var i = 0;
            while(result[i]) {
                time[i] = result[i].aritcle_addtime;
                i++;
            }
            
            for(var i =0 ; i < time.length; i++) {
                article.art[i].times = timestampToTime(time[i]);
            }
            console.log(article)
            var html = template('content',article);
            $('#contents').html(html);
            $('.edit').click(function(){
              var id = $(this).attr("data-id");
              $.ajax({
                url:'./user/getid.php',
                type:'post',
                data:{id:id},
                success:function(id) {
                  console.log(id)
                }
              })
            })
            $('.delete').click(function() {
              var ids = $(this).attr("data-ids");
              // console.log(ids);
              that = this;
              $.ajax({
                url:'./user/delect-post.php',
                type:'post',
                data:{ids:ids},
                success:function(result) {
                  if(result==1) {
                    alert('删除成功!');
                    $(that).parent().parent().remove();
                  }else {
                    alert('删除失败!');
                  }
                }
              })
            })
          }
        })
      }
      ajaxs();
      var ajaxsss = function () {
        var category = $('#category').val();
        var state = $('#state').val();
        if(pp == 0) {
          $('#pageval').html(1);
        }
        var pageval = $('#pageval').html();
      
        $.ajax({
          url:'./user/screen.php',
          type:'post',
          data:{category:category,state:state,pageval:pageval},
          dataType:'json',
          success:function(screen) {
            var article ={};
            article.art = screen;
            var time = [];
            var i = 0;
            while(screen[i]) {
                time[i] = screen[i].aritcle_addtime;
                i++;
            }
            for(var i =0 ; i < time.length; i++) {
                article.art[i].times = timestampToTime(time[i]);
            }
            console.log(screen[0].times)
            var html = template('content',article);
            $('#contents').html(html);
            $('.edit').click(function(){
              var id = $(this).attr("data-id");
              $.ajax({
                url:'./user/getid.php',
                type:'post',
                data:{id:id},
                success:function(id) {
                  console.log(id)
                }
              })
            })
          }
        })
      }
      $('#start').click(function() {
        if(isS) {
            var pageval = 1;
            $.ajax({
              url:'./user/checkcounts.php',
              type:'post',
              dataType:'text',
              success:function(result) {
                $('#pageval').html(pageval);
                $.ajax({
                  url:'./user/select-article.php',
                  type:'post',
                  data:{pageval:pageval},
                  success:function(date) {
                    ajaxs();
                  }
                })
              }
          })
        }else {
          var pageval = 1;
              var category = $('#category').val();
              var state = $('#state').val();
              $.ajax({
                url:'./user/checkscreen.php',
                type:'post',
                data:{category:category,state:state},
                dataType:'text',
                success:function(result) {
                $('#pageval').html(pageval);
                pp = 1;
              ajaxsss();
            }
          })
        }
          
      })
      $('#next').click(function() {
        if(isS) {
          console.log(1)
          $.ajax({
              url:'./user/checkcounts.php',
              type:'post',
              dataType:'text',
              success:function(result) {
                var pageval = $('#pageval').html();
                if(pageval<result) {
                  pageval++
                }else {
                  pageval = pageval;
                }
                $('#pageval').html(pageval);
                $.ajax({
                  url:'./user/select-article.php',
                  type:'post',
                  data:{pageval:pageval},
                  success:function(date) {
                    ajaxs();
                  }
                })
              }
          })
        }else {
          console.log(2)
            var category = $('#category').val();
            var state = $('#state').val();
              $.ajax({
                  url:'./user/checkscreen.php',
                  type:'post',
                  data:{category:category,state:state},
                  dataType:'text',
                  success:function(result) {
                    var pageval = $('#pageval').html();
                    if(pageval<result) {
                      pageval++
                    }else {
                      pageval = pageval;
                    }
                    $('#pageval').html(pageval);
                    pp = 1;
                    ajaxsss();
                  }
              })
        }
      })
      $('#pre').click(function() {
        if(isS){
          $.ajax({
            url:'./user/checkcounts.php',
            type:'post',
            dataType:'text',
            success:function(result) {
              var pageval = $('#pageval').html();
              if(pageval>1) {
                pageval--
              }else {
                pageval = pageval;
              }
              $('#pageval').html(pageval);
              $.ajax({
                url:'./user/select-article.php',
                type:'post',
                data:{pageval:pageval},
                success:function(date) {
                  ajaxs();
                }
              })
            }
          })
        }else {
          var category = $('#category').val();
          var state = $('#state').val();
          $.ajax({
            url:'./user/checkscreen.php',
            type:'post',
            data:{category:category,state:state},
            dataType:'text',
            success:function(result) {
              var pageval = $('#pageval').html();
              if(pageval>1) {
                pageval--
              }else {
                pageval = pageval;
              }
              $('#pageval').html(pageval);
              pp = 1;
              ajaxsss();
            }
          })
        }
      })
      $('#end').click(function() {
        if(isS) {
          $.ajax({
            url:'./user/checkcounts.php',
            type:'post',
            dataType:'text',
            success:function(result) {
              var pageval = $('#pageval').html();
              pageval = result;
              $('#pageval').html(pageval);
              $.ajax({
                url:'./user/select-article.php',
                type:'post',
                data:{pageval:pageval},
                success:function(date) {
                  ajaxs();
                }
              })
            }
          })
        }else {
          var category = $('#category').val();
          var state = $('#state').val();
          $.ajax({
            url:'./user/checkscreen.php',
            type:'post',
            data:{category:category,state:state},
            dataType:'text',
            success:function(result) {
              var pageval = $('#pageval').html();
              pageval = result;
              console.log(result)
              $('#pageval').html(pageval);
              pp = 1;
              ajaxsss();
            }
          })
        }
      })
      $('#cli-screen').click(function(){
        isS = false;
        pp = 0;
        ajaxsss();
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
        <h1>所有文章</h1>
        <a href="./post-add.php" class="btn btn-primary btn-xs">写文章</a>
      </div>

      <div class="page-action">
        <!-- show when multiple checked -->
        <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
        <form class="form-inline" name="screen">
          <select name="category" class="form-control input-sm" id="category">
            <option value="0">所有分类</option>
          </select>
          <select name="state" class="form-control input-sm" id="state">
            <option value="0">所有状态</option>
            <option value="1">草稿</option>
            <option value="2">已发布</option>
          </select>
          <input type="button" class="btn btn-default btn-sm" value='筛选' id="cli-screen">
          <!-- <button class="btn btn-default btn-sm" id="cli-screen">筛选</button> -->
        </form>
        <ul class="pagination pagination-sm pull-right">
          <li><a href="#" id="start">首页</a></li>
          <li><a href="#" id="pre">上一页</a></li>
          <li><a href="#" id="pageval">1</a></li>
          <li><a href="#" id="next">下一页</a></li>
          <li><a href="#" id="end">尾页</a></li>
        </ul>
      </div>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center" width="40"><input type="checkbox"></th>
            <th>标题</th>
            <th>作者</th>
            <th>分类</th>
            <th class="text-center">发表时间</th>
            <th class="text-center">状态</th>
            <th class="text-center" width="100">操作</th>
          </tr>
        </thead>
        <tbody id="contents">
          <!-- <tr>
            <td class="text-center"><input type="checkbox"></td>
            <td>随便一个名称</td>
            <td>小小</td>
            <td>潮科技</td>
            <td class="text-center">2016/10/07</td>
            <td class="text-center">已发布</td>
            <td class="text-center">
              <a href="javascript:;" class="btn btn-default btn-xs">编辑</a>
              <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
            </td>
          </tr> -->
          
        </tbody>
      </table>
    </div>
  </div>

  <div class="aside">
    <?php include_once './common/aside.php'?>
  </div>


  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  
<script>NProgress.done()</script>
</body>
</html>
