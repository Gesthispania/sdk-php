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
    $message = "The credentials are correct !!!";
} else{
    $message = "The credentials are incorrect !!!";  
}
?>
<hr />
<h3 style="background-color: #d0e4fe;">/* params: clientId, clientSecret<br />
1.- Called to contructor: NimbleAPI(Array);<br />
2.- Called to NimbleAPICredentials::check($nimbleApi);</h3>

<h4><?php echo $message ?></h4>
<pre>
<?php
var_dump($response);
?>
</pre>