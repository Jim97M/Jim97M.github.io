<?php
  /* access token */
    $consumerKey = 'BwBmOxbepFZiIFjlMKTuDGmGx2dZLPrA'; //Fill with your app Consumer Key
    $consumerSecret = 'TnffJIaWWwR0DsAS'; // Fill with your app Secret
    $headers = ['Content-Type:application/json; charset=utf8'];
    $access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
    $curl = curl_init($access_token_url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_HEADER, FALSE);
    curl_setopt($curl, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);
    $result = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $result = json_decode($result);
    $access_token = $result->access_token;
    curl_close($curl);


  /* making the request */
    $tstatus_url = 'https://sandbox.safaricom.co.ke/mpesa/transactionstatus/v1/query';

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $tstatus_url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token)); //setting custom header

    $curl_post_data = array(
      //Fill in the request parameters with valid values
      'Initiator' => 'testapi113',
      'SecurityCredential' => 'GQ962KjiZF28lkE3wfnhm/Lbeeq9YV/aT9jBNSutgmFk5ihbsJmM3lIRJZ7djtThQOStJXrtsneUgboZcSGupZsUfNXZaTlvZstlG45ZZZoZK3POCz1Gda5VpIP87A+X+r+D0x8oO8W2elWMWeUC17KETS7olPq9klIwS/I3qlKK6FbYzksrxH8v0pLTC5/xuLwYPSYrhsGNEimIeXNaZdp0URTK4wB3AZMAPgmfmLqU0bSGXAzbKI/Fq95pXTkIB2aNi3SMv1sOijyeSKLrxkj+ZlhhcyiGbi6IrQtdyD+d/AQhFAsRoT3cCyLoFTPlZvZiGNIiqqeIC6g6kCYaZQ==',
      'CommandID' => 'TransactionStatusQuery',
      'TransactionID' => '',
      'PartyA' => '600213', // shortcode 1
      'IdentifierType' => '4',
      'ResultURL' => 'https://madukaonline.co.ke/includes/trans/ResultURL.php',
      'QueueTimeOutURL' => 'https://madukaonline.co.ke/includes/trans/ResultURL.php',
      'Remarks' => '',
      'Occasion' => ''
    );

    $data_string = json_encode($curl_post_data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
    $curl_response = curl_exec($curl);
    print_r($curl_response);
    echo $curl_response;
?>
