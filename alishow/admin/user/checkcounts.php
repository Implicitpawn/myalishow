<?php
header('content-type:text/htm;charset=utf8');
include_once './checksession.php';
mysql_connect('localhost','root','root');
mysql_query('set names utf8');
mysql_query('use alishow');
$pageval = isset($_POST['pageval'])>0 ?$_POST['pageval'] :1;
$pagesize = 2;
$offset = ($pageval-1)*$pagesize;
$count = "select count(*) as num from ali_article";
$num = mysql_query($count);
$nums = mysql_fetch_assoc($num);
$counts = ceil($nums['num']/$pagesize);
echo $counts;