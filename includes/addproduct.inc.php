<?php
require 'init.php';
if (isset($_POST['pdname'])) {


    $pdname = trim($_POST['pdname']);
    $pdcategory = trim($_POST['pdcategory']);
    $pdprice = trim($_POST['pdprice']);
    $condition = $_POST['condition'];
    $description = trim($_POST['descriprion']);    

    //1. Get shop id of the person who is logged in and
    $shopObj = new SHOP();
    $shopData = $shopObj->getshopID($_SESSION['maduka_user_id']);
    $shopId = $shopData[0]['shop_id'];


    //2. Prepare the sql
    $sql = "INSERT INTO products (prd_name, prd_desc, prd_price, prd_category_id, shop_shop_id,prd_condition) VALUES (?,?,?,?,?,?);";
    
    //3. Insert the  text records into the database
    $userOBJ = new SHOP();
    $stmt = $userOBJ->conn()->prepare($sql);
    try {
        $stmt->execute([$pdname,$description,$pdprice,$pdcategory,$shopId,$condition]);

    } catch (Exception $e) {
        echo $e->getMessage();
    }

    //4. Get the id of the product that has just been inserted
    $prodData = $userOBJ->getproductLastID();

    $pdID = $prodData[0]['id'];

    //5. Insert respectiv images
    function insertimage($filename, $productID)
    {
        $sql = "INSERT INTO images (image_name, image_fk_product_id) VALUES (?,?);";
        try {
            $userOBJ = new SHOP();
            $stmt = $userOBJ->conn()->prepare($sql);
            $stmt->execute([$filename,$productID]);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    

  
    
    require_once('compress.php');
    //adding time stamp to the image
    $target = "../images/products/";
    if (!empty($_FILES["customFile1"]["name"])) {
        $path_parts = pathinfo($_FILES["customFile1"]["name"]);
        $new_file = $path_parts['filename'].'_'.time().'.'.$path_parts['extension'];
        $target1 = $target . $new_file ;
        if (compress($_FILES['customFile1']['tmp_name'], $target1, 50)) {
            insertimage($new_file, $pdID);
        }
    }

  
    if (!empty($_FILES["customFile2"]["name"])) {
        $path_parts = pathinfo($_FILES["customFile2"]["name"]);
        $new_file = $path_parts['filename'].'_'.time().'.'.$path_parts['extension'];
        $target2 = $target . $new_file ;
        if (compress($_FILES['customFile2']['tmp_name'], $target2, 50)) {
            insertimage($new_file, $pdID);
        }
    }

    if (!empty($_FILES["customFile3"]["name"])) {
        $path_parts = pathinfo($_FILES["customFile3"]["name"]);
        $new_file = $path_parts['filename'].'_'.time().'.'.$path_parts['extension'];
        $target3 = $target . $new_file ;
        if (compress($_FILES['customFile3']['tmp_name'], $target3, 50)) {
            insertimage($new_file, $pdID);
        }
    }

    if (!empty($_FILES["customFile4"]["name"])) {
        $path_parts = pathinfo($_FILES["customFile4"]["name"]);
        $new_file = $path_parts['filename'].'_'.time().'.'.$path_parts['extension'];
        $target4 = $target . $new_file ;
        if (compress($_FILES['customFile4']['tmp_name'], $target4, 50)) {
            insertimage($new_file, $pdID);
        }
    }
} else {
    echo 'it has not worked';

    $shopObj = new SHOP();
    $shopObj->shopStatus(7);

}
