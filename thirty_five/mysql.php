<?php
   $link  = mysqli_connect('localhost','root','123456');

   if(!$link){
       echo '数据库连接失败,请尝试';
   }else{
       echo '连接成功';
   }

   mysqli_set_charset($link,'utf8mb4');


   mysqli_select_db($link,'test');

   $sql = "select  * from shop_user";

   $obj = mysqli_query($link,$sql);


   while($rows = mysqli_fetch_assoc($obj)){
       var_dump($rows);
   }

   mysqli_close($link);