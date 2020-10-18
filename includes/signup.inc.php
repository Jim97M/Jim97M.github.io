<?php
require_once 'init.php';
if (isset($_POST['fname'])) {
    $user_fname =  ucfirst(strtolower(trim($_POST['fname'])));
    $user_lastname =ucfirst(strtolower(trim($_POST['lname']))) ;
    $user_email = strtolower(trim($_POST['Email'])) ;
    $user_pwd = $_POST['Password'];

    $user= new USER();

    if ($user->getuserbyEmail($user_email)) {
        exit(json_encode('userExists'));
    } else {
        // echo 'the user i not there';
        // exit();
        // exit(json_encode('userdoesnotexits'));
        $sql=  "INSERT INTO user (user_email,user_fname,user_lname,user_pwd)";
        $sql .= " VALUES(?,?,?,?)";
        if (!$stmt = $user->conn()->prepare($sql)) {
            echo "Server Error!!  Please Report This Error To The Admin Through The Feedback Form In The Home Page";
        } else {
            $hashedpwd = password_hash($user_pwd, PASSWORD_DEFAULT);
            if ($stmt->execute([$user_email,$user_fname,$user_lastname,$hashedpwd])) {

                //send email congaratutaling him for his signup
                require 'welcomeTemp.php';
                $data =  str_replace("person",$user_fname, $welcomeTemplate);
                $user->welcomeEmail('Welcome To Maduka Online',$data, $user_email);
                exit(json_encode('userdoesnotexits'));

            } else {
                echo "Unknown Error Ocurred During Registration Please Try Later";
                echo "If the error Persists, Please Report this Error to the ADMIN for Assistance";
            }
        }
    }

    // admin registration of new members
}