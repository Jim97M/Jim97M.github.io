<?php
/* access token */
  // $consumerKey = 'BwBmOxbepFZiIFjlMKTuDGmGx2dZLPrA'; //Fill with your app Consumer Key
  // $consumerSecret = 'TnffJIaWWwR0DsAS'; // Fill with your app Secret
  
  // $headers = ['Content-Type:application/json; charset=utf8'];
  // $access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
  // $curl = curl_init($access_token_url);
  // curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
  // curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
  // curl_setopt($curl, CURLOPT_HEADER, FALSE);
  // curl_setopt($curl, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);
  // $result = curl_exec($curl);
  // $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  // $result = json_decode($result);
  // $access_token = $result->access_token;
  // curl_close($curl);


$consumerKey = "BwBmOxbepFZiIFjlMKTuDGmGx2dZLPrA";
$consumerSecret = "TnffJIaWWwR0DsAS";
$headers = "";

$headers = ['Content-Type:application/json; charset=utf8'];

$url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);
$result = curl_exec($curl);
$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
$result = json_decode($result);
$access_token = $result->access_token;
echo $access_token;

  /* main request */
  $bal_url = 'https://sandbox.safaricom.co.ke/mpesa/accountbalance/v1/query';

  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $bal_url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token)); //setting custom header

  $curl_post_data = array(
    //Fill in the request parameters with valid values
    'Initiator'           => 'testapi',                      # initiator name -> For test, use Initiator name(Shortcode 1)
    'SecurityCredential'  => 'kZHu6cq3CvwVq9xee0a0aEZ7CF07KDs3z6DfBgeWH6dDLZ4Sqbm6qsoiL0OAPeQGIP2nswltgfn1kdQ8e4pbFfyCXvti6TwZBxI5SVuV5ZwZKm7luLFEnaTVHRMupghH0q7oxji8Sqaxj19Hs+R8De7EBEP5w4mW0LyToVvPqfyhDV3fh5h0aEcAwyxie5iU4g8Ni/86WTZKOFWgE8aeGzZb35Oow/smKRh82o3UQTxMTqCaRZmu3jQ5flgAxxOUt1sA+M/DKFKykzS217aqLwRtrpUZhrSmRj/geYV04ElXvDjpNZ5nBk/pFuq43JLW6tielg0eG8i7yK/qcmFThw==',
    'CommandID'           => 'AccountBalance',        # Command ID, Possible value AccountBalance             
    'PartyA'              => '600180',                      # ShortCode 1, or your Paybill(During Production) 
    'IdentifierType'      => '4',                      
    'Remarks'             => 'Balance',                      # Comments- Anything can go here
    'QueueTimeOutURL'     => 'https://madukaonline.co.ke/includes/trans/bal_callback_url.php',                      # URL where Timeout Response will be sent to
    'ResultURL'           => 'https://madukaonline.co.ke/includes/trans/bal_callback_url.php'                       # URL where Result Response will be sent to
  );

  $data_string = json_encode($curl_post_data);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
  $curl_response = curl_exec($curl);
  print_r($curl_response);
  echo $curl_response;
?>
