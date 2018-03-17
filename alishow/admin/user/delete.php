<?php
include_once "../user/checksession.php";
header('content-type:text/html;charset=utf8');
mysql_connect('localhost','root','root');
mysql_query('set names utf8');
mysql_query('use alishow');
$id = $_POST['id'];
$del = "delete from ali_user where user_id='$id'";
// die($id);
if(mysql_query($del)) {
    echo 1;
}else {
    echo 0;
}
?>