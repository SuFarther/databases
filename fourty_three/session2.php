<?php
    //调用session时必须开启
    session_start();

    //销毁session的生命周期
    session_destroy();

    var_dump($_SESSION);