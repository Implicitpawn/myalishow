<?php include_once '../user/checksession.php'?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Users &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
  <script src="/assets/vendors/jquery/jquery.min.js"></script>
  <script>
      $(function() {
          $('.sub').click(function() {
            console.log(987654)
              var name = $('#email').val();
              var slug = $('#slug').val();
              var nickname = $('#nickname').val();
              var password = $('#password').val();
              var state = $('#state').val();
              var pic = $('#pic')[0].files;
              var fm = new FormData(ppp);
              fm.append('email',name);
              fm.append('slug',slug);
              fm.append('nickname',nickname);
              fm.append('password',password);
              fm.append('state',state);
              fm.append('pic',pic);
              $.ajax({
                  url:'./add.php',
                  type:'post',
                  data:fm,
                  dataType:'text',
                  contentType:false, //禁止设置请求类型
                  processData:false, //禁止jquery对DAta数据的处理,默认会处理
                  //禁止的原因是,FormData已经帮我们做了处理
                  success:function(date) {
                    console.log(date)
                    if(date==14579) {
                      // console.log(123)
                      alert('注册成功');
                      location.href="./users.php";
                    }
                    else if(date==10) {
                      alert('注册失败')
                    }
                    
                  }
              })
          })
      
          $('#email').blur(function(){
            var name = $('#email').val();
            $.ajax({
                  url:'./add.php',
                  type:'post',
                  data:{email:name,
                  },
                  datatype:'text',
                  success:function(date) {
                    console.log(date)
                    if(date==1) {
                      $('#imail_testing').html('邮箱可用');
                    }
                    else if(date==2) {
                      $('#imail_testing').html('邮箱已存在');
                    }
                  }
          })
        })
          $('#slug').blur(function(){
            
            var slug = $('#slug').val();
            $.ajax({
                  url:'./add.php',
                  type:'post',
                  data:{slug:slug
                  },
                  datatype:'text',
                  success:function(date) {
                    console.log(date)
                    if(date==3) {
                      $('#slug_testing').html('别名已存在');
                    }
                    else if(date==4) {
                      $('#slug_testing').html('别名可用');
                    }
                  }
          })
        })
          $('#nickname').blur(function(){
            var nickname = $('#nickname').val();
            $.ajax({
                  url:'./add.php',
                  type:'post',
                  data:{nickname:nickname
                  },
                  datatype:'text',
                  success:function(date) {
                    console.log(date);
                    if(date==5) {
                      $('#nickname_testing').html('昵称可用');
                    }
                    else if(date==6) {
                      $('#nickname_testing').html('昵称已存在');
                    }
                  }
          })
        })
          $('#password').blur(function(){
            var password = $('#password').val();
            $.ajax({
                  url:'./add.php',
                  type:'post',
                  data:{password:password
                  },
                  datatype:'text',
                  success:function(date) {
                   if(date==7) {
                      $('#password_testing').html('密码格式正确');
                    }
                    else if(date==8) {
                      $('#password_testing').html('密码不能为空');
                    }
                  }
          })
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
        <h1>用户</h1>
      </div>
      <div class="row">
        <div class="col-md-4">
          <form action="" method="POST" enctype="multipart/form-data" name="ppp">
          <h1 id="detection" style="color:red"></h1>
            <a href="./users.php">查看目录</a>
            <div class="form-group">
              <label for="email">邮箱</label>
              <input id="email" class="form-control" name="email" type="email" placeholder="邮箱">
              <span id="imail_testing" style="color:red"></span>
            </div>
            <div class="form-group">
              <label for="slug">别名</label>
              <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
              <span id="slug_testing" style="color:red"></span>
            </div>
            <div class="form-group">
              <label for="nickname">昵称</label>
              <input id="nickname" class="form-control" name="nickname" type="text" placeholder="昵称">
              <span id="nickname_testing" style="color:red"></span>
            </div>
            <div class="form-group">
              <label for="password">密码</label>
              <input id="password" class="form-control" name="password" type="text" placeholder="密码">
              <span id="password_testing" style="color:red"></span>
            </div>
            <div class="form-group">
              <label for="state">是否激活：</label>
              <input id="state"  name="state" type="radio" checked>激活
              <input id="state"  name="state" type="radio">不激活
            </div>
            <div class="form-group">
              <label for="pic">头像上传</label>
              <input id="pic" class="form-control" name="pic" type="file">
            </div>
            <div class="form-group">
              <input type="button" class="btn btn-primary sub" value="添加">
              <!-- <button class="btn btn-primary sub" type="submit">添加</button> -->
            </div>
          </form>
        </div>
        <div class="col-md-8">
          <div class="page-action">
            <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="aside">
    <?php include_once "../common/aside.php"?>
  </div>
  <script>NProgress.done()</script>
</body>
</html>
<!-- var formData = new FormData();
var name = $("input").val();
formData.append("file",$("#upload")[0].files[0]);
formData.append("name",name);
$.ajax({ 
url : Url, 
type : 'POST', 
data : formData, 
// 告诉jQuery不要去处理发送的数据
processData : false, 
// 告诉jQuery不要去设置Content-Type请求头
contentType : false,
beforeSend:function(){
console.log("正在进行，请稍候");
},
success : function(responseStr) { 
if(responseStr.status===0){
console.log("成功"+responseStr);
}else{
console.log("失败");
}
}, 
error : function(responseStr) { 
console.log("error");
} 
}); -->



<!-- $('#btn').click(function () {
    var userName = document.myForm.userName.value;
    var img = document.myForm.img.files[0];

    var fm = new FormData();
    fm.append('userName', userName);
    fm.append('img', img);
    $.ajax(
        {
            url: 'submitform.php',
            type: 'POST',
            data: fm,
            contentType: false, //禁止设置请求类型
            processData: false, //禁止jquery对DAta数据的处理,默认会处理
            //禁止的原因是,FormData已经帮我们做了处理
            success: function (result) {
                //测试是否成功
                //但需要你后端有返回值
                alert(result);
            }
        }
    );
}); -->