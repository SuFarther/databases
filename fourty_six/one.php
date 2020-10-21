<?php
   $arr = getimagesize("1.jpeg");


  list($width,$height) = $arr;
//   var_dump($arr);
   echo $width.'<br/>';
   echo $height;