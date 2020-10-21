<?php

    verify();

    function verify($width = 100  ,$height = 40 ,$num = 5, $type = 1){

        $image = imagecreatetruecolor($width,$height);

        $string = '';
        switch ($type){
            case 1:
                $str = '0123456789';
                $string = substr(str_shuffle($str),0,$num);
                break;
            case 2:
                $arr = range('a','z');
                shuffle($arr);
                $tmp = array_slice($arr,0,$num);
                $string = join('',$tmp);
                break;
            case 3:
                $str = '123456789abcdefghjklmnopqrstuvwxyzABXXCDEFGHJKLMNOPQRSTUVWXYZ';
                $string = substr(str_shuffle($str),0,$num);
                break;
            default;
        }

        imagefilledrectangle($image,0,0,$width,$height,lightColor($image));

        for($i = 0; $i < $num; $i++){
            $x = ($width / $num) * $i;
            $y = mt_rand(10,$height  - 20);
            imagechar($image,5,$x,$y,$string[$i],deepColor($image));
        }


        for ($i = 0; $i < $num;$i++){
            imagearc($image,mt_rand(10,$width),mt_rand(10,$height),mt_rand(10,$width)
                ,mt_rand(10,$height),mt_rand(0,10),mt_rand(0,270),deepColor($image));
        }


        for ($i = 0; $i < 50; $i++){
            imagesetpixel($image,mt_rand(0,$width),mt_rand(0,$height),deepColor($image));
        }

        header('Content-type:image/png');

        imagepng($image);


        imagedestroy($image);


        echo $string;
    }



    function lightColor($image){
        return imagecolorallocate($image,mt_rand(130,255),mt_rand(130,255),mt_rand(130,255));
    }

    function deepColor($image){
        return   imagecolorallocate($image,mt_rand(0,120),mt_rand(0,120),mt_rand(0,120));
    }