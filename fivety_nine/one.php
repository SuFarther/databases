<?php
//  $str = 'aabcdefg';
//  $pattern = '/1*/';  //*   量词，0 次或多次匹配 如果没匹配到为 空字符
//   $pattern = '/aa+/'; //+ 量词，1 次或多次匹配  结果为aaa
//  $pattern='/aa?/';  //?  量词,出现0次或者1次
//  $pattern = '/^a/'; //^ 仅在作为第一个字符(方括号内)时，表明字符类取反 其他情况是以什么开头
//  $pattern = '/^a.+g$/'; //$ 以$结尾  .代表任意字符 +号: 表示一个或者更多个,即>=1
//  $pattern = '/a{0,3}/'; // {}取范围 a为规则,{0-3}表示至少出现0次,最多3次,如果有1次性匹配,没有就不匹配
//  $pattern = '/aa.+/i'; // i匹配小写字母
//   $pattern = '/d$/m'; //m 可以匹配多行的字符
//  $pattern = '/^asd.+dad$/s';  //s 可以匹配多行的字符为1行
// $pattern = '/a/U';  //U 只匹配这个多行或者单行出现的字符只允许为1次


   $str = "asdasdasdasda
   sdasdad";



//  $pattern = '/^asd.+dad$/s';
   $pattern = '/a/U';


  preg_match($pattern,$str,$match);
//  var_dump($match);

  if( preg_match($pattern,$str,$match)){
      echo'匹配结果是：';
      var_dump($match);
  }else{
      echo '匹配失败';
  }

