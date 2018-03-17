<?php
include_once "../user/checksession.php";
header('content-type:text/html;charset=utf8');
mysql_connect('localhost','root','root');
mysql_query('set names utf8');
mysql_query('use alishow');
$id = $_GET['id'];
$del = "delete from ali_cate where cate_id='$id'";
if(mysql_query($del)) {
    header('location:/cate/categories.php');
    echo '删除成功';
}
?>