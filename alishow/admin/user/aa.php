<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
    <link rel="stylesheet" href="/assets/css/admin.css">
    <script src="/assets/vendors/nprogress/nprogress.js"></script>
    <script src="/assets/vendors/jquery/jquery.min.js"></script>
    <script>
        $(function() {
           
            $('#nickname').blur(function () {
                var pic = $('#pic')[0].files;
                // function getAdd() {
                //     pic = document.querySelector('#pic').files;
                    console.log(pic);
                // }
                var nickname = $('#nickname').val();
                // var myaa = $('form');
                // var pic = $('#pic').files[0];
                var fm = new FormData(myaa);
                // var pic = document.myaa.pic.file[0];
                // var aa = formData.get('aa')
                fm.append('nickname',nickname);
                fm.append('pic',pic);
                // fm.get("aa");
                console.log(fm.get("nickname"));
                // fm.append('pic', pic);
                // location.href = 'http://www.alishow.com/admin/user/bb.php';
                $.ajax(
                    {
                        url:'./bb.php',
                        type:'post',
                        data:fm,
                        contentType:false, //禁止设置请求类型
                        processData:false, //禁止jquery对DAta数据的处理,默认会处理
                        //禁止的原因是,FormData已经帮我们做了处理
                        // dataType:'text',
                        success: function (result){
                            //测试是否成功
                            //但需要你后端有返回值
                            // location.href = 'http://www.alishow.com/admin/user/bb.php';
                            console.log(result);
                        }
                    }
                );
            }); 
        })
       
    </script>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data" name="myaa">
        <div class="form-group">
            <label for="nickname">昵称</label>
            <input id="nickname" class="form-control" name="nickname" type="text" placeholder="昵称">
        </div>
        <div class="form-group">
            <label for="pic">头像上传</label>
            <input id="pic" class="form-control" name="pic" type="file">
        </div>
        <div class="form-group">
            <input type="submit" value="提交" class="sub">
        </div>
    </form>
    <!-- <script>
        function getAdd() {
                var pic = document.querySelector('#pic').files;
                console.log(pic);
            }
    </script> -->
</body>
</html>
