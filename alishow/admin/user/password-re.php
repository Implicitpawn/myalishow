<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Password reset &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
    <?php include_once '../user/checksession.php'?>
  <script>NProgress.start()</script>

  <div class="main">
    <?php include_once '../common/nav.php'?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>修改密码</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <form class="form-horizontal">
        <div class="form-group">
          <label for="old" class="col-sm-3 control-label">旧密码</label>
          <div class="col-sm-7">
            <input id="old" class="form-control" name='oldpsw' type="password" placeholder="旧密码">
            <span id="oldpsw_test" style="color:red"></span>
          </div>
        </div>
        <div class="form-group">
          <label for="password" class="col-sm-3 control-label">新密码</label>
          <div class="col-sm-7">
            <input id="password" class="form-control" name='newpsw' type="password" placeholder="新密码">
            <!-- <span id="newpsw_test" style="color:red"></span> -->
          </div>
        </div>
        <div class="form-group">
          <label for="confirm" class="col-sm-3 control-label">确认新密码</label>
          <div class="col-sm-7">
            <input id="confirm" class="form-control" name='re-newpsw' type="password" placeholder="确认新密码">
            <span id="re_newpsw_test" style="color:red"></span>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-7">
            <input type="submit" class="btn btn-primary" value="修改密码" id="inp">
            <!-- <button type="submit" class="btn btn-primary">修改密码</button> -->
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../common/aside.php'?>
  </div>

  <script src="/assets/vendors/jquery/jquery.js"></script>
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
  <script>
      $(function() {
          var oldpsw = $('#old').val();
          
          var re_newpsw = $('#confirm').val();
          $('#old').blur(function(){
            var oldpsw = $('#old').val();
            $.ajax({
                url:'./updatepsw.php',
                type:'post',
                data:{oldpsw:oldpsw},
                dataType:'text',
                success:function(result) {
                  console.log(result)
                    if(result==1) {
                      $('#oldpsw_test').html('正确');
                    }else {
                      $('#oldpsw_test').html('输入密码错误');
                    }
                }
            })
          })
          $('#confirm').blur(function(){
            var newpsw = $('#password').val();
            var re_newpsw = $('#confirm').val();
            // console.log(newpsw.length)
            if(newpsw.length!=0) {
              if(newpsw===re_newpsw) {
                $('#re_newpsw_test').html('两次输入密码一致');
                $('#inp').click(function() {
                  var newpsw = $('#password').val();
                  $.ajax({
                      url:'./updatepsw.php',
                      type:'post',
                      data:{newpsw:newpsw},
                      dataType:'text',
                      success:function(result) {
                        console.log(result)
                      }
                  })
                })
              }else{
                $('#re_newpsw_test').html('两次输入密码不一致');
              }
            }
            
          })
          // $('#old').blur(function(){
          //   var oldpsw = $('#confirm').val();
          // })
      })
  </script>
</body>
</html>
