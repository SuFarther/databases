<?php
    /**
     *  r只是读权限
     *  r+可以是可读可写权限
     */
//   $fp = fopen('a.txt','r');
     $fp = fopen('a.txt','r+');
//     var_dump($fp);

     $str = '恋爱是一种技术';
     fwrite($fp,$str);
     fseek($fp,0); //把指针移到最前
     echo  fread($fp,3); //读
     fclose($fp);