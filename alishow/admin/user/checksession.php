<?php
header('content-type:text/html;charset=utf8');
session_start();
if(empty($_SESSION['user_name'])) {
    echo '请先登录';
    header('Refresh:2;url=/admin/login.html');
    die;
}
?>
