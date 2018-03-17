<?php
header('content-type:text/htm;charset=utf8');
include_once './checksession.php';
$user_name = $_SESSION['user_name'];
mysql_connect('localhost','root','root');
mysql_query('set names utf8');
mysql_query('use alishow');
// var_dump($_POST);
$id = $_POST['ids'];
$del = "delete from ali_article where article_id=$id";
if(mysql_query($del)) {
    echo 1;
}else {
    echo 2;
};