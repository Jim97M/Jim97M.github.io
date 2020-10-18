<?php

require 'init.php';
$shopObj = new SHOP();



if (isset($_POST['getmajorproducts'])) {
    //this will fetch data to be displayed on ON THE homepage cararousel
    $sql = "SELECT * from products inner join shop on shop_id = shop_shop_id LIMIT 8";
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

    print_r($data);
}

if (isset($_POST['getspecificprd'])) {
    $sprdid =$_POST['getspecificprd'];
    //this will fetch specific product to be displayed on the product.php page
    $sql = "SELECT * from services inner join shop on shop_id = shop_shop_id  where srv_id = $sprdid";
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
               'srv_id'=>$row['srv_id'],
               'srv_name'=>$row['srv_name'],
               'srv_desc'=>$row['srv_desc'],
               'srv_startPrice'=>$row['srv_startPrice'],
               'srv_endPrice'=>$row['srv_endPrice'],
               'offline'=>$row['offline'],
               'category_category_id'=>$row['category_category_id'],
               'shop_shop_id'=>$row['shop_shop_id'],
               'srv_post_date'=>$row['srv_post_date'],
               'images'=>$finalimages,
               'shop_shop_id'=>$row['shop_shop_id'],
               'shop_name'=>$row['shop_name'],
               'shop_location'=>$row['shop_location'],
               'shop_email'=>$row['shop_email'],
               'shop_address'=>$row['shop_address'],
               'shop_verified'=>$row['shop_verified'],
               'shop_image'=>$row['shop_image'],
               'images'=>$finalimages,
               'shop_regdate'=>$row['shop_regdate'],
               'shop_phone'=>$row['shop_phone'],
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

if (isset($_POST['allservices'])) {

 // Prepare the sql
    $sql = "SELECT * from services inner join shop on shop_id = shop_shop_id ORDER BY RAND()";

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
                'srv_id'=>$row['srv_id'],
                'srv_name'=>$row['srv_name'],
                'srv_desc'=>$row['srv_desc'],
                'srv_startPrice'=>$row['srv_startPrice'],
                'srv_endPrice'=>$row['srv_endPrice'],
                'category_category_id'=>$row['category_category_id'],
                'shop_shop_id'=>$row['shop_shop_id'],
                'srv_post_date'=>$row['srv_post_date'],
                'shop_phone'=>$row['shop_phone'],
                'shop_location'=>$row['shop_location'],
                'shop_image'=>$row['shop_image'],
                'images'=>$finalimages
            );
        }

    exit(json_encode($data));


    print_r($data);
}

if (isset($_POST['shopservices'])) {

    $shopId = $_POST['shopservices'];
    // Prepare the sql
       $sql = "SELECT * from services inner join shop on shop_id = shop_shop_id  WHERE shop_id = $shopId ORDER BY RAND()";
   
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
                   'srv_id'=>$row['srv_id'],
                   'srv_name'=>$row['srv_name'],
                   'srv_desc'=>$row['srv_desc'],
                   'srv_startPrice'=>$row['srv_startPrice'],
                   'srv_endPrice'=>$row['srv_endPrice'],
                   'category_category_id'=>$row['category_category_id'],
                   'shop_shop_id'=>$row['shop_shop_id'],
                   'srv_post_date'=>$row['srv_post_date'],
                   'shop_phone'=>$row['shop_phone'],
                   'shop_location'=>$row['shop_location'],
                   'shop_image'=>$row['shop_image'],
                   'images'=>$finalimages
               );
           }
   
       exit(json_encode($data));
   
   
       print_r($data);
}

if (isset($_POST['shopservices-categ'])) {

    $shopId = $_POST['shopservices-categ'];
    // Prepare the sql
       $sql = "SELECT * from services inner join shop on shop_id = shop_shop_id  WHERE category_category_id = $shopId ORDER BY RAND()";
   
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
                   'srv_id'=>$row['srv_id'],
                   'srv_name'=>$row['srv_name'],
                   'srv_desc'=>$row['srv_desc'],
                   'srv_startPrice'=>$row['srv_startPrice'],
                   'srv_endPrice'=>$row['srv_endPrice'],
                   'category_category_id'=>$row['category_category_id'],
                   'shop_shop_id'=>$row['shop_shop_id'],
                   'srv_post_date'=>$row['srv_post_date'],
                   'shop_phone'=>$row['shop_phone'],
                   'shop_location'=>$row['shop_location'],
                   'shop_image'=>$row['shop_image'],
                   'images'=>$finalimages
               );
           }
   
       exit(json_encode($data));
   
   
       print_r($data);
}

if (isset($_POST['getspecificService'])) {
    
    
    $serviceID = $_POST['getspecificService'];
    
 // Prepare the sql
 $sql = "SELECT * from services inner join shop on shop_id = shop_shop_id WHERE srv_id = $serviceID";

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
             'srv_id'=>$row['srv_id'],
             'srv_name'=>$row['srv_name'],
             'srv_desc'=>$row['srv_desc'],
             'srv_startPrice'=>$row['srv_startPrice'],
             'srv_endPrice'=>$row['srv_endPrice'],
             'category_category_id'=>$row['category_category_id'],
             'shop_shop_id'=>$row['shop_shop_id'],
             'srv_post_date'=>$row['srv_post_date'],
             'shop_phone'=>$row['shop_phone'],
             'images'=>$finalimages
         );
     }

 exit(json_encode($data));


 print_r($data);
}

if (isset($_POST['verifyService'])) {
    $srvId = $_POST['verifyService'];
    $sql = "UPDATE services SET approved = 1 WHERE (srv_id = '$srvId');";

    
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
$sql = "SELECT  * from services  where shop_shop_id = $shopId";

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
                'srv_id'=>$row['srv_id'],
                'srv_name'=>$row['srv_name'],
                'srv_desc'=>$row['srv_desc'],
                'srv_startPrice'=>$row['srv_startPrice'],
                'srv_endPrice'=>$row['srv_endPrice'],
                'srv_post_date'=>$row['srv_post_date'],
                'offline'=>$row['offline'],
                'category_category_id'=>$row['category_category_id'],
                'shop_shop_id'=>$row['shop_shop_id'],
                'srv_post_date'=>$row['srv_post_date'],
                // 'shop_phone'=>$row['shop_phone'],
                'images'=>$finalimages
            );
        }

exit(json_encode($data));

print_r($data);