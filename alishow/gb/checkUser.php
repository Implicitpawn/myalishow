<?php
header('content-type:text/html;charset=utf8');
mysql_connect('localhost','root','root');
mysql_query('set names utf8');
mysql_query('use alishow');
// var_dump($_POST);
// echo 1;
$name = $_POST['email'];
$psw = $_POST['psw'];
$code = $_POST['code'];
// echo $name.$psw.$code;
$sel = "select * from ali_user where user_name='$name'";
$sql = mysql_query($sel);
if(!$sql || mysql_affected_rows()==0) {
    die('1');
}
$sqls = mysql_fetch_assoc($sql);
$syspsw = $sqls['user_psw'];
if(md5($psw)!==$syspsw) {
    die('2');
}
session_start();
$sysCode = $_SESSION['code'];
if($code !== $sysCode) {
    die('3');
};
$_SESSION['user_name'] = $sqls['user_name'];
$_SESSION['user_psw'] = $sqls['user_psw'];
echo '4';


// var_dump(mysql_affected_rows());
?>