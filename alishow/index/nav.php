<?php
header('content-type:text/html;charset=utf8');
// include_once '../user/checksession.php';
mysql_connect('localhost','root','root');
mysql_query('set names utf8');
mysql_query('use alishow');
$sel = "select * from ali_cate";
$sql = mysql_query($sel);
$arr_cate = [];
while($sqls = mysql_fetch_assoc($sql)) {
    $arr_cate[] = $sqls;
}
echo json_encode($arr_cate);