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
    <script type="text/html" id="swipess">
        {{each slide}}
        <li>
          <a href="{{$value.slides_links}}">
            <img src="/admin/user/{{$value.slides_pic}}">
            <span>{{$value.slides_desc}}</span>
          </a>
        </li>
        {{/each}}
    </script>
    <script type="text/html" id="blurs">
        {{each blur}}
        <li>
          <a href="javascript:;">
            <img src="/admin/user/{{$value.aritcle_file}}" alt="">
            <span>{{$value.article_title}}</span>
          </a>
        </li>
        {{/each}}
    </script>
    <script type="text/html" id="hot">
      {{each hot}}
        <li>
          <i>{{$index+1}}</i>
          <a href="javascript:;">{{$value.article_title}}</a>
          <a href="javascript:;" class="like">赞({{$value.aritcle_good}})</a>
          <span>阅读 ({{$value.aritcle_click}})</span>
        </li>
      {{/each}}
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
    <script type="text/html" id="release">
        {{each release}}
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
                分类：<span>{{$value.article_author}}</span>
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
        $(function() {
          $.ajax({
            url:'./index/swipes.php',
            dataType:'json',
            success:function(date){
              // console.log(date)
              var slides = {};
              slides.slide = date;
              var html = template('swipess',slides);
              $('.swipe-wrapper').html(html)
              var swiper = Swipe(document.querySelector('.swipe'), {
                auto: 3000,
                transitionEnd: function (index) {
                  $('.cursor span').eq(index).addClass('active').siblings('.active').removeClass('active');
                }
              });
              // 上/下一张
              $('.swipe .arrow').on('click', function () {
                var _this = $(this);
                if(_this.is('.prev')) {
                  swiper.prev();
                } else if(_this.is('.next')) {
                  swiper.next();
                }
              })
            }
          })
          $.ajax({
            url:'./index/blur.php',
            dataType:'json',
            success:function(date){
              // console.log(date)
              var blurs = {};
              blurs.blur = date;
              var html = template('blurs',blurs);
              $('.blurss').html(html);
              $('.blurss>li').first('li').addClass('large');
            }
          })
          $.ajax({
            url:'./index/hot.php',
            dataType:'json',
            success:function(date){
              // console.log(date)
              var hots = {};
              hots.hot = date;
              var html = template('hot',hots);
              $('.hot_art').html(html);
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
          $.ajax({
            url:'./index/release.php',
            dataType:'json',
            success:function(date){
              console.log(date)
              var releases = {};
              releases.release = date;
              var html = template('release',releases);
              var oldhtml = $('.releases').html();
              $('.releases').html(oldhtml+html);
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
<!-- <script>NProgress.start()</script> -->
  <div class="wrapper">
    <?php include_once './admin/common/left.php'?>
    <div class="content">
      <div class="swipe">
        <ul class="swipe-wrapper">
          <!-- <li>
            <a href="#">
              <img src="uploads/slide_1.jpg">
              <span>XIU主题演示</span>
            </a>
          </li> -->
        </ul>
        <p class="cursor"><span class="active"></span><span></span><span></span><span></span></p>
        <a href="javascript:;" class="arrow prev"><i class="fa fa-chevron-left"></i></a>
        <a href="javascript:;" class="arrow next"><i class="fa fa-chevron-right"></i></a>
      </div>
      <div class="panel focus">
        <h3>焦点关注</h3>
        <ul class="blurss">
        </ul>
      </div>
      <div class="panel top">
        <h3>一周热门排行</h3>
        <ol class="hot_art">
          <!-- <li>
            <i>1</i>
            <a href="javascript:;">你敢骑吗？全球第一辆全功能3D打印摩托车亮相</a>
            <a href="javascript:;" class="like">赞(964)</a>
            <span>阅读 (18206)</span>
          </li> -->
        </ol>
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
      <div class="panel new releases">
        <h3>最新发布</h3>
        <!-- <div class="entry">
          <div class="head">
            <span class="sort">会生活</span>
            <a href="javascript:;">星球大战：原力觉醒视频演示 电影票68</a>
          </div>
          <div class="main">
            <p class="info">admin 发表于 2015-06-29</p>
            <p class="brief">星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯</p>
            <p class="extra">
              <span class="reading">阅读(3406)</span>
              <span class="comment">评论(0)</span>
              <a href="javascript:;" class="like">
                <i class="fa fa-thumbs-up"></i>
                <span>赞(167)</span>
              </a>
              <a href="javascript:;" class="tags">
                分类：<span>星球大战</span>
              </a>
            </p>
            <a href="javascript:;" class="thumb">
              <img src="uploads/hots_2.jpg" alt="">
            </a>
          </div>
        </div> -->
      </div>
    </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>
  <!-- <script src="assets/vendors/jquery/jquery.js"></script> -->
  <script src="assets/vendors/swipe/swipe.js"></script>
  <script>
    //
   
  </script>
  <!-- <script>NProgress.done()</script> -->
</body>
</html>
