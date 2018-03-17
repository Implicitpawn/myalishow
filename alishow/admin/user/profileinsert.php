<?php
header('content-type:text/html;charset=utf8');
include_once './checksession.php';
mysql_connect('localhost','root','root');
mysql_query('set names utf8');
mysql_query('use alishow');
$name = $_SESSION['user_name'];
$sel = "select * from ali_user where user_name='$name'";
$sql = mysql_query($sel);
$sqls = mysql_fetch_assoc($sql);
echo json_encode($sqls);
// var_dump($sqls);