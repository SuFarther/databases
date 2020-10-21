<?php

    $id = $_GET['id']; //获取到你要的id

//    echo $id;

    $link  = mysqli_connect('localhost','root','123456');

    if(!$link){
        echo '数据库连接失败!请尝试';
    }else{
        echo '数据库连接成功'.'<br/>';
    }


    mysqli_set_charset($link,'utf8mb4');

    mysqli_select_db($link,'test');


    $sql ="delete from shop_user where id=$id";

    $boolean = mysqli_query($link,$sql);

    echo '你确定要删除id为:'.$id.'数据吗？';
    if($boolean &&  mysqli_affected_rows($link)){
        echo '删除成功<a href="userlist.php">返回</a>';
    }else{
        echo '删除失败';
    }

    mysqli_close($link);