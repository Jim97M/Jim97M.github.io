<?php

require 'init.php';

$shopObj = new SHOP();
//get shop id of the person who is logged in
$shopId = $shopObj->getshopID($_SESSION['user_id']);
$shopId = $shopId[0]['shop'];

// Prepare the sql
$sql = "SELECT  * from products ";

$data = array();

//prepare and fetch the data
$stmt = $shopObj->conn()->prepare($sql);
        $stmt->execute();
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            //get the images for the respective id
            $images = $shopObj->getprdimages($row['prd_id']);
        //check of the images is empty 
            $finalimages = array();
            if (!empty($images)) {
                //if the images array is not empty get the images
                foreach ($images as $image) {
                    $finalimages[] = $image['image_name'];
                }
            }else {
                $finalimages= null;
            }
           
            $data[] = array(
                'prd_id'=>$row['prd_id'],
                'prd_name'=>$row['prd_name'],
                'prd_desc'=>$row['prd_desc'],
                'prd_price'=>$row['prd_price'],
                'offline'=>$row['offline'],
                'prd_delivery'=>$row['prd_delivery'],
                'prd_category_id'=>$row['prd_category_id'],
                'shop_shop_id'=>$row['shop_shop_id'],
                'prd_date'=>$row['prd_post_date'],
                'images'=>$finalimages 
            ); 
        }

exit(json_encode($data));

print_r($data);
