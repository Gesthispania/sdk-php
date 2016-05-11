<?php
require_once '../lib/Nimble/base/NimbleAPI.php';
require_once '../lib/Nimble/api/NimbleAPIPayments.php';
require_once 'functions.php';

$params = array(
        'clientId' => CLIENT_ID,
        'clientSecret' => CLIENT_SECRET
);

?>
<hr />
<h3 style="background-color: #d0e4fe;">/* params: clientId, clientSecret<br />
1.- Called to contructor: NimbleAPI(Array);<br />
2.- Called to NimbleAPIPayments::getPaymentsRefund($NimbleApi, $filters)</h3>
<pre>
<?php
    $filters = array();
    $filters['hasRefunds'] = true;
    $filters['extendData'] = true;
    $NimbleApi = new NimbleAPI($params);
    $response2 = NimbleAPIPayments::getPaymentsRefund($NimbleApi, $filters);
    var_dump($response2);
?>
</pre>