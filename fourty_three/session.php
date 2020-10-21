<?php
   //调用session时,必须要开启session
   session_start();

   //设置session的值
   $_SESSION['username'] = 'zhangsan';
   $_SESSION['password'] = 'password';


   //销毁某个键
   unset($_SESSION['username']);

   //销毁session的生命周期
   session_destroy();

   var_dump($_SESSION);