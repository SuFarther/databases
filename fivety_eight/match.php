<?php

   /**
    * 定界符  原子
    */

   $str = 'aaa13454545454';

// $str = '$Aadad';
//   $pattern = '/abc/'; //匹配规则  a-z A-Z 0-9 空格_

//   $pattern = '/\d/'; //匹配0-9之间的数字
//   $pattern = '/\D/'; //匹配非0-9之间的数字
//   $pattern = '/\w/'; //匹配 a-z A-Z 0-9
//   $pattern = '/\W/'; //匹配 非 a-z A-Z 0-9
//   $pattern ='/\s/'; //匹配回车 换行 空格 tab
//   $pattern = '/\S/'; //匹配非回车 换行 空格  tab
//   $pattern = '/[a-z]/'; //匹配定界符里面的原子 原子为a-z范围
//   $pattern = '/[^a-z]/'; //^取反

   $pattern = '/[1][3-5]\d/';
//    $pattern = '/./';  //.表示任意字符
   preg_match($pattern,$str,$match);

   var_dump($match);