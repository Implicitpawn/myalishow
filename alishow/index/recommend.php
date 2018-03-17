<?php
header('content-type:text/html;charset=utf8');
mysql_connect('localhost','root','root');
mysql_query('set names utf8');
mysql_query('use alishow');
$sel = "select * from ali_article order by aritcle_updtime desc limit 0,4";
// $sel = "select * from ali_article order by aritcle_click desc,aritcle_updtime desc limit 0,5";
$sql = mysql_query($sel);
$arr_hot =[];
while($sqls = mysql_fetch_assoc($sql)) {
    $arr_hot[] =$sqls;
}
echo json_encode($arr_hot);