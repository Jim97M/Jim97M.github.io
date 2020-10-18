<?php

// $consumerKey = "VLR8ak8O0bvF7UGMHbXwpJlOXYKcX628";
// $consumerSecret = "PjYhcZhDQYYFKV89";
// $headers = "";


// $headers = ['Content-Type:application/json; charset=utf8'];

// $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
// $curl = curl_init($url);
// curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($curl, CURLOPT_HEADER, false);
// curl_setopt($curl, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);
// $result = curl_exec($curl);
// $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
// $result = json_decode($result);
// $access_token = $result->access_token;
// echo $access_token;

// curl_close($curl);


$consumerKey = "BwBmOxbepFZiIFjlMKTuDGmGx2dZLPrA";
$consumerSecret = "TnffJIaWWwR0DsAS";

$headers = ['Content-Type:application/json; charset=utf8'];

$access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
$curl = curl_init($access_token_url);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);
$result = curl_exec($curl);
$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
$result = json_decode($result);
$access_token = $result->access_token;
echo $access_token;

curl_close($curl);
