<?php

// log in the user
if (isset($_POST['email'])) {
    require 'init.php';
    $user_email = $_POST['email'];
    $user_pwd = $_POST['password'];
    $user= new USER();
    if (!$user->getuserbyEmail($user_email)) {
        // $user->redirect("../login.php?false");
        exit(json_encode('nouser'));
    } else {

        $sql = ("SELECT user_email,user_pwd,user_id FROM user WHERE user_email = ?");
        if ($stmt = $user->conn()->prepare($sql)) {
            $stmt->execute([$user_email]);
            $row =$stmt->fetch();
            //check if the pwd match else reject and notify
            $pwdCheck= password_verify($user_pwd, $row['user_pwd']);
            if (!$pwdCheck== true) {
                // $user->redirect("../login.php?wrong");
                exit(json_encode('nouser'));
            } else {
                //store id of the email
                $id = $row['user_id'];
                $sess = new SESSION();
                //set session of the user id
                $sess->login($id,$user_email);
                $_SESSION['maduka_user_type']= "normal";

                //Check if the user is an admin
                if ($sess->isAdmin($id)) {
                    $_SESSION['maduka_user_type2']= "admin";
                    // exit(json_encode('success'));
                }

                if ($user->isSeller($id)) {
                    $_SESSION['maduka_user_type1']= "seller";
                    // exit(json_encode('success'));
                }

                exit(json_encode('success'));
            }
        } else {
            # code...
        }
    }
//    } else {
//     // require 'init.php';
//     redirect("../login.php?robot");
//    }
   
    
} else {
    require 'init.php';
    redirect("../index.php");
}
