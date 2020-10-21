<?php
   // https://www.baidu.com net com org  cn
   // http://www.baidu.com
   // www.baidu.com
   // baidu.com

   $str = 'https://www.baidu.com';

  $pattern = '/(http|https)?(:\/\/)?(\w+.?)(\w+.?)(\w+.?)/';

   if(preg_match($pattern,$str,$match)){
       echo '匹配成功';
       var_dump($match);
   }else{
       echo '匹配失败';
   }