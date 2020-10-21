<?php
    $id = $_GET['id'];
    $username = $_GET['username'];
    $password = $_GET['password'];
    $sex = $_GET['sex'];
    $age = $_GET['age'];


   $link = mysqli_connect('localhost','root','123456');


   if(!$link){
       exit('连接数据库失败,请尝试');
   }

   mysqli_set_charset($link,'utf8mb4');

   mysqli_select_db($link,'test');

   $sql = "update  shop_user set username='$username',password ='$password',
   sex='$sex',age='$age'where id=$id";

//   echo $sql;

   $result =  mysqli_query($link,$sql);

   if($result && mysqli_affected_rows($link)){
       echo '修改成功<a href="userlist.php">返回</a>';
   }else{
       echo '修改失败';
   }


   mysqli_close($link);

