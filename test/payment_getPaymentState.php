<?php
require_once '../lib/Nimble/base/NimbleAPI.php';
require_once '../lib/Nimble/api/NimbleAPIPayments.php';
require_once 'functions.php';

$params = array(
        'clientId' => CLIENT_ID,
        'clientSecret' => CLIENT_SECRET
);
$params['token'] = $_SESSION['access_token'];
?>
<hr />
<h3 style="background-color: #d0e4fe;">/* params: clientId, clientSecret, token<br />
1.- Called to contructor: NimbleAPI(Array);<br />
2.- Called to NimbleAPIPayments::getPayments($NimbleApi, $filters)</h3>
<pre>
<?php
    $filters = array();
    $filters['state'] = 'ON_HOLD';
    $NimbleApi = new NimbleAPI($params);
    $response2 = NimbleAPIPayments::getPayments($NimbleApi, $filters);
    var_dump($response2);
?>
</pre>