<?php
//show code
//highlight_file("/info/authentication.php");
require_once '../lib/Nimble/base/NimbleAPI.php';
require_once 'functions.php';

$params = array(
        'clientId' => CLIENT_ID,
        'clientSecret' => CLIENT_SECRET
);

if(isset($_SESSION['access_token'])):
    $params = array(
            'clientId' => CLIENT_ID,
            'clientSecret' => CLIENT_SECRET,
            'token' => $_SESSION['access_token'],
            'refreshToken' => $_SESSION['refresh_token']
    );
    $NimbleApi = new NimbleAPI($params);
    ?>
    <h3 style="background-color: #d0e4fe;">/* params: clientId, clientSecret, token, refreshToken */<br/>
    1.- Called to contructor: NimbleAPI(Array);<br/></h3>
    <h4>ACCESS TOKEN: </h4>
    <span><?php echo $NimbleApi->authorization->getAccessToken(); ?></span>
    <h4>REFRESH TOKEN: </h4>
    <span><?php echo $NimbleApi->authorization->getRefreshToken(); ?></span>
    
    
    <?php
    $_SESSION["access_token"] = $NimbleApi->authorization->getAccessToken();
    $_SESSION["refresh_token"] = $NimbleApi->authorization->getRefreshToken();
endif;
