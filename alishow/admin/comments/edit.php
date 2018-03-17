<?php
header('content-type:text/html;charset=utf8');
include_once '../user/checksession.php';
mysql_connect('localhost','root','root');
mysql_query('set names utf8');
mysql_query('use alishow');

// echo $contents;
$isS = $_POST['isS'];
$id = $_POST['id'];
if($isS == 0) {
    $contents = $_POST['contents'];
    $upd = "update ali_numbers set numbers_state='$contents' where numbers_id='$id'";
    mysql_query($upd);
    if(mysql_query($upd)) {
        echo 1;
    }
}
if($isS == 1) {
    $delete = "delete from ali_numbers where numbers_id = $id";
    mysql_query($delete);
    if(mysql_query($delete)) {
        echo 2;
    }
}

