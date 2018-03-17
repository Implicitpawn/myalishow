<?php
mysql_connect('localhost','root','root');
mysql_query('set names utf8');
mysql_query('use letao');
$sel = "select * from user";
$sql = mysql_query($sel);
$sqls = mysql_fetch_assoc($sql);
var_dump($sqls);