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
<br />
<h3 style="background-color: #d0e4fe;">/* params: clientId, clientSecret<br />
1.- Called to contructor: NimbleAPI(Array);<br />
2.- Called to NimbleAPIPayments::getPayment($NimbleApi, $transaction_id)</h3>
<br />
<form action="#"><label>TRANSACTION_ID</label><input type="text" name="transaction_id"/><input type="submit" value="validate"/></form>

<pre>
<?php
if (isset($_REQUEST['transaction_id'])):
    $transaction_id = $_REQUEST['transaction_id'];
    $NimbleApi = new NimbleAPI($params);
    $response2 = NimbleAPIPayments::getPayment($NimbleApi, $transaction_id);
    var_dump($response2);
endif;
?>
</pre>