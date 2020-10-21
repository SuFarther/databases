<?php
    /**
     * 存取cookie 四个参数  键  值 过期时间(延长时间) 当前目录
     */
    setcookie('name','张三',time()+60,'/');
    var_dump($_COOKIE);