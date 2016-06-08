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
2.- Called to NimbleAPIStoredCards::preorderPayment($NimbleApi, $payment);<br />
3.- Called to NimbleAPIStoredCards::confirmPayment($NimbleApi, $preorderData);</h3>

<pre>
<?php
$preorder = NimbleAPIStoredCards::preorderPayment($NimbleApi, $payment);
var_dump($preorder);
if (isset($preorder['data'])){
    $response = NimbleAPIStoredCards::confirmPayment($NimbleApi, $preorder['data']);
}
var_dump($response);
?>
</pre>