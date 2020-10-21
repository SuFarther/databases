<?php
   if($_COOKIE['username'] == 'zhangsan'){
       echo '我是张三的cookie,允许访问';
   }else{
       echo '我不是张三的cookie,拒绝访问';
   }

   var_dump($_COOKIE);