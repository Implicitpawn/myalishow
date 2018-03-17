<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>阿里百秀-发现生活，发现美!</title>
   <link rel="stylesheet" href="/assets/css/style.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
   <script src="/assets/vendors/jquery/jquery-1.12.2.min.js"></script>
  <script src="/assets/vendors/art-template/template-web.js"></script>
  <script type="text/html" id="nav_content">
         {{each data}}
        <li><a href="/list.php" data-id={{$value.cate_name}} class="clicks"><i class="fa {{$value.cate_class}}"></i>{{$value.cate_name}}</a></li>
        {{/each}}
  </script>
  <script type="text/html" id="right_content">
        {{each right}}
        <li>
          <a href="javascript:;">
            <p class="title">{{$value.article_title}}</p>
            <p class="reading">阅读({{$value.aritcle_click}})</p>
            <div class="pic">
              <img src="/admin/user/{{$value.aritcle_file}}" alt="">
            </div>
          </a>
        </li>
        {{/each}}
  </script>
  <script type="text/html" id="right_com">
      {{each com}}
      <li>
        <a href="javascript:;">
          <div class="avatar">
            <img src="/uploads/20180301160256-4664.gif" alt="">
          </div>
          <div class="txt">
            <p>
              <span>{{$value.comments_nick}}</span>{{$value.numbers_time}}说:
            </p>
            <p>{{$value.numbers_content}}</p>
          </div>
        </a>
      </li>
      {{/each}}
  </script>
  <script>
        $(function(){
            $.ajax({
                url:'/index/nav.php',
                type:'post',
                dataType:'json',
                success:function(date){
                    var nav_left = {};
                    nav_left.data = date;
                    var html = template('nav_content',nav_left)
                    $('.nav').html(html)
                    $('.clicks').click(function(){
                    var id =$(this).attr('data-id');
                    $.ajax({
                      url:'/index/listcooki.php',
                      type:'post',
                      data:{id:id},
                      dataType:'text',
                      success:function(date){
                        // console.log(date);
                      }
                    })
                  })
                }
            })
            $.ajax({
                url:'/index/right.php',
                type:'post',
                dataType:'json',
                success:function(date){
                    var nav_right = {};
                    nav_right.right = date;
                    var html = template('right_content',nav_right)
                    $('.right_nav').html(html)
                }
            })
            $.ajax({
                url:'/index/rightcom.php',
                type:'post',
                dataType:'json',
                success:function(date){
                    var rightcom = {};
                      rightcom.com = date;
                    var html = template('right_com',rightcom)
                    $('.right_coms').html(html)
                }
            })
            
        })
  </script>
</head>
<body>

    <div class="header">
      <h1 class="logo"><a href="index.html"><img src="/assets/img/logo.png" alt=""></a></h1>
      <ul class="nav">
      </ul>
      <div class="search">
        <form>
          <input type="text" class="keys" placeholder="输入关键字">
          <input type="submit" class="btn" value="搜索">
        </form>
      </div>
      <div class="slink">
        <a href="javascript:;">链接01</a> | <a href="javascript:;">链接02</a>
      </div>
    </div>
    <div class="aside">
      <div class="widgets">
        <h4>搜索</h4>
        <div class="body search">
          <form>
            <input type="text" class="keys" placeholder="输入关键字">
            <input type="submit" class="btn" value="搜索">
          </form>
        </div>
      </div>
      <div class="widgets">
        <h4>随机推荐</h4>
        <ul class="body random right_nav">
        </ul>
      </div>
      <div class="widgets">
        <h4>最新评论</h4>
        <ul class="body discuz right_coms">
        </ul>
      </div>
    </div>
  </div>
</body>
</html>
