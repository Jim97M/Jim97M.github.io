<?php

require 'init.php';

$shopObj = new SHOP();
//get shop id of the person who is logged in
$shopId = $shopObj->getshopID($_SESSION['user_id']);
$shopId = $shopId[0]['shop'];

// Prepare the sql
$sql = "SELECT  * from services ";

$data = array();

//prepare and fetch the data
$stmt = $shopObj->conn()->prepare($sql);
        $stmt->execute();
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            //get the images for the respective id
            $images = $shopObj->getsrvimages($row['srv_id']);
            //check of the images is empty
            $finalimages = array();
            if (!empty($images)) {
                //if the images array is not empty get the images
                foreach ($images as $image) {
                    $finalimages[] = $image['srv_img_name'];
                }
            } else {
                $finalimages= null;
            }
           
            $data[] = array(
                'prd_id'=>$row['srv_id'],
                'prd_name'=>$row['srv_name'],
                'prd_desc'=>$row['srv_desc'],
                'prd_priceStart'=>$row['srv_startPrice'],
                'prd_priceEnd'=>$row['srv_endPrice'],
                'prd_category_id'=>$row['category_category_id'],
                'shop_shop_id'=>$row['shop_shop_id'],
                'prd_date'=>$row['srv_post_date'],
                'images'=>$finalimages
            );
        }

exit(json_encode($data));

print_r($data);
