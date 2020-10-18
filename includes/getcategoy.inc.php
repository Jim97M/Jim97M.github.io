<?php

require_once 'init.php';
if (isset($_POST['registercategory'])) {
    $categname = trim($_POST['categname']);
    $categdesc = $_POST['categdescription'];

    $sql= "INSERT INTO  category (category_name, category_desc) VALUES (?,?);";
    $userOBJ = new USER();
    $stmt = $userOBJ->conn()->prepare($sql);
    if ($stmt->execute([$categname,$categdesc ])) {
        exit(json_encode(true));
    }
    
} else {
    $shop = new SHOP();
    $categories = $shop->getcategories();
    exit(json_encode($categories));
}
