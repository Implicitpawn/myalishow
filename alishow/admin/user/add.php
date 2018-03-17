<?php
header('content-type:text/html;charset=utf8');
mysql_connect('localhost','root','root');
mysql_query('set names utf8');
mysql_query('use alishow');

$upload = '';
if(!empty($_FILES['pic'])) {
    $file = $_FILES['pic'];
    if($file['error'] ==0) {
        $eit = strrchr($file['name'],'.');
        $upload = '../../uploads/'.date('YmdHis-',time()).rand(1000,9999).$eit;
        if(is_uploaded_file($file['tmp_name'])){
            move_uploaded_file($file['tmp_name'],$upload);
        }
    }
}

// die;
$sel = "select * from ali_user";
$sql = mysql_query($sel);
$arr = [];
while($sqls = mysql_fetch_assoc($sql)) {
    $arr[] = $sqls;
}
$arr_name = [];
$arr_slug=[];
$arr_nickname=[];
//判断用户名是否存在
if(!empty($_POST['email'])) {
    $name = $_POST['email'];
    foreach($arr as $k => $l) {
        $names = $l['user_name'];
        $arr_name[] = $names;
    }
    // die($arr_name);
    if(!in_array($name,$arr_name)) {
        echo 1;
    }else {
        die('2');
    }
}

// die;
//判断别名是否存在
if(!empty($_POST['slug'])) {
    $slug = $_POST['slug'];
    foreach($arr as $k => $l) {
        $slugs = $l['user_slug'];
        $arr_slug[] = $slugs;
    }
    if(!in_array($slug,$arr_slug)) {
        echo 4;
    }else {
        die('3');
    }
}

//判断昵称是否存在
if(!empty($_POST['nickname'])) {
    $nickname = $_POST['nickname'];
    foreach($arr as $k => $l) {
        $nicknames = $l['user_nick'];
        $arr_nickname[] = $nicknames;
    }
    if(!in_array($nickname,$arr_nickname)) {
        echo 5;
    }else {
        die('6');
    }
}

//判断密码是否为空
if(!empty($_POST['password'])) {
    $password = $_POST['password'];

    if(!empty($password)) {
        echo 7;
    }else {
        die('8');
    }
}
if(!empty($_POST['state'])) {
    $state = $_POST['state'];
    $ins = "insert into ali_user values(null,'$name','$slug','$nickname',md5('$password'),'$upload','$state')";
    if(mysql_query($ins)){
        echo 9;
    }else {
        echo 10;
    }
}

?>