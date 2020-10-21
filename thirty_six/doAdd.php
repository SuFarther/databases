<?php
   $username = $_GET['username'];
   $password = md5($_GET['password']);
   $sex = $_GET['sex'];
   $age = $_GET['age'];


   $link = mysqli_connect('localhost','root','123456');
   if(!link){
       exit('数据库连接失败,请尝试');
   }

   mysqli_set_charset($link,'utf8mb4');

   mysqli_select_db($link,'test');


   $sql = "insert into shop_user(username,password,sex,age) values('$username','$password','$sex','$age')";
   echo $sql;

   $result = mysqli_query($link,$sql);


   if($result&&mysqli_affected_rows($link)){
       echo '新增成功<a href="userlist.php">返回</a>';
   }else{
       echo '新增失败';
   }


   mysqli_close($link);