<?php
    /**
     * a权限 可以写入文件读取出来
     * a+权限 可以把写进里面的东西读取出来
     * a+权限 如果这个文件存在,不会覆盖原文件,而是在原文件后面叠加东西
     * 如果这个文件不存在就会新建
     * fwrite 可以把东西写入某个文件
     */


    //1.文件存在
//   $fp = fopen('a.txt','a+');
////   var_dump($fp);
//    $str = '奥利给';
//    fwrite($fp,$str);
//    fseek($fp,0);
//    echo fread($fp,3);
//    fclose($fp);


    //2.文件不存在
//$fp = fopen('a.txt','a');
    $fp = fopen('b.txt','a+');
    //   var_dump($fp);
    $str = '奥利给';
    fwrite($fp,$str);
    fseek($fp,0);
    echo fread($fp,3);
    fclose($fp);