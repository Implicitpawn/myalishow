<?php
header('content-type:text/html;charset=utf8');
mysql_connect('localhost','root','root');
mysql_query('set names utf8');
mysql_query('use alishow');
$id = $_COOKIE['listidss'];
$sel = "select article_id,article_content,aritcle_file,aritcle_click,article_desc,aritcle_good,article_cateid,article_title,aritcle_addtime,article_author,b.num from ali_article a  
left JOIN (select numbers_articleid,count(*) as num from ali_numbers group by numbers_articleid) b
on b.numbers_articleid=a.article_id where a.article_id='$id'";
$sql = mysql_query($sel);
$sqls = mysql_fetch_assoc($sql);
if($sqls['num']==null) {
    $sqls['num']=0;
}
$sqls['aritcle_addtime'] = date('Y/m/d H:i:s',$sqls['aritcle_addtime']);
$sqls['aritcle_desc'] = str_repeat($sqls['article_title'],10);
echo json_encode($sqls);