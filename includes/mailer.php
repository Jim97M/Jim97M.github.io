<?php 

    require 'init.php';
    require 'welcomeTemp.php';
    
    
    $shopObj = new SHOP();
    $data =  str_replace("person","Felix Omuok", $welcomeTemplate);
    $shopObj->welcomeEmail('Welcome To Maduka Online',$data,'dijiflex@gmail.com');