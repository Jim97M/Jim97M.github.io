
<?php

//gets all the counties
require_once 'init.php';
$shop = new SHOP();
$counties = $shop->counties();
exit(json_encode($counties));

