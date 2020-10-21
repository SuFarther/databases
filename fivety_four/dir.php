<?php
   //创建一个文件夹
//   mkdir('test');  test/a/b/c
     //创建3级文件夹 三个参数:三级文件夹参数,权限,是否递归
//     mkdir('test/a/b/c',0777,true);
//    mkdir('bbb');
    //删除bbb文件夹  rmdir只能删除一级目录
//     rmdir('bbb');

   //打开并且读取 opendir readdir
//    $dir = opendir('test');
//    echo readdir($dir).'<br/>';
//    echo readdir($dir).'<br/>';
//    echo readdir($dir).'<br/>';
//    closedir($dir);

//删除文件
//unlink('a.txt');
//拷贝文件的内容到另一个文件中
//copy('a.txt','bb.txt');
//文件重命名
rename('a.txt','a.php');