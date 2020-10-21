<?php
   $dst = imagecreatefromjpeg("1.jpeg");
   $src = imagecreatefromjpeg("2.jpeg");


   imagecopyresampled($dst,$src,10,10,300,300,600,600,900,900);


   header('Content-type:image/jpeg');

   imagejpeg($dst);

   imagedestroy($dst);
   imagedestroy($src);