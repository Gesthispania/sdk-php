<a href='./'>Go back</a>
<?php

session_start();

if (file_exists('gateway_config.php')) {
    include 'gateway_config.php';
    
    if(isset($_REQUEST["access_token"])){
       $_SESSION["access_token"] = $_REQUEST["access_token"];
    }
}
else{
    echo 'No gateway_config.php file ... You need to create this file in the test folder with the next code:</br>';
    echo "<hr>";
    highlight_file("gateway_config_sample.php");
    require_once '../lib/Nimble/base/NimbleAPI.php';
    $platform = '';
    $storeName = 'TEST';
    $storeURL = 'http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']);
    $redirectURL = $storeURL . '/authentication_code.php';
    $url = NimbleAPI::getGatewayUrl($platform, $storeName, $storeURL, $redirectURL);
    echo "<a onclick=\"window.open('{$url}', '', 'width=800, height=578')\" href='#'>GATEWAY HERE</a>";
    die();
}