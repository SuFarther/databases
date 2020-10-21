<?php
   /**
    * w是读权限
    * w+是可读可写权限,增加写的权限
    * w+可以把写出的东西读取出来
    *
    * w权限如果这个文件夹存在,就覆盖里面的内容,如果这个文件夹不存在就会重新创建并且赋值
    *
    */

    //1.打开目录
//    $fp = fopen('a.txt','w+');
////    var_dump($fp);
//    $str = 'abcdefg';
//    fwrite($fp,$str);
//    fseek($fp,0);//把指针移到最前面
//    echo fread($fp,3); //读
//    fclose($fp);

   //2.文件夹不存在
   $fp =  fopen('test.txt','w+');
   $str = '我的爱如潮水';
   fwrite($fp,$str);
   fseek($fp,0);
   fread($fp,3);
   fclose($fp);



