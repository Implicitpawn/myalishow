<?php
header('content-type:text/html;charset=utf8');
include_once '../user/checksession.php';
mysql_connect('localhost','root','root');
mysql_query('set names utf8');
mysql_query('use alishow');
$str = $_POST['str'];
$isS = $_POST['isS'];
if($isS==0) {
    $upd = "update ali_numbers set numbers_state = '批准' where numbers_id in ($str)";
    mysql_query($upd);
    $num = mysql_affected_rows();
    if($num > 0) {
        echo 1;
    }
}
if($isS==1) {
    $upd = "update ali_numbers set numbers_state = '驳回' where numbers_id in ($str)";
    mysql_query($upd);
    $num = mysql_affected_rows();
    if($num > 0) {
        echo 1;
    }
}
if($isS==2) {
    $delete = "delete from ali_numbers where numbers_id in ($str)";
    mysql_query($delete);
    $num = mysql_affected_rows();
    if($num > 0) {
        echo 1;
    }
}
