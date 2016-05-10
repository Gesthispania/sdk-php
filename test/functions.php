<a href='./'>Go back</a>
<?php

session_start();

if (file_exists('gateway_config.php')) {
    include 'gateway_config.php';
    
    if(isset($_REQUEST["session_token"])){
        error_log("entra en request");
        error_log($_REQUEST["session_token"]);
       $_SESSION["session_token"] = $_REQUEST["session_token"];
    }
}
else{
    echo 'No gateway_config.php file ... You need to create this file in the test folder with the next code:</br>';
    echo "<hr>";
    highlight_file("gateway_config_sample.php");
    die();
}