<?php

   session_start();

   $username =  $_GET['username'];
   $password =  $_GET['password'];


   if($username == 'zhangsan' && $password == '123456'){
       $_SESSION['username'] = $username;
       $_SESSION['password'] = $password;
       echo '登录成功';
   }else{
       echo '登录失败';
   }

   var_dump($_SESSION);