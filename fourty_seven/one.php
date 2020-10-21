<?php
  /**
   * 字符串转换截取
   */
   $str = '0123456789';

   //打乱字符串
//   echo str_shuffle($str);

   //截取并打乱字符串
   echo substr(str_shuffle($str),0,5);