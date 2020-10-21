<?php

   session_start();


   unset($_SESSION['username']);
   unset($_SESSION['password']);

   session_destroy();


   var_dump($_SESSION);