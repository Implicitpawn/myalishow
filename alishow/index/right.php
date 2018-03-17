<?php
header('content-type:text/html;charset=utf8');
// include_once '../user/checksession.php';
mysql_connect('localhost','root','root');
mysql_query('set names utf8');
mysql_query('use alishow');
$sel = "select * from ali_article order by rand() limit 0,5";
$sql = mysql_query($sel);
$arr_article = [];
while($sqls = mysql_fetch_assoc($sql)) {
    $arr_article[] = $sqls;
}
echo json_encode($arr_article);