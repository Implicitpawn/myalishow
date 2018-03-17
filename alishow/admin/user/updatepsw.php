<?php
// include_once './checksession.php';
session_start();
if(empty($_SESSION)){
    die;
};
$name = $_SESSION['user_name'];
// echo $name;
mysql_connect('localhost','root','root');
mysql_query('set names utf8');
mysql_query('use alishow');
$sel = "select * from ali_user where user_name='$name'";
$sql = mysql_query($sel);
$sqls = mysql_fetch_assoc($sql);
// var_dump($sqls);
// die;
$old_psw = $sqls['user_psw'];
// echo $old_psw;
// echo md5($oldpsw);
// die;
if(!empty($_POST['oldpsw'])) {
    $oldpsw = $_POST['oldpsw'];
    if(md5($oldpsw)==$old_psw) {
        echo 1;
    }else{
        die('2');
    }
}
if(!empty($_POST['newpsw'])) {
    $newpsw = $_POST['newpsw'];
    $re_newpsw = md5($newpsw);
    $update = "update ali_user set user_psw='$re_newpsw' where user_name='$name'";
    $sql = mysql_query($update);
}

?>