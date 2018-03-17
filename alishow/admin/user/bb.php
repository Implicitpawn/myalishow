<?php
header('content-type:text/html;charset=utf8');
mysql_connect('localhost','root','root');
mysql_query('set names utf8');
mysql_query('use alishow');
// var_dump($_POST);
// echo $_POST['pic'];
$pic = $_POST['pic'];
$file = $_FILES['pic'];
var_dump($file);
// echo formData.get("nickname");
// echo 1;