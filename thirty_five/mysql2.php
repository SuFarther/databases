<?php
   $link  = mysqli_connect('localhost','root','123456');

   if(!$link){
       echo '数据库连接失败,请尝试';
   }else{
       echo '连接成功';
   }

   mysqli_set_charset($link,'utf8mb4');


   mysqli_select_db($link,'test');

//   $sql = "select  * from shop_user";
   $sql = "insert into  shop_user values(6,'小池','123456',0,18)";

   $obj = mysqli_query($link,$sql);

   // mysqli_fetch_assoc($obj) 返回一个关联数组
   // mysqli_fetch_row($obj) 返回一个索引数组
   // mysqli_fetch_array($obj) 返回一个既有关联数组和一个索引数组
   // mysqli_num_rows($obj); 返回查询结果集的总条数
   // mysqli_affected_rows($link) 返回你修改的,删除,添加的时候受影响的行数
   // mysqli_insert_id($link); 返回的是你插入的当前自增的id

//    var_dump(mysqli_affected_rows($link));
      var_dump(mysqli_insert_id($link));
//   while($rows = mysqli_affected_rows($obj)){
//       var_dump($rows);
//   }

   mysqli_close($link);