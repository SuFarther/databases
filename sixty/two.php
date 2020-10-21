<?php
   $string = '<div>我是你的爸8⃣️呀！</div>';

   $pattern  = '/<div>(.*)<\/div>/';


   $replace = '<h1>你是我的乖孙哦!</h1>';
   var_dump(preg_replace($pattern,$replace,$string));