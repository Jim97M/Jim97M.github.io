

<?php
header("allow-control-access-origin: * ");
date_default_timezone_set('Africa/Nairobi');

if (isset($_POST['mpedacode'])) {
    require 'init.php';
    $mpedacode = trim($_POST['mpedacode']) ;

    $shopOBJ = new SHOP();
    $transaction  = $shopOBJ->checkMpesaCode($mpedacode);

    

    if ($transaction !== false) {
        //confirm if the mpesa code entered has been used
        if ($transaction['status'] == 1) {
            $response = ['message'=>'usedcode'];
                exit(json_encode($response));
        }
        elseif ($transaction['status'] == 0) 
        {
                //1) tie shop id to payment and mark transaction as confirmed
            $shopOB = new SHOP();
            $shopData = $shopOB->getshopID($_SESSION['maduka_user_id']);
            $shopId = $shopData[0]['shop_id'];

            $sql = "UPDATE  mobile_payments SET shop_shop_id = $shopId, status = 1 WHERE (Trans_ID = ?);";
            $shopOB->writeSpecific($sql,$mpedacode);

            //2) Confirm if the payment minimum is met
            $paidAmount = $transaction['Trans_Amount'];
            if ($paidAmount < 300) {
                $response = ['message'=>'insufficient'];
                exit(json_encode($response));
            } else {
                $days =  round($paidAmount / 10);
                //1) get the current time and the expiration date
                $expirationDate = strtotime("+" . $days . " days");

                //2) Set shop expiration date and set shop to active
                $sql = "UPDATE shop SET status = 1, expirationdate =$expirationDate,  active = 1 WHERE (shop_id = 7);";
                $shopOB->queryInsert($sql);

                $response = ['status'=>'ok','expirationdate'=> date('m/d/Y H:i:s', $expirationDate), 'paidamount'=>$paidAmount];

                exit(json_encode($response));
            }
        }

    } else {
        exit(json_encode(false));
    }
   
} elseif (isset($_POST['billHistory'])) {
    //get shodid
    require 'init.php';
    $shopOB = new SHOP();
    $shopData = $shopOB->getshopID($_SESSION['maduka_user_id']);
    $shopId = $shopData[0]['shop_id'];

    $sql = "SELECT* from mobile_payments where shop_shop_id = $shopId ";
    $data = $shopOB->queryNone($sql);

    if (empty($data)) {
        exit(json_encode(false));
    } else {
        exit(json_encode($data));
    }

    

} elseif (isset($_POST['completedtrans'])) {
    require 'init.php';
    $shopOB = new SHOP();
    $shopData = $shopOB->getshopID($_SESSION['maduka_user_id']);

    $sql = "SELECT* from mobile_payments where status = 0 ";
    $data = $shopOB->queryNone($sql);

    if (empty($data)) {
        exit(json_encode(false));
    } else {
        exit(json_encode($data));
    }
} elseif (isset($_POST['pendingtrans'])) {
    require 'init.php';
    $shopOB = new SHOP();
    $shopData = $shopOB->getshopID($_SESSION['maduka_user_id']);

    $sql = "SELECT* from mobile_payments where status =  1";
    $data = $shopOB->queryNone($sql);

    if (empty($data)) {
        exit(json_encode(false));
    } else {
        exit(json_encode($data));
    }
}