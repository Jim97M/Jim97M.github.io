

<?php

require_once 'init.php';
//gets indiviadial shop data

$shop = new SHOP();
$shopdata = $shop->getAllShopdata();
exit(json_encode($shopdata));

