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
    die();
}