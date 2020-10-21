<?php
     session_start();

    if($_SESSION['username'] == 'zhangsan' && $_SESSION['password'] == '123456'){
        echo '这是张三的session,可以登录';
    }else{
        echo '这不是张三的session,不可以登录';
    }

    var_dump($_SESSION);