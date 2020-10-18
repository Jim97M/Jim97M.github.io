<?php

session_start();
include_once 'database.inc.php';
include_once 'session.inc.php';
include_once 'user.inc.php';
include_once 'shop.inc.php';
function redirect($location)
{
    header("Location: {$location}");
}

?>