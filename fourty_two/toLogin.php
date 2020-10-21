<?php
   $username = "zhangsan";
   $password = '123456';


   if($username == $_GET['username'] && $password == $_GET['password']){
       setcookie('username',$username,time()+60,'/');
       echo '登录成功';
   }else{
       echo '登录失败';
   }

   var_dump($_COOKIE);