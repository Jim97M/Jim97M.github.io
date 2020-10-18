<?php

require 'init.php';
//gets indiviadial shop data



if (isset($_POST['shopid'])) {
    $shop = new SHOP();
    $shopdata = $shop->getspecificshopdata($_SESSION['maduka_user_id']);
    exit(json_encode($shopdata));
    
    // $shopId = $_POST['shopid'];
    // $shop = new SHOP();
    // $shopdata = $shop->get1shopdata($shopId);
    // exit(json_encode($shopdata));
}


if (isset($_POST['shopid-front'])) {
    $shop = new SHOP();
    $shopdata = $shop->getspecificshopdataOnID($_POST['shopid-front']);
 
    exit(json_encode($shopdata));
    
    // $shopId = $_POST['shopid'];
    // $shop = new SHOP();
    // $shopdata = $shop->get1shopdata($shopId);
    // exit(json_encode($shopdata));
}

$shop = new SHOP();
$shopdata = $shop->getspecificshopdata($_SESSION['maduka_user_id']);
exit(json_encode($shopdata));