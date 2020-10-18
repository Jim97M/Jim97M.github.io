<?php

require_once 'init.php';
//gets indiviadial shop data

//1. Get shop id of the person who is logged in and
$shopObj = new SHOP();
$shopData = $shopObj->getshopID($_SESSION['maduka_user_id']);
$shopId = $shopData[0]['shop'];

$shop = new SHOP();
$shopdata = $shop->countProducts($shopId );
exit(json_encode($shopdata));