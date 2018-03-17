<?php
header('content-type:text/html;charset');
$userCode = $_POST['code'];
session_start();
$sysCode = $_SESSION['code'];
echo $userCode == $sysCode ?1 :0;
?>