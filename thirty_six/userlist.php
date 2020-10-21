<?php
$page = empty($_GET['page'])?1:$_GET['page'];
$link  = mysqli_connect('localhost','root','123456');

if(!$link){
    echo '数据库连接失败!请尝试';
}else{
    echo '数据库连接成功';
}


mysqli_set_charset($link,'utf8mb4');

mysqli_select_db($link,'test');


//--------分页开始-----------
$sql = "select count(*) as  count from shop_user";
$result = mysqli_query($link,$sql); //发送sql语句
$pageResult = mysqli_fetch_assoc($result); //返回分页结果集
$count = $pageResult['count']; //总条数
$num = 5; //每页分页为5条数据
$pageCount = ceil($count / $num); //根据总条数和每页的页数算出总页数
$offset = ($page - 1) * $num;  //根据总页数算出偏移量

var_dump($sql);
//--------分页结束-----------



//$sql ="select * from shop_user";
$sql ="select * from shop_user limit ".$offset.','.$num;

$res = mysqli_query($link,$sql);

//    $result = mysqli_fetch_assoc($res);
//    var_dump($result);
echo '<a href="add.php">添加页面</a>';
echo '<table align="center" width="800"  cellspacing="0" cellpadding="0" border="1">';
echo '<tr style="text-align: center"><th>编号</th><th>用户名</th><th>密码</th><th>性别</th><th>年龄</th><th>操作</th>';
echo '<tr/>';
while ($arr = mysqli_fetch_assoc($res)){
    echo '<tr style="text-align: center;">';
    echo '<td>'.$arr['id'].'</td>';
    echo '<td>'.$arr['username'].'</td>';
    echo '<td>'.$arr['password'].'</td>';
    echo '<td>'.($arr['sex'] == 0 ? '男' :'女').'</td>';
    echo '<td>'.$arr['age'].'</td>';
    echo '<td><a href="del.php?id='.$arr['id'].'">删除</a>/<a href="update.php?id='.$arr['id'].'">修改</a></td>';
    echo '<tr/>';
}
echo '</table>';
$prev = $page - 1;
$next = $page + 1;

if($prev < 1){
    $prev = 1;
}
if($next > $pageCount){
    $next = $pageCount;
}
mysqli_close($link);
?>
<style>
    .container{width: 800px;text-align: center;}
    .container a{text-decoration: none;color: black;}
</style>
<div class="container">
    <a href="userlist.php?php=1">首页 </a><a href="userlist.php?page=<?=$prev;?>">上一页 </a><a href="userlist.php?page=<?=$next;?>">下一页 </a><a href="userlist.php?page=<?=$pageCount;?>">尾页 </a>
</div>


