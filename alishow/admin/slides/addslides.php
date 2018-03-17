<?php
header('content-type:text/html;charset=utf8');
include_once '../user/checksession.php';
mysql_connect('localhost','root','root');
mysql_query('set names utf8');
mysql_query('use alishow');
$isS = $_POST['isS'];
$state = '隐藏';
if($isS == 0) {
    $upload = '';
    if(!empty($_FILES['image'])) {
        $file = $_FILES['image'];
        if($file['error']==0) {
            $eit = strrchr($file['name'],'.');
            $upload = '../../uploads/'.date('YmdHis-',time()).rand(1000,9999).$eit;
            if(is_uploaded_file($file['tmp_name'])) {
                move_uploaded_file($file['tmp_name'],$upload);
            }
        }
    }
    if(!empty($_POST['text'])){
        $text = $_POST['text'];
    }
    if(!empty($_POST['link'])){
        $link = $_POST['link'];
    }
    $insert = "insert into ali_slides values(null,'$upload','$text','$link','$state')";
    if(mysql_query($insert)) {
        echo 1;
    }
}
if($isS == 1) {
    $id = $_POST['id'];
    $state = $_POST['states'];
    if($state == '显示') {
        $state = '隐藏';
    }
    else if($state == '隐藏') {
        $state = '显示';
    }
    $upd = "update ali_slides set slides_state ='$state' where slides_id ='$id'";
    if(mysql_query($upd)) {
        $select = "select * from ali_slides where slides_id=$id";
        $sql = mysql_query($select);
        $sqls = mysql_fetch_assoc($sql);
        echo $sqls['slides_state'];
    }
}
if($isS == 2) {
    $id = $_POST['id'];
    $del = "delete from ali_slides where slides_id =$id";
    if(mysql_query($del)) {
        echo 3;
    }
}