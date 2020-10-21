<?php

    $id = $_GET['id'];


    $link  = mysqli_connect('localhost','root','123456');

    if(!$link){
        exit("数据库连接失败,请尝试");
    }


    mysqli_set_charset($link,'utf8mb4');

    mysqli_select_db($link,'test');

  $sql = "select * from shop_user where id = $id";


    $res = mysqli_query($link,$sql);


    $result = mysqli_fetch_assoc($res);
    var_dump($result);


    mysqli_close($link);

?>


<form action="doUpdate.php" >
    <input type="hidden" value="<?php echo $id;?>" name="id"/><br/>
    用户名：<input type="text" value="<?php echo $result['username'];?>" name="username"/><br/>
    密码: <input type="password" value="<?php echo $result['password'];?>" name="password"/><br/>
    性别: <input type="text" value="<?php echo  $result['sex'];?>" name="sex" /><br/>
    年龄：<input type="text" value="<?php echo $result['age'];?>" name="age"/><br/>
    <input type="submit" value="执行修改"/>
</form>

