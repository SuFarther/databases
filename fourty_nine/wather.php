<?php
   wather('meinv.jpeg');
   function wather($source,$water='icon.png',$position=9,$alpha=100,
                   $type='jpeg',$path='test',$isRandName=true){
       //打开图片
       //打开大图
       $sourceRes  = open($source);
       $waterRes   = open($water);

//       var_dump($source);
//       var_dump($sourceRes);

       //获取图片的大小  算出来的位置
       $sourceInfo = getimagesize($source);
       $waterInfo = getimagesize($water);
//       var_dump($waterInfo);

       //算位置
       switch ($position){
           case 1:
               $x = 0;
               $y = 0;
               break;
           case 2:
               $x = ($sourceInfo[0] - $waterInfo[0]) / 2;
               $y = 0;
               break;
           case 3:
               $x = $sourceInfo[0] - $waterInfo[0];
               $y = 0;
               break;
           case 4:
               $x = 0;
               $y = ($sourceInfo[1] - $waterInfo[1]) / 2;
               break;
           case 5:
               $x = ($sourceInfo[0] - $waterInfo[0]) / 2;
               $y = ($sourceInfo[1] - $waterInfo[1]) /2;
               break;
           case 6:
               $x = $sourceInfo[0] - $waterInfo[0];
               $y = ($sourceInfo[1] - $waterInfo[1]) /2;
               break;
           case 7:
               $x = 0;
               $y = $sourceInfo[1] - $waterInfo[1];
               break;
           case 8:
               $x  = ($sourceInfo[0] - $waterInfo[0])/2;
               $y  =  $sourceInfo[1] - $waterInfo[1];
               break;
           case 9:
               $x =  $sourceInfo[0]  - $waterInfo[0];
               $y =  $sourceInfo[1]  - $waterInfo[1];
               break;
           default:
               $x  =  mt_rand(0,$sourceInfo[0] - $waterInfo[0]);
               $y  =  mt_rand(0,$sourceInfo[1] - $waterInfo[1]);
               break;
       }

       //把x y 求出来的值供两张图片合并的时候使用
      imagecopymerge($sourceRes,$waterRes,$x,$y,0,0,$waterInfo[0],$waterInfo[1],$alpha);

     $func = 'image'.$type;

     //判断路径是否随机
     if($isRandName){
         $name = uniqid().'.'.$type;
     }else{
         $pathinfo = pathinfo($source);
//         var_dump($pathinfo);
         $name = $pathinfo['filename'].$type;
     }

     $path = trim($path,'/').'/'.$name; //去掉文件夹test可能带/情况,在拼接上去
     $func($sourceRes,$path); //拼接过滤后的路径
     imagedestroy($sourceRes);
     imagedestroy($waterRes);


   }


   //打开图片函数
   function open($path){
       //1.先判断图片是否存在
       if(!file_exists($path)){
           exit('文件不存在');
       }

       //获取文件的信息
       $info = getimagesize($path);
//       var_dump($info);

       //根据图片的mime类型判断
       switch ($info['mime']){
           case 'image/jpeg':
           case 'image/jpg':
           case 'image/pjpeg';
             $res = imagecreatefromjpeg($path);
             break;
           case 'image/png':
              $res = imagecreatefrompng($path);
              break;
           case 'image/gif':
               $res = imagecreatefromgif($path);
               break;
           case 'image/wbmp':
           case 'image/bmp':
               $res = imagecreatefromwbmp($path);
               break;
           default;
       }
       return $res;
   }