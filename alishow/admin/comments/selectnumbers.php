<?php
header('content-type:text/html;charset=utf8');
include_once '../user/checksession.php';
mysql_connect('localhost','root','root');
mysql_query('set names utf8');
mysql_query('use alishow');
$sel = "select numbers_id,comments_nick,numbers_content,article_title,numbers_time,numbers_state,user_id from ali_numbers
        join ali_comments on numbers_memid = comments_id
        join ali_user on numbers_userid = user_id
        join ali_article on numbers_articleid = article_id";
$sql = mysql_query($sel);
$sel_arr = [];
while($sqls = mysql_fetch_assoc($sql)) {
    $sqls['numbers_time'] = date('Y-m-d  H:s:i');
    if($sqls['numbers_state'] == '批准') {
        $sqls['click_state'] = '驳回';
        $sel_arr[] = $sqls;
    }else {
        $sqls['click_state'] = '批准';
        $sel_arr[] = $sqls;
    }
}
echo json_encode($sel_arr);