<?php

// var_dump(pathinfo(a.txt));
// var_dump(dirname('a.txt')); //输出.
//   var_dump(basename('text/a.txt'));

   //以url方式输出username=zhangsan&passowrd=123
  $arr = ['username' => 'zhangsan','passoword' => '123'];
//  var_dump(http_build_query($arr));

   //输出浏览器样的方式
//   var_dump(parse_url('http://localhost:63342/databases/fivety_three/file2.php?username=zhangsan&passowrd=123'));

    //输出字符串
   parse_str('username=zhangsan&passoword=123');
   echo  $username,$password;

   file_exists(); //文件是否存在
   is_file(); //是否是文件
   is_dir(); //是否是文件
   is_writable(); //是否可写
   is_readable(); //是否可读
   is_executable(); //是否可执行

   chmod(); //0777 r w x
