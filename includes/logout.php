<?php
    // echo 'you got here';
    // exit();
session_start();
session_unset();
session_destroy();
header("Location:../index.php");
