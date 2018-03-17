<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>阿里百秀-发现生活，发现美!</title>
  <link rel="stylesheet" href="/assets/css/style.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <script src="/assets/vendors/jquery/jquery-1.12.2.js"></script>
  <script src="/assets/vendors/art-template/template-web.js"></script>
  <script type="text/html" id="lists">
        <h3 class="titles"></h3>
        {{each list}}
        <div class="entry">
            <div class="head">
            <span class="sort">{{$value.article_cateid}}</span>
            <a href="./detail.php" data-idss="{{$value.article_id}}" class="clickid">{{$value.article_title}}</a>
            </div>
            <div class="main">
            <p class="info">{{$value.article_author}} 发表于 {{$value.aritcle_addtime}}</p>
            <p class="brief">{{$value.aritcle_desc}}</p>
            <p class="extra">
                <span class="reading">阅读({{$value.aritcle_click}})</span>
                <span class="comment">评论({{$value.num}})</span>
                <a href="javascript:;" class="like">
                <i class="fa fa-thumbs-up"></i>
                <span>赞({{$value.aritcle_good}})</span>
                </a>
                <a href="javascript:;" class="tags">
                分类：<span>{{$value.article_cateid}}</span>
                </a>
            </p>
            <a href="javascript:;" class="thumb">
                <img src="/admin/user/{{$value.aritcle_file}}" alt="">
            </a>
            </div>
        </div>
        {{/each}}
    </script>
    <script>
        $(function(){
            $.ajax({
              url:'./index/lists.php',
              dataType:'json',
              success:function(date){
                
                var lists = {};
                  lists.list = date;
                var html = template('lists',lists);
                // var tt = $('.titles').html(date[0].article_cateid)
                $.ajax({
                    url:'./index/setcooki.php',
                    dataType:'text',
                    success:function(result){
                      console.log(result)
                      $('.titles').html(result)
                    }
                  })
                $('.lists').html(html);
                console.log(lists)
                $('.clickid').click(function(){
                var id = $(this).attr('data-idss');
                console.log(1123)
                $.ajax({
                  url:'./index/setdetailcookei.php',
                  type:'post',
                  data:{id:id},
                  dataType:'text',
                  success:function(date){
                    console.log(date)
                  }
                })
              })
              }
            })
            
        })
    </script>
</head>
<body>
  <div class="wrapper">
    <?php include_once '/admin/common/left.php'?>
    <div class="content">
      <div class="panel new lists">
      <!-- <h3 class="titles"></h3> -->
      </div>
    </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>
</body>
</html>
