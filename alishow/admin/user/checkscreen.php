<?php
header('content-type:text/htm;charset=utf8');
include_once './checksession.php';
mysql_connect('localhost','root','root');
mysql_query('set names utf8');
mysql_query('use alishow');
$cateid = $_POST['category'];
$state = $_POST['state'];
$pageval = isset($_POST['pageval'])>0 ?$_POST['pageval'] :1;
$pagesize = 2;
$offset = ($pageval-1)*$pagesize;
if($cateid == 0 && $state==0) {
    $where = '';
}
else if($cateid==0 && $state!== 0) {
    if($state==1) {
        $state ="草稿";
        $where = "where aritcle_state='$state'";
    }else if($state==2) {
        $state ="已发布";
        $where = "where aritcle_state='$state'";
    }
}else if($cateid !==0 && $state== 0) {
    $cate_sel = "select * from ali_cate where cate_id='$cateid'";
    $cate = mysql_query($cate_sel);
    $cates = mysql_fetch_assoc($cate);
    $cateid = $cates['cate_name'];
    $where = "where article_cateid='$cateid'";
}else if($cateid!==0 && $state!==0) {
    if($state==1) {
        $state ="草稿";
        $where = "where aritcle_state='$state'";
    }else if($state==2) {
        $state ="已发布";
        $where = "where aritcle_state='$state' ";
    }
    $cate_sel = "select * from ali_cate where cate_id='$cateid'";
    $cate = mysql_query($cate_sel);
    $cates = mysql_fetch_assoc($cate);
    $cateid = $cates['cate_name'];
    $where .= "and article_cateid='$cateid'";
}
$count = "select count(*) as num from ali_article $where";
$num = mysql_query($count);
$nums = mysql_fetch_assoc($num);
$counts = ceil($nums['num']/$pagesize);
echo $counts;