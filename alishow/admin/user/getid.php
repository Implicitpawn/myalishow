<?php
header('content-type:text/htm;charset=utf8');
include_once './checksession.php';
$id = $_POST['id'];
// echo $id;
// var_dump($_GET);
setcookie('id',$id);
