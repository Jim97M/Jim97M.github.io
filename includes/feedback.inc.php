
<?php

if (isset($_POST['feedback'])) {
    require 'init.php';
    $name = $_POST['Name'];
    $email = trim($_POST['Email']);
    $msg = $_POST['Message'];
    

    $sql = "INSERT INTO feedback (feedback_name, feedback_email, feedback_msg) VALUES (?,?,?);
    ";
    $userOBJ = new USER();
    $stmt = $userOBJ->conn()->prepare($sql);
    $stmt->execute([$name,$email,$msg]);
} elseif (isset($_POST['feedbackemail'])) {
    require 'init.php';
    $email = $_POST['feedbackemail'];
    $sql = "INSERT INTO subscribers (subscribers_email) VALUES (?);
    ";
    $userOBJ = new USER();
    $stmt = $userOBJ->conn()->prepare($sql);
    $stmt->execute([$email]);

}
