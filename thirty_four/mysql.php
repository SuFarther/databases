<?php
    //连接数据库
    $link = mysqli_connect('localhost', 'root', '123456');

    //       var_dump($link);
    //检查数据库是否连接成功
    if (!$link) {
        echo '数据库连接失败,请尝试';
    } else {
        echo '连接成功';
    }

    //设置字符集
    mysqli_set_charset($link, 'utf8mb4');

    //选择数据库
    mysqli_select_db($link, 'test');

    //准备sql
    $sql = "select * from shop_user";

    //发送sql
    $res = mysqli_query($link, $sql);

    //处理结果集
    //      $result = mysqli_fetch_assoc($res);
    //      var_dump($result);

    //循环输出结果集
    echo '<table align="center" width="800" height="400" border="1" cellpadding="0" cellspacing="0">'; //获取的数据用表格显示出来
    echo '<caption><h1>演示表</h1></caption>';
    echo '<tr style="text-align: center">';
    echo '<td>' . 'id' . '</td>';
    echo '<td>' . '用户名' . '</td>';
    echo '<td>' . '密码' . '</td>';
    echo '<td>' . '性别' . '</td>';
    echo '<td>' . '年龄' . '</td>';
    echo '</tr>';
    while ($arr = mysqli_fetch_assoc($res)) {
        echo '<tr style="text-align: center">';
        foreach ($arr as $col) {
            echo '<td>' . $col . '</td>';
        }
        echo '</tr>';
    }
    echo '</table>';


    //关闭数据库(释放资源)
    mysqli_close($link);
