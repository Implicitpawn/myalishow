<?php include_once '../user/checksession.php'?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Comments &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
  <script src="/assets/vendors/jquery/jquery.js"></script>
  <script src="/assets/vendors/art-template/template-web.js"></script>
  <script type="text/html" id="numberss">
    {{each date}}
      <tr class="danger">
        <td class="text-center"><input type="checkbox" value='{{$value.numbers_id}}' id="checks"></td>
        <td>{{$value.comments_nick}}</td>
        <td>{{$value.numbers_content}}</td>
        <td>{{$value.article_title}}</td>
        <td>{{$value.numbers_time}}</td>
        <td class="states">{{$value.numbers_state}}</td>
        <td class="text-center">
            <a href="javascript:;" data-id="{{$value.numbers_id}}" class="btn btn-info btn-xs edit">{{$value.click_state}}</a>
            <a href="javascript:;" data-ids="{{$value.numbers_id}}" class="btn btn-danger btn-xs delete">删除</a>
        </td>
    </tr>
    {{/each}}
  </script>
  <script>
      $(function() {
        $.ajax({
            url:'./selectnumbers.php',
            type:'post',
            dataType:'json',
            success:function(result) {
                console.log(result)
                var nums = {};
                nums.date = result;
                var html = template('numberss',nums);
                $('#contents').html(html);
                $('.edit').each(function(index,domEle){
                    var content = domEle.innerText;
                    if(content == '批准') {
                        $(domEle).removeClass('btn-warning');
                        $(domEle).addClass('btn-info');
                    }else if(content == '驳回'){
                        $(domEle).removeClass('btn-info');
                        $(domEle).addClass('btn-warning');
                    }
                })
                $('.edit').click(function(){
                    var contents = $(this).html();
                    var id = $(this).attr('data-id');
                    var isS = 0;
                    that = this;
                    console.log(id);
                    $.ajax({
                        url:'./edit.php',
                        type:'post',
                        data:{contents:contents,id:id,isS:isS},
                        dataType:'text',
                        success:function(date) {
                            if(date == 1) {
                                if(contents == '批准') {
                                    $(that).html('驳回');
                                    $(that).removeClass('btn-info');
                                    $(that).addClass('btn-warning');
                                    $(that).parent().parent().find('.states').html('批准');
                                }
                                else if(contents == '驳回') {
                                    $(that).html('批准');
                                    $(that).removeClass('btn-warning');
                                    $(that).addClass('btn-info');
                                    $(that).parent().parent().find('.states').html('驳回');
                                }
                            }
                        }
                    })
                })
                $('.delete').click(function(){
                    var id = $(this).attr('data-ids');
                    var isS = 1;
                    that = this;
                    console.log(id);
                    $.ajax({
                        url:'./edit.php',
                        type:'post',
                        data:{id:id,isS:isS},
                        dataType:'text',
                        success:function(date) {
                            if(date ==2){
                                $(that).parent().parent().remove();
                            }
                        }
                    })
                })
                $('.approval').click(function(){
                    var str ='';
                    var isS = 0;
                    $('input:checked').each(function(index,domEle) {
                        str += domEle.value + ',';
                    })
                    str = str.substr(0,str.length-1);
                    $.ajax({
                        url:'./approval.php',
                        type:'post',
                        data:{str:str,isS:isS},
                        dataType:'text',
                        success:function(date) {
                            if(date == 1) {
                                $('input:checked').each(function(index,domEle) {
                                    $(domEle).parent().parent().find('.states').html('批准');
                                    $(domEle).parent().siblings().last('td').find('.edit').html('驳回').removeClass('btn-info').addClass('btn-warning');
                                })
                            }
                        }
                    })
                })
                $('.refuse').click(function(){
                    var str ='';
                    var isS = 1;
                    $('input:checked').each(function(index,domEle) {
                        str += domEle.value + ',';
                    })
                    str = str.substr(0,str.length-1);
                    $.ajax({
                        url:'./approval.php',
                        type:'post',
                        data:{str:str,isS:isS},
                        dataType:'text',
                        success:function(date) {
                            if(date == 1) {
                                $('input:checked').each(function(index,domEle) {
                                    $(domEle).parent().parent().find('.states').html('驳回');
                                    $(domEle).parent().siblings().last('td').find('.edit').html('批准').removeClass('btn-warning').addClass('btn-info');
                                })
                            }
                        }
                    })
                })
                $('.deletes').click(function(){
                    var str ='';
                    var isS = 2;
                    $('input:checked').each(function(index,domEle) {
                        str += domEle.value + ',';
                    })
                    str = str.substr(0,str.length-1);
                    $.ajax({
                        url:'./approval.php',
                        type:'post',
                        data:{str:str,isS:isS},
                        dataType:'text',
                        success:function(date) {
                            // console.log(date)
                            if(date == 1) {
                                $('input:checked').each(function(index,domEle) {
                                    $(domEle).parent().parent().remove();
                                    // $(domEle).parent().siblings().last('td').find('.edit').html('批准').removeClass('btn-warning').addClass('btn-info');
                                })
                            }
                        }
                    })
                })
            }
        })
        
      })
  </script>
</head>
<body>
  <script>NProgress.start()</script>

  <div class="main">
    <?php include_once '../common/nav.php'?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>所有评论</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="page-action">
        <!-- show when multiple checked -->
        <div class="btn-batch">
          <a href="javascript:;" class="btn btn-info btn-sm approval">批量批准</a>
          <a href="javascript:;" class="btn btn-warning btn-sm refuse">批量拒绝</a>
          <a href="javascript:;" class="btn btn-danger btn-sm deletes">批量删除</a>
        </div>
        <ul class="pagination pagination-sm pull-right">
          <li><a href="#">上一页</a></li>
          <li><a href="#">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">下一页</a></li>
        </ul>
      </div>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center" width="40"><input type="checkbox"></th>
            <th>作者</th>
            <th>评论</th>
            <th>评论在</th>
            <th>提交于</th>
            <th>状态</th>
            <th class="text-center" width="100">操作</th>
          </tr>
        </thead>
        <tbody id="contents">
          <!-- <tr class="danger">
            <td class="text-center"><input type="checkbox"></td>
            <td>大大</td>
            <td>楼主好人，顶一个</td>
            <td>《Hello world》</td>
            <td>2016/10/07</td>
            <td>未批准</td>
            <td class="text-center">
              <a href="post-add.html" class="btn btn-info btn-xs">批准</a>
              <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
            </td>
          </tr> -->
        </tbody>
      </table>
    </div>
  </div>

  <div class="aside">
    <?php include_once "../common/aside.php" ?>
  </div>

  
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
</body>
</html>
