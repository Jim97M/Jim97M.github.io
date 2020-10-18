<?php



if (isset($_POST['searchquery'])) {
    require 'init.php';
    $shopObj = new SHOP();
    $string  =  trim($_POST['searchquery']);

    $sql = "SELECT * from products inner join category on prd_category_id = category_id inner join shop  on shop_shop_id = shop_id 
 where prd_name like '%$string%' or prd_desc like '%$string%' or category_name
  like '%$string%' or shop_name like '%$string%' or shop_desc like '%$string%'  ";
    //this will fetch data to be displayed on ON THE homepage cararousel

    $data = array();

    //prepare and fetch the data
    $stmt = $shopObj->conn()->prepare($sql);
    $stmt->execute();

    //check if there is result from the search
    if ($stmt->rowCount() > 0) {
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
    } else {
        exit(json_encode(null));
    }

    exit();
    
       
    

    print_r($data);
} elseif (isset($_POST['searchShopquery'])) {

    require 'init.php';
    $shopObj = new SHOP();
    $string  =  trim($_POST['searchShopquery']);

    $sql ="SELECT * from shop where shop_name like '%$string%'";

    //prepare and fetch the data
    $stmt = $shopObj->conn()->prepare($sql);
    $stmt->execute();

    //check if there is result from the search
    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        exit(json_encode($data));
    } else {
        exit(json_encode(null));
    }
    
}
