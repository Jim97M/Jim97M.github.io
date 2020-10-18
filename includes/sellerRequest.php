<?php   

require_once 'init.php';
if (isset($_POST['postRequest'])) {
    $id =  $_POST['userId'];
    $sql = "INSERT INTO unverified_seller (user_user_id) VALUES ('$id');";
    $user= new USER();
    if ($user->queryInsert($sql)) {
        redirect("../user.php?request=success");
    } else {
        redirect("../user.php?request=fail");
    }   

} else {
    redirect("../user.php");
}
