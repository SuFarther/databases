<?php
  /**
   * 数组截取
   * 数组转字符串
   */
   $arr = range('a','z');

   //数组打乱
  shuffle($arr);

  //var_dump($arr);

  //数组截取
   $tmp =  array_slice($arr,0,5);


   //将数组转换为字符串
   $string  = join('',$tmp);

//   var_dump($tmp);
//   var_dump($string);
     echo $string;