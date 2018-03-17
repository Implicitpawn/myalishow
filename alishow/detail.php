<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>阿里百秀-发现生活，发现美!</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.css">
  <script src="/assets/vendors/jquery/jquery-1.12.2.js"></script>
  <script src="/assets/vendors/art-template/template-web.js"></script>
  <script type="text/html" id="detail">
        <div class="breadcrumb">
          <dl>
            <dt>当前位置：</dt>
            <dd><a href="javascript:;">{{detail.article_cateid}}</a></dd>
            <dd>{{detail.article_title}}</dd>
          </dl>
        </div>
        <h2 class="title">
          <a href="javascript:;">{{@detail.article_content}}</a>
        </h2>
        <div class="meta">
          <span>{{detail.article_author}} 发布于 {{detail.aritcle_addtime}}</span>
          <span>分类: <a href="javascript:;">{{detail.article_cateid}}</a></span>
          <span>阅读: ({{detail.aritcle_click}})</span>
          <span>评论: ({{detail.num}})</span>
      </div>
  </script>
    <script type="text/html" id="recom">
    {{each recom}}
        <li>
        <a href="javascript:;">
            <img src="/admin/user/{{$value.aritcle_file}}" alt="">
            <span>{{$value.article_title}}</span>
        </a>
        </li>
        {{/each}}
    </script>
  <script>
        $(function(){
            $.ajax({
                
                url:'./index/dedails.php',
                dataType:'json',
                success:function(date){
                    console.log(date)
                    var details = {};
                    details.detail = date;
                    var html = template('detail',details);
                    $('.article').html(html);
                }
            })
            $.ajax({
                url:'./index/recommend.php',
                dataType:'json',
                success:function(date){
                    // console.log(date)
                    var recoms = {};
                    recoms.recom = date;
                    var html = template('recom',recoms);
                    $('.recommend').html(html);
                }
            })
        })
  </script>
</head>
<body>
  <div class="wrapper">
    <?php include_once '/admin/common/left.php'?>
    <div class="content">
     <div class="article">

      </div>

      <div class="panel hots">
        <h3>热门推荐</h3>
        <ul class="recommend">
          <!-- <li>
            <a href="javascript:;">
              <img src="uploads/hots_2.jpg" alt="">
              <span>星球大战:原力觉醒视频演示 电影票68</span>
            </a>
          </li> -->
        </ul>
      </div>
    </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>
</body>
</html>
