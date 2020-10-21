<?php
  $str = 'aaabbcfg';

  $pattern = '/a/';

  preg_match_all($pattern,$str,$matches);
  var_dump($matches);