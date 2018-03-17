<?php
header('content-type:text/htm;charset=utf8');
include_once './checksession.php';
$user_name = $_SESSION['user_name'];
mysql_connect('localhost','root','root');
mysql_query('set names utf8');
mysql_query('use alishow');
if(empty($_POST['title']) or empty($_POST['content']) or empty($_POST['slug'])
or empty($_POST['category'])
or empty($_POST['status'])) {
    die('2');
}
$title = $_POST['title'];
$content = $_POST['content'];
$slug = $_POST['slug'];
$feature = $_POST['feature'];
$category = $_POST['category'];
$status = $_POST['status'];
$desc = substr($content,0,300);
$uptime = time();
$click = rand(5000,10000);
$good = rand(2000,4000);
$bad = rand(100,500);
$id=$_POST['id'];
//作者

// $sle = "select * from ali_user where user_name='$user_name'";
// $sqlsle = mysql_query($sle);
// $sel_result = mysql_fetch_assoc($sqlsle);
// $author = $sel_result['user_nick'];

//文件上传
// die ('1');
$upload = '';
$file = $_FILES['feature'];
if($file['error'] == 0) {
    $eit = strrchr($file['name'],'.');
    $upload = '../../uploads/'.date('YmdHis-',time()).rand(1000,9999).$eit;
    if(is_uploaded_file($file['tmp_name'])) {
        move_uploaded_file($file['tmp_name'],$upload);
        // echo '上传文件成功';
    }
}
// die('1');
$insert = "update ali_article set article_title='$title',article_slug='$slug',
article_content='$content',article_cateid='$category',aritcle_file='$upload',
aritcle_updtime='$uptime',aritcle_state='$status' where article_id=$id";
// var_dump(mysql_query($insert));
// die;
if(mysql_query($insert)){
    echo 1;
}else {
    echo 2;
}
