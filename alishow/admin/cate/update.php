<?php
    header('content-type:text/html;charset=utf8');
    header('content-type:text/html;charset=utf8');
    mysql_connect('localhost','root','root');
    mysql_query('set names utf8');
    mysql_query('use alishow');
    $id = $_POST['id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $class = $_POST['class'];
    $status = $_POST['status'];
    $show = $_POST['show'];
    $upda = "update ali_cate set cate_name='$name',cate_slug='$slug',cate_class='$class',cate_status='$status',cate_show='$show' where cate_id='$id'";
    if(mysql_query($upda)) {
        header('location:/admin/cate/categories.php');
        // echo '删除成功';
    }else {
        echo '修改失败';
        header('refresh:2;url:idea.php');
    }
?>