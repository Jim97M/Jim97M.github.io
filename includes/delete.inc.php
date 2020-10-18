<?php
 if (isset($_POST['delete_product'])) {
     require 'init.php';
     $shopOBJ = new SHOP();
     $id = $_POST['delete_product'];

     //get all the images of the file and delete them
     $images = $shopOBJ->getprdimages($id);
     foreach ($images as $image) {
         $path = "../images/products/" . $image['image_name'];
         if (unlink($path)) {
             echo " file was delted";
         } else {
             echo "the file was not deleted";
         }
        ;
    }


     $sql = "DELETE FROM products WHERE (prd_id = '$id');";
     $shopOBJ = new USER();
     $shopOBJ->queryInsert($sql);
     
     exit(json_encode(tue));
 };

 if (isset($_POST['delete_service'])) {
    require 'init.php';
    $shopOBJ = new SHOP();
    $id = $_POST['delete_service'];

       //get all the images of the file and delete them
    $images = $shopOBJ->getsrvimages($id);
    foreach ($images as $image) {
        $path = "../images/products/" . $image['srv_img_name'];
        if (unlink($path)) {
            echo " file was delted";
        } else {
            echo "the file was not deleted";
        }
       ;
   }


    $sql = "DELETE FROM services WHERE (srv_id = '$id');";
    $shopOBJ = new USER();
    if ($shopOBJ->queryInsert($sql)) {
        echo 'it has been deleted';
        // exit(json_encode(tue));
    } else {
        echo 'it has not been deleted';
        // exit(json_encode(false));
    }
    
    
    
}
if (isset($_GET['deleteshop'])) {
    $shopid = $_GET['deleteshop'];
    require 'init.php';
    $shopOBJ = new SHOP();
    $sql1 = "SELECT srv_id from services where shop_shop_id = $shopid";
    $services = $shopOBJ->queryNone($sql1);
    //delete the services
    
    if (!empty($services)) {
        foreach($services as $service){
            $srvid= $service['srv_id'];
            $sql = "SELECT  srv_img_name from srv_images  where services_srv_id = $srvid";
    
            $serviceImages = $shopOBJ->queryNone($sql);
            if (!empty($serviceImages)) {
                foreach ($serviceImages as $srvimage) {
                    echo $srvimage['srv_img_name'];
                   
                    $path = "../images/products/" . $srvimage['srv_img_name'];
                    if (unlink($path)) {
                        echo " file was delted";
                    } else {
                        echo "the file was not deleted";
                    };
               }
            }
            
        }
    }

    $sql2 = "SELECT prd_id from products where shop_shop_id = $shopid";
    $products = $shopOBJ->queryNone($sql2);

    if (!empty($products)) {
        foreach($products as $product){
            $prvid= $product['prd_id'];
            $sql = "SELECT  image_name from images  where image_fk_product_id = $prvid";
    
            $productImages = $shopOBJ->queryNone($sql);
            if (!empty($productImages)) {
                foreach ($productImages as $productImages) {
                    echo $productImages['image_name'];
                   
                    $path = "../images/products/" . $productImages['image_name'];
                    if (unlink($path)) {
                        echo " file was delted";
                    } else {
                        echo "the file was not deleted";
                    };
               }
            }
            
        }
    }

    //delete the shop
    
    $sql3 = "DELETE from shop WHERE shop_id = $shopid";
    $shopOBJ->queryNone($sql3);
    
    
    
   
    
    

   

    
        
    
    
    echo $shopid;
}