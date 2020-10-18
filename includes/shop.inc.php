<?php

class SHOP extends USER
{
    public function verifiedshop(){
        $sql = "SELECT * from shop inner join user on user_id = shop_fk_user_id where shop_verified = 1 ";
        $data = $this->queryNone($sql);
        if (empty($data)) {
            //false to mean user has not requested to post an add
            return $data;
        } else {
            return $data;
        }
    }

    public function individualSeller(){
        $sql = "SELECT * from shop inner join user on user_id = shop_fk_user_id where shop_verified = 0 ";
        $data = $this->queryNone($sql);
        if (empty($data)) {
            //false to mean user has not requested to post an add
            return $data;
        } else {
            return $data;
        }
    }

    public function getshopID($userID){
        $sql = "SELECT  shop_id from shop  where shop_fk_user_id = $userID";
        $data = $this->queryNone($sql);
        if (empty($data)) {
           
            return false;
        } else {
            return $data;
        }
    } 

    public function getspecificshopdata($userid){
        //get shop data based on the user id
        $sql = "SELECT * from shop inner join user on user_id = shop_fk_user_id  where user_id = $userid";
        $data = $this->queryNone($sql);
        if (empty($data)) {
            //false to mean user has not requested to post an add
            return false;
        } else {

            return $data;
        }
    }

    public function getspecificshopdataOnID($userid){
        //get shop data based on the user id
        $sql = "SELECT * from shop inner join user on user_id = shop_fk_user_id  where shop_id = $userid";
        $data = $this->queryNone($sql);
        if (empty($data)) {
            //false to mean user has not requested to post an add
            return false;
        } else {

            return $data;
        }
    }

    public function get1shopdata($shopid){

        //get the shop data based on the user id
        $sql = "SELECT * from shop inner join user on user_id = shop_fk_user_id  where shop_id = $shopid";
        $data = $this->queryNone($sql);
        if (empty($data)) {
            //false to mean user has not requested to post an add
            return false;
        } else {

            return $data;
        }
    }

    public function getAllShopdata(){
        $sql = "SELECT * from shop ORDER BY RAND()";
        $data = $this->queryNone($sql);
        if (empty($data)) {
            //false to mean user has not requested to post an add
            return false;
        } else {

            return $data;
        }
    }

    public function getcategories(){
        $sql = "SELECT *  from category";
        $data = $this->queryNone($sql);
        if (empty($data)) {
            //false to mean user has not requested to post an add
            return false;
        } else {
            return $data;
        }
    }
    public function getproductLastID(){
        $sql = "SELECT max(prd_id) as id from products ";
        $data = $this->queryNone($sql);
        if (empty($data)) {
            //false to mean user has not requested to post an add
            return false;
        } else {
            return $data;
        }
    }

    public function getserviceLastID(){
        $sql = "SELECT max(srv_id) as id from services ";
        $data = $this->queryNone($sql);
        if (empty($data)) {
            //false to mean user has not requested to post an add
            return false;
        } else {
            return $data;
        }
    }

    public function getuserproduct($shopid){

        //get all the products of a specific shop
        $sql = "SELECT  * from products inner join images on image_fk_product_id = prd_id where shop_shop_id = $shopid";
        $data = $this->queryNone($sql);
        if (empty($data)) {
            //false to mean user has not requested to post an add
            return false;
        } else {
            return $data;
        }
    }

    public function getprdimages($pdid){
        //get all the products of a specific shop
        $sql = "SELECT  image_name from images  where image_fk_product_id = $pdid";
        $data = $this->queryNone($sql);
        if (empty($data)) {
            //false to mean user has not requested to post an add
            return $data;
        } else {
            return $data;
        }
    }

    public function getsrvimages($pdid){
        //get all the products of a specific shop
        $sql = "SELECT  srv_img_name from srv_images  where services_srv_id = $pdid";
        $data = $this->queryNone($sql);
        if (empty($data)) {
            //false to mean user has not requested to post an add
            return $data;
        } else {
            return $data;
        }
    }

    public function countProducts($shopid){
        //counts the online and the offline products of a specific shop
        $sql1 = "SELECT count(offline) as online from  products  where(offline = 0 and shop_shop_id = $shopid) ";
        $sql2 = "SELECT count(offline) as online from  products  where(offline = 1 and shop_shop_id = $shopid)";
        $totalcount = array();
        $online = $this->queryNone($sql1);
        $offline = $this->queryNone($sql2);
        $totalcount[] = array("online"=>$online[0]['online'],"offline"=>$offline[0]['online']);

        return $totalcount;
    }
    public function counties(){
        $sql = "SELECT * from county";
        return $data= $this->queryNone($sql);
    
    }

    //this function will check transaction code
    public function checkMpesaCode($transId)
    {   
        $sql = ("SELECT * from mobile_payments where Trans_ID =  ?");
        $data = $this->query_1($sql, $transId);
        if (empty($data)) {
            return false;
        } else {
            return $data;
        }
    }

    public function shopStatus($shopId){

        $shopData = $this->getshopID($_SESSION['maduka_user_id']);
        if (empty($shopData)) {
            return $data = false;
        } else {
            $shopId = $shopData[0]['shop_id'];
            $sql = "SELECT status, active from shop where shop_id = $shopId";
    
            $data1 = $this->queryNone($sql);
    
            //check if there is already a product posted
            $sql = "SELECT count(shop_shop_id) as prods from products where shop_shop_id = $shopId";
            $data2 = $this->queryNone($sql);
    
            $data['prods'] = $data2[0]['prods'];
            $data['status'] = $data1[0]['status'];
            $data['active'] = $data1[0]['active'];
            
            return $data;
        }
      
    }

    public function allShopStats(){

        $premiumShops = $this->countSpecific('active', 'shop', 1);
        $normalShops = $this->countSpecific('active', 'shop', 0);
        $totalusers = $this->count('shop_id', 'shop');
        $pendingProds = $this->countSpecific('approved', 'products', 0);   
    
            $data['premiumShops'] = $premiumShops['id'];
            $data['normalShops'] = $normalShops['id'];
            $data['pendingProds'] = $pendingProds['id'];
            $data['totalusers'] = $totalusers['id'];
           
            return $data;
    }

    public function getunverifiedProds(){
        $sql = " SELECT * from  products where approved = 0 ";
        $data = $this->queryNone($sql);
        if (empty($data)) {
            //false to mean user has not requested to post an add
            return $data;
        } else {
            return $data;
        }
        
    }

    public function getunverifiedServices(){
        $sql = " SELECT * from  services where approved = 0 ";
        $data = $this->queryNone($sql);
        if (empty($data)) {
            //false to mean user has not requested to post an add
            return $data;
        } else {
            return $data;
        }
        
    }




    
}