<?php

///
if (isset($_POST['getNofication'])) {
    require 'init.php';
    $userObj = new USER();
   $data =  $userObj->getNewUserNotification($_SESSION['maduka_user_id']);
   exit(json_encode($data));
    
}

require 'init.php';
$userObj = new USER();
$data =  $userObj->getNewUserNotification($_SESSION['maduka_user_id']);
exit(json_encode($data));