<?php
header('content-type:text/html;charset=utf8');
include_once './checksession.php';
mysql_connect('localhost','root','root');
mysql_query('set names utf8');
mysql_query('use alishow');
$name = $_SESSION['user_name'];
if(empty($_POST['slug'])) {
    die;
}
$slug = $_POST['slug'];
if(empty($_POST['nickname'])) {
    die;
}
$nickname = $_POST['nickname'];
$upd = "update ali_user set user_slug='$slug',user_nick = '$nickname' where user_name = '$name'";
$sql = mysql_query($upd);
if(mysql_affected_rows()>0) {
    echo 1;
}