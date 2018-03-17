<?php
    header('content-type:text/html;charset=utf8');
    mysql_connect('localhost','root','root');
    mysql_query('set names utf8');
    mysql_query('use alishow');
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $class = $_POST['class'];
    $status = $_POST['status'];
    $show = $_POST['show'];
    $insert = "insert into ali_cate values(null,'$name',' $slug','$class','$status','$show')";
    if(mysql_query($insert)) {
        header("location:/cate/categories.php");
    }else{
        echo '添加失败';
        header('refresh:2;url:add.php');
    };
?>