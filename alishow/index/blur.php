<?php
header('content-type:text/html;charset=utf8');
mysql_connect('localhost','root','root');
mysql_query('set names utf8');
mysql_query('use alishow');
$sel = "select * from ali_article where article_blur='添加焦点' limit 0,5";
$sql = mysql_query($sel);
$arr_blur = [];
while($sqls = mysql_fetch_assoc($sql)) {
    $arr_blur[] = $sqls;
}
echo json_encode($arr_blur);