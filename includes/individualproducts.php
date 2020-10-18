<?php

require 'init.php';
$shopObj = new SHOP();



if (isset($_POST['getmajorproducts'])) {
    //this will fetch data to be displayed on ON THE homepage cararousel
    $sql = "SELECT * from products inner join shop on shop_id = shop_shop_id  ORDER BY RAND() LIMIT 10";
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
        } else {
            $finalimages= null;
        }
          
        $data[] = array(
               'prd_id'=>$row['prd_id'],
               'prd_name'=>$row['prd_name'],
               'prd_desc'=>$row['prd_desc'],
               'prd_price'=>$row['prd_price'],
               'offline'=>$row['offline'],
               'prd_delivery'=>$row['prd_delivery'],
               'prd_condition'=>$row['prd_condition'],
               'prd_category_id'=>$row['prd_category_id'],
               'shop_shop_id'=>$row['shop_shop_id'],
               'prd_date'=>$row['prd_post_date'],
               'images'=>$finalimages,
               'shop_shop_id'=>$row['shop_shop_id'],
               'shop_shop_id'=>$row['shop_shop_id'],
               'shop_name'=>$row['shop_name'],
               'shop_location'=>$row['shop_location'],
               'shop_email'=>$row['shop_email'],
               'shop_address'=>$row['shop_address'],
               'shop_verified'=>$row['shop_verified'],
               'shop_image'=>$row['shop_image']
           );
    }

    exit(json_encode($data));
// 
    // print_r($data);
}

if (isset($_POST['getspecificprd'])) {
    $sprdid =$_POST['getspecificprd'];
    //this will fetch specific product to be displayed on the product.php page
    $sql = "SELECT * from products inner join shop on shop_id = shop_shop_id where prd_id = $sprdid";
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
        } else {
            $finalimages= null;
        }
          
        $data[] = array(
               'prd_id'=>$row['prd_id'],
               'prd_name'=>$row['prd_name'],
               'prd_desc'=>$row['prd_desc'],
               'prd_price'=>$row['prd_price'],
               'offline'=>$row['offline'],
               'prd_delivery'=>$row['prd_delivery'],
               'prd_condition'=>$row['prd_condition'],
               'prd_category_id'=>$row['prd_category_id'],
               'shop_shop_id'=>$row['shop_shop_id'],
               'prd_post_date'=>$row['prd_post_date'],
               'prd_date'=>$row['prd_post_date'],
               'images'=>$finalimages,
               'shop_shop_id'=>$row['shop_shop_id'],
               'shop_shop_id'=>$row['shop_shop_id'],
               'shop_name'=>$row['shop_name'],
               'shop_location'=>$row['shop_location'],
               'shop_email'=>$row['shop_email'],
               'shop_address'=>$row['shop_address'],
               'shop_verified'=>$row['shop_verified'],
               'shop_image'=>$row['shop_image'],
               'shop_phone'=>$row['shop_phone'],
               'shop_regdate'=>$row['shop_regdate'],
               'shop_desc'=>$row['shop_desc'],
               'lat'=>$row['lat'],
               'lng'=>$row['lng']
               

           );
    }

    exit(json_encode($data));

    print_r($data);
}
if (isset($_POST['shopid'])) {

    //this will fetch data to be displayed on the shop page ((this is for and individual page))
    $shopId = $_POST['shopid'];
    // Prepare the sql
    $sql = "SELECT  * from products  where shop_shop_id = $shopId";
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
        } else {
            $finalimages= null;
        }
           
        $data[] = array(
                'prd_id'=>$row['prd_id'],
                'prd_name'=>$row['prd_name'],
                'prd_desc'=>$row['prd_desc'],
                'prd_price'=>$row['prd_price'],
                'offline'=>$row['offline'],
                'prd_delivery'=>$row['prd_delivery'],
                'prd_condition'=>$row['prd_condition'],
                'prd_category_id'=>$row['prd_category_id'],
                'shop_shop_id'=>$row['shop_shop_id'],
                'prd_date'=>$row['prd_post_date'],
                'images'=>$finalimages
            );
    }

    exit(json_encode($data));

    print_r($data);
}

if (isset($_POST['shopid-categ'])) {

    //this will fetch data to be displayed on the shop page ((this is for and individual page))
    $shopId = $_POST['shopid-categ'];

    // Prepare the sql
    $sql = "SELECT  * from products  where prd_category_id = $shopId";
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
        } else {
            $finalimages= null;
        }
           
        $data[] = array(
                'prd_id'=>$row['prd_id'],
                'prd_name'=>$row['prd_name'],
                'prd_desc'=>$row['prd_desc'],
                'prd_price'=>$row['prd_price'],
                'offline'=>$row['offline'],
                'prd_delivery'=>$row['prd_delivery'],
                'prd_condition'=>$row['prd_condition'],
                'prd_category_id'=>$row['prd_category_id'],
                'shop_shop_id'=>$row['shop_shop_id'],
                'prd_date'=>$row['prd_post_date'],
                'images'=>$finalimages
            );
    }

    exit(json_encode($data));

    print_r($data);
}

if (isset($_POST['verifyProduct'])) {
    $prdId = $_POST['verifyProduct'];
    $sql = "UPDATE products SET approved = 1 WHERE (prd_id = '$prdId');";

    
    if($shopObj->queryInsert($sql)) {
        exit(json_encode('true'));
    } else {
        exit(json_encode('false'));
    }
    
}

//this will get shop data based on the person who is logged in
$shopObj = new SHOP();
//get shop id of the person who is logged in
$shopId = $shopObj->getshopID($_SESSION['maduka_user_id']);
$shopId = $shopId[0]['shop_id'];

// Prepare the sql
$sql = "SELECT  * from products  where shop_shop_id = $shopId";

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
            } else {
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