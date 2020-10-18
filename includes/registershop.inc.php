<?php
require 'init.php';
require 'compress.php';

if (isset($_POST['update'])) {
    $shopname = $_POST['shopname'];
    $shopdesc = $_POST['shopdesc'];
    $sholocation = $_POST['shoplocation'];
    $shopphone = $_POST['shopphone'];
    $shopemail = $_POST['shopemail'];
    $shopaddress = $_POST['shopaddress'];
    $userid = $_SESSION['maduka_user_id'];

    if (isset($_POST['lat']) && isset($_POST['lat'])) {
        $lat = $_POST['lat'];
        $lng = $_POST['lng'];

         //enter the shop image
        $target = "../images/shopimage/";
        if (!empty($_FILES["shopimage"]["name"])) {
            $path_parts = pathinfo($_FILES["shopimage"]["name"]);
            $new_file = $path_parts['filename'].'_'.time().'.'.$path_parts['extension'];
            $target1 = $target . $new_file ;
            if (compress($_FILES['shopimage']['tmp_name'], $target1, 70)) {
                echo 'it has worked';
            }
        }
        $sql = "UPDATE shop SET lat=? , lng=?, shop_name =?, shop_location =? , shop_phone = ?, shop_email = ?, shop_address = ?, shop_image =?, shop_desc =? WHERE (shop_fk_user_id = '$userid');";
        $userOBJ = new USER();
        $stmt = $userOBJ->conn()->prepare($sql);

        $stmt->execute([$lat, $lng, $shopname,$sholocation,$shopphone,$shopemail,$shopaddress,$new_file,$shopdesc]);

        exit();

    }

    


    //enter the shop image
    $target = "../images/shopimage/";
    if (!empty($_FILES["shopimage"]["name"])) {
        $path_parts = pathinfo($_FILES["shopimage"]["name"]);
        $new_file = $path_parts['filename'].'_'.time().'.'.$path_parts['extension'];
        $target1 = $target . $new_file ;
        if (compress($_FILES['shopimage']['tmp_name'], $target1, 70)) {
            echo 'it has worked';
        }
    }
    $sql = "UPDATE shop SET  shop_name =?, shop_location =? , shop_phone = ?, shop_email = ?, shop_address = ?, shop_image =?, shop_desc =? WHERE (shop_fk_user_id = '$userid');";
    $userOBJ = new USER();
    $stmt = $userOBJ->conn()->prepare($sql);

    $stmt->execute([$shopname,$sholocation,$shopphone,$shopemail,$shopaddress,$new_file,$shopdesc]);

    exit();
}

$shopname = trim($_POST['shopname']);
$shopdesc = $_POST['shopdesc'];
$sholocation = $_POST['shoplocation'];
$shopphone = $_POST['shopphone'];
$shopemail = $_POST['shopemail'];
$shopaddress = $_POST['shopaddress'];
$lng = $_POST['lng'];
$lat = $_POST['lat'];
$county = $_POST['county'];

$userid = $_SESSION['maduka_user_id'];


//enter the shop image
$target = "../images/shopimage/";
    if (!empty($_FILES["shopimage"]["name"])) {
        $path_parts = pathinfo($_FILES["shopimage"]["name"]);
        $new_file = $path_parts['filename'].'_'.time().'.'.$path_parts['extension'];
        $target1 = $target . $new_file ;
        if (compress($_FILES['shopimage']['tmp_name'], $target1, 70)) {
            echo 'it has worked';
        }
    }
$sql = "INSERT INTO shop (shop_name, shop_location, shop_phone, shop_email, shop_address, shop_image, shop_fk_user_id,shop_desc,lat,lng,shop_county_id) 
VALUES (?,?,?,?,?,?,?,?,?,?,?);";
$userOBJ = new USER();
$stmt = $userOBJ->conn()->prepare($sql);

$stmt->execute([$shopname,$sholocation,$shopphone,$shopemail,$shopaddress,$new_file,$userid,$shopdesc,$lat,$lng,$county]);

exit();