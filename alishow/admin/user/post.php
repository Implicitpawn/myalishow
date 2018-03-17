<?php
header('content-type:text/html;charset=utf8');
session_start();
if(empty($_SESSION['user_name'])){
    die;
}
mysql_connect('localhost','root','root');
mysql_query('set names utf8');
mysql_query('use alishow');
$sel = "select * from ali_cate";
$sql = mysql_query($sel);
$cate_arr = [];
while($sql_cate = mysql_fetch_assoc($sql)) {
    $cate_arr[] = $sql_cate;
}
$cate_json = json_encode($cate_arr);
// echo 'cate'.'{'.json_encode($cate_json).'}';
echo $cate_json;