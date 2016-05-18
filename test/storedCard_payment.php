<?php
require_once '../lib/Nimble/base/NimbleAPI.php';
require_once '../lib/Nimble/api/NimbleAPIStoredCards.php';
require_once 'functions.php';

$payment = array(
           "amount"  => 21,
           "currency" => "EUR",
           "merchantOrderId" => "Stored_card_MY_DB_ID",
           "cardHolderId"  =>  "idCustomer12345"
        );

$params = array(
        'clientId' => CLIENT_ID,
        'clientSecret' => CLIENT_SECRET
);
/* High Level call */
$NimbleApi = new NimbleAPI($params);
?>
<hr />
<br />
<h3 style="background-color: #d0e4fe;">/* params: clientId, clientSecret */<br />
1.- Called to contructor: NimbleAPI(Array);<br />
2.- Called to NimbleAPIStoredCards::payment($NimbleApi, $payment);</h3>

<pre>
<?php
$response = NimbleAPIStoredCards::payment($NimbleApi, $payment);
var_dump($response);
?>
</pre>