<?php
    /**
     *  利用递归循环删除3级目录
     */
    rm('test');
    function rm($path){

        //打开目录
        $dir = opendir($path);


        //跳过两层特殊的目录结构
        readdir($dir);
        readdir($dir);

        //循环删除
        while($newFile =  readdir($dir)){
            //判断这个文件是文件夹还是文件
            $newPath =  $path.'/'.$newFile;
            if (is_file($newPath)){
                //如果是文件
                unlink($newPath);
            }else{
                //如果是文件夹 循环删除这个新文件夹
                rm($newPath);
            }
        }
        closedir($dir); //把这个目录关闭
        rmdir($path); //把这个目录路径删除
    }