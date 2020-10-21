<?php
   /**
    * 定界符
    */

    $str = 'abcde';

    $pattern = '/abc/'; //哪些不能作为定界符 a-z A-Z  0-9 空格 \

    var_dump(preg_match($pattern,$str,$matche));

    var_dump($matche);