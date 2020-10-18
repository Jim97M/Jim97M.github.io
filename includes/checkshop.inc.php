<?php

require 'init.php';
$shop = new SHOP();

if (isset($_POST['shopstats'])) {
    $shopData = $shop->getshopID($_SESSION['maduka_user_id']);
    $shopId = $shopData[0]['shop_id'];
    // countTwoSpecific($field, $field2 , $table, $condition, $conditon2 )
   $offline =  $shop->countTwoSpecific('offline', 'shop_shop_id' , 'products', 1 , $shopId);
   $online =  $shop->countTwoSpecific('offline', 'shop_shop_id' , 'products', 0 , $shopId);
//    $total = $shop->countSpecific('shop_shop_id', 'products', $shopId);

   $data = array(
       'offline'=> $offline['id'],
       'online'=> $online['id'],
       'total'=> ($offline['id'] + 0) + ($online['id'] + 0)
   );
  exit(json_encode($data));
} elseif (isset($_POST['shopstatus'])) {
    $shopData = $shop->getshopID($_SESSION['maduka_user_id']);
    $shopId = $shopData[0]['shop_id'];
    $sql = "SELECT status, active from shop where shop_id = $shopId";

    $data = $shop->queryNone($sql);
    

    exit(json_encode($data));
} elseif (isset($_POST['allshopStat'])) {
    $data = $shop->allShopStats();

    exit(json_encode($data));
}



$result = $shop->shopStatus($_SESSION['maduka_user_id']);
exit(json_encode($result));


