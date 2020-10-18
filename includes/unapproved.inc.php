<?php 
require_once 'init.php';
$userObj =  new USER();
// $datas = $userObj->getUnapproved();
// exit(json_encode($datas));

if (isset($_GET['approve'])) {
    $id= $_GET['approve'];
    if (!empty($id)) {
        // Deleet the user from the unverified table 
        $sql = "DELETE FROM unverified_seller WHERE (user_user_id = '$id');";
       
        //FIXME: Redirect with a Message
        if ($userObj->queryInsert($sql)) {
            // move the user now to the shop table
            $sql = "INSERT INTO shop (shop_fk_user_id) VALUES ('$id');";
            if ($userObj->queryInsert($sql)) {
                redirect("../adm/unapproved.php?success");
            }else {
                redirect("../adm/unapproved.php?error");
            }
            
        } else {
            //FIXME: Redirect with a Message
            redirect("../adm/unapproved.php?error");
        }
    }
} else {
    redirect("../adm/unapproved.php?error");
}
