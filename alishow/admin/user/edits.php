<?php
header('content-type:text/htm;charset=utf8');
include_once './checksession.php';
mysql_connect('localhost','root','root');
mysql_query('set names utf8');
mysql_query('use alishow');
$id = $_POST['id'];
// echo $id;
$sel = "select * from ali_article where article_id=$id";
$sql = mysql_query($sel);
$sqls = mysql_fetch_assoc($sql);
echo json_encode($sqls);