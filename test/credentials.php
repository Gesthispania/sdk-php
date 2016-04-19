<?php
//show code
//highlight_file("/info/authentication.php");
?>
<br />
------------------------------------------------------------------------------------------------------------
<br />
<?php
require_once '../lib/Nimble/base/NimbleAPI.php';
require_once '../lib/Nimble/api/NimbleAPICredentials.php';
require_once 'functions.php';

$params = array(
        'clientId' => CLIENT_ID,
        'clientSecret' => CLIENT_SECRET
);

/* High & Low Level call */
$nimbleApi = new NimbleAPI($params);
$response = NimbleAPICredentials::check($nimbleApi);
if ( isset($response) && isset($response['result']) && isset($response['result']['code']) && 200 == $response['result']['code'] ){
    echo "The credentials are correct";
} else{
    echo "The credentials are incorrect";  
}
?>

<br /> <pre>
Response:
<?php
var_dump($response);
?>