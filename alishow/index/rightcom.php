<?php
header('content-type:text/html;charset=utf8');
mysql_connect('localhost','root','root');
mysql_query('set names utf8');
mysql_query('use alishow');
$sel = "select numbers_id,comments_nick,numbers_content,article_title,numbers_time,numbers_state,user_id from ali_numbers
join ali_comments on numbers_memid = comments_id
join ali_user on numbers_userid = user_id
join ali_article on numbers_articleid = article_id";
$sql = mysql_query($sel);
$arr_com = [];
while($sqls = mysql_fetch_assoc($sql)) {
    $sqls['numbers_time'] = date('Y/m/d H:i:s',$sqls['numbers_time']);
    $arr_com[] = $sqls;
}
echo json_encode($arr_com);